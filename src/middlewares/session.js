import session from 'express-session';
import redis from 'connect-redis';
import config from '../utils/config';

const RedisStore = redis(session);

const sess = session({
  cookie: {
    secure: true
  },
  secret: config('cookie_secret', 'foobar'),
  resave: false,
  saveUninitialized: true,
  name: 'YSITD_CLOUD',
  store: new RedisStore({
    ttl: 60 * 60,
    host: config('REDIS_HOST', '127.0.0.1'),
    port: config('REDIS_PORT', 6379)
  })
});

export default function () {
  return sess;
}

function register(app) {
  app.set('trust proxy', 1);
  app.use(sess);
}

export {register};