CREATE TABLE IF NOT EXISTS human_audit (
  schema_name text NOT NULL,
  TABLE_NAME text NOT NULL,
  user_name text,
  action_tstamp TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  action TEXT NOT NULL CHECK (action IN ('I','D','U')),
  original_data text,
  new_data text,
  query text
) WITH (fillfactor=100);

CREATE OR REPLACE FUNCTION trigger_human_audit() RETURNS TRIGGER AS $func$
DECLARE
  v_old_data TEXT;
  v_new_data TEXT;
BEGIN
  IF (TG_OP = 'UPDATE') THEN
    v_old_data := ROW(OLD.*);
    v_new_data := ROW(NEW.*);
    INSERT INTO human_audit (schema_name, table_name, user_name, action, original_data, new_data, query)
    VALUES (TG_TABLE_SCHEMA::TEXT, TG_TABLE_NAME::TEXT, session_user::TEXT, substring(TG_OP, 1, 1), v_old_data, v_new_data, current_query());
    RETURN NEW;
  ELSIF (TG_OP = 'DELETE') THEN
    v_old_data := ROW(OLD.*);
    INSERT INTO human_audit (schema_name, table_name, user_name, action, original_data, query)
    VALUES (TG_TABLE_SCHEMA::TEXT,TG_TABLE_NAME::TEXT,session_user::TEXT,substring(TG_OP,1,1),v_old_data, current_query());
    RETURN OLD;
  ELSIF (TG_OP = 'INSERT') THEN
    v_new_data := ROW(NEW.*);
    INSERT INTO human_audit (schema_name, table_name, user_name, action, new_data, query)
    VALUES (TG_TABLE_SCHEMA::TEXT, TG_TABLE_NAME::TEXT, session_user::TEXT, substring(TG_OP, 1, 1), v_new_data, current_query());
    RETURN NEW;
  ELSE
    RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - Other action occurred: %, at %',TG_OP,now();
    RETURN NULL;
  END IF;

  EXCEPTION
  WHEN data_exception THEN
    RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [DATA EXCEPTION] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
    RETURN NULL;
  WHEN unique_violation THEN
    RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [UNIQUE] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
    RETURN NULL;
  WHEN OTHERS THEN
    RAISE WARNING '[AUDIT.IF_MODIFIED_FUNC] - UDF ERROR [OTHER] - SQLSTATE: %, SQLERRM: %',SQLSTATE,SQLERRM;
    RETURN NULL;
END;
$func$
LANGUAGE plpgsql
SECURITY DEFINER;

CREATE TABLE IF NOT EXISTS users (
  user_id UUID NOT NULL DEFAULT uuid_generate_v4(),
  github_id INT NOT NULL,
  user_name TEXT NOT NULL,
  display_name TEXT NOT NULL,
  logo TEXT DEFAULT NULL,
  email TEXT NOT NULL,
  root BOOLEAN NOT NULL DEFAULT FALSE,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  PRIMARY KEY (user_id),
  UNIQUE (user_name, github_id)
);

CREATE TRIGGER users_human_audit
AFTER INSERT OR UPDATE OR DELETE ON users
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();

CREATE TABLE IF NOT EXISTS roles (
  role_id TEXT NOT NULL DEFAULT uuid_generate_v4(),
  role_name TEXT NOT NULL,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  PRIMARY KEY (role_id),
  UNIQUE (role_name)
) WITH (FILLFACTOR=80);

CREATE TRIGGER roles_human_audit
AFTER INSERT OR UPDATE OR DELETE ON roles
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();

CREATE TABLE IF NOT EXISTS user_role (
  user_id UUID NOT NULL REFERENCES users(user_id),
  role_id TEXT NOT NULL REFERENCES roles(role_id)
) WITH (FILLFACTOR=50);

CREATE TRIGGER user_role_human_audit
AFTER INSERT OR UPDATE OR DELETE ON user_role
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();

CREATE TABLE IF NOT EXISTS accounts (
  account_id UUID NOT NULL DEFAULT uuid_generate_v4(),
  user_id UUID NOT NULL REFERENCES users(user_id) ON UPDATE CASCADE ON DELETE CASCADE,
  balance MONEY NOT NULL DEFAULT 0,
  useable MONEY NOT NULL DEFAULT 0,
  tran_in MONEY NOT NULL DEFAULT 0,
  tran_out MONEY NOT NULL DEFAULT 0,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  PRIMARY KEY (account_id)
);

CREATE INDEX accounts_balance ON accounts(balance, useable);
CREATE INDEX account_house_clean ON accounts(account_id, tran_in, tran_out);

COMMENT ON TABLE accounts IS 'Credit of users';
COMMENT ON COLUMN accounts.balance IS 'Balance include not yet finished transaction';
COMMENT ON COLUMN accounts.useable IS 'Balance after transaction and housing cleaning';

CREATE TRIGGER account_human_audit
AFTER INSERT OR UPDATE OR DELETE ON accounts
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();

CREATE TABLE IF NOT EXISTS transactions (
  transaction_id UUID NOT NULL DEFAULT uuid_generate_v4(),
  source UUID NOT NULL REFERENCES accounts(account_id) ON UPDATE CASCADE ON DELETE RESTRICT,
  target UUID NOT NULL REFERENCES accounts(account_id) ON UPDATE CASCADE ON DELETE RESTRICT,
  amount MONEY NOT NULL DEFAULT 0,
  occur_time TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  house_clean_time TIMESTAMP WITH TIME ZONE DEFAULT NULL,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  notes TEXT[3] NOT NULL,
  CHECK(extract(TIMEZONE FROM occur_time) = '8'),
  CHECK(extract(TIMEZONE FROM house_clean_time) = '8'),
  PRIMARY KEY (transaction_id)
) WITH (FILLFACTOR=100);

CREATE INDEX transaction_time ON transactions(occur_time, house_clean_time);
CREATE INDEX transaction_data ON transactions(source, target, amount);

COMMENT ON TABLE transactions IS 'Data of transfer and transaction';
COMMENT ON COLUMN transactions.occur_time IS 'Time of transfer take action';
COMMENT ON COLUMN transactions.house_clean_time IS 'Time of transaction being house cleaning';

CREATE TRIGGER transactions_human_audit
AFTER INSERT OR UPDATE OR DELETE ON transactions
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();

CREATE TABLE IF NOT EXISTS system_audit (
  account_id UUID NOT NULL REFERENCES accounts(account_id) ON UPDATE CASCADE ON DELETE RESTRICT,
  balance_before MONEY NOT NULL,
  balance_after MONEY NOT NULL,
  delata MONEY NOT NULL,
  action_timestamp TIMESTAMP WITH TIME ZONE
) WITH (FILLFACTOR=100);

CREATE OR REPLACE FUNCTION trigger_system_audit() RETURNS TRIGGER AS $func$
BEGIN
  IF (TG_OP = 'UPDATE' AND OLD.balance <> NEW.balance) THEN
    INSERT INTO system_audit(account_id, balance_before, balance_after, delata, action_timestamp)
    VALUES (OLD.account_id, OLD.balance, NEW.balance, NEW.balance - OLD.balance, NOW());
  ELSEIF (TG_OP = 'INSERT') THEN
    INSERT INTO system_audit(account_id, balance_before, balance_after, delata, action_timestamp)
    VALUES (NEW.account_id, 0, NEW.balance, NEW.balance, NOW());
  END IF;
END;
$func$
LANGUAGE plpgsql
SECURITY DEFINER;

CREATE TRIGGER account_system_audit
AFTER INSERT OR UPDATE ON accounts
FOR EACH ROW EXECUTE PROCEDURE trigger_system_audit();

CREATE TABLE IF NOT EXISTS exchange(
  exchange_id UUID NOT NULL DEFAULT uuid_generate_v4(),
  user_id UUID NOT NULL REFERENCES users(user_id),
  request_amount MONEY NOT NULL DEFAULT 0,
  request_method TEXT NOT NULL,
  request_propsal TEXT DEFAULT NULL,
  approved BOOL DEFAULT NULL,
  approve_amount MONEY NOT NULL DEFAULT 0,
  approve_admin UUID[] DEFAULT NULL,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT current_timestamp,
  PRIMARY KEY (exchange_id)
);

CREATE TRIGGER exchange_human_audit
AFTER INSERT OR UPDATE OR DELETE ON exchange
FOR EACH ROW EXECUTE PROCEDURE trigger_human_audit();
