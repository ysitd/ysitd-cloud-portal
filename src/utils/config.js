require('dotenv').load({silent: true, path: `${__dirname}/../../.env`});

function env(param, fallback) {
  const defaultValue = typeof fallback !== 'undefined' ? fallback : null;
  return param in process.env ? process.env[param] : defaultValue;
}

const configData = {
};

function config(name, fallback) {
  const defaultValue = typeof fallback !== 'undefined' ? fallback : null;

  let value = env(name.toUpperCase());
  if (value !== null) {
    return value;
  }

  value = configData;
  name.split('.').forEach(function (piece) {
    if (value !== null) {
      value = value[piece] || null;
    }
  });

  return value || defaultValue;
}

module.exports = config;
