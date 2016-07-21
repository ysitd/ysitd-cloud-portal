CREATE TABLE market_category (
  id UUID NOT NULL DEFAULT uuid_generate_v4(),
  category_name TEXT NOT NULL,
  created_at TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (id)
);

CREATE TABLE market_service (
  id UUID NOT NULL DEFAULT uuid_generate_v4(),
  category_id UUID NOT NULL REFERENCES market_category(id),
  service_name TEXT NOT NULL,
  price MONEY NOT NULL DEFAULT 0,
  service_owner UUID NOT NULL REFERENCES users(user_id),
  created_at TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT current_timestamp,
  updated_at TIMESTAMP WITHOUT TIME ZONE NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (id)
);