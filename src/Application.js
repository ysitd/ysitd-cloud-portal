import express from 'express';
import compression from 'compression';
import bodyParser from 'body-parser';
import serveStatic from 'serve-static';
import LogicError from './errors/LogicError';
import {register as registerView} from './middlewares/view';
import {register as registerLogger} from './middlewares/logger';
import {register as registerSession} from './middlewares/session';
import {logger, view} from './utils';

const app = express();

// Add middleware
registerView(app);
registerLogger(app);
registerSession(app);
app.use(compression());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
  extended: true
}));
app.use(serveStatic(`${__dirname}/../public`, {
  maxAge: 1000 * 60 * 5
}));

// Add Routes
app.use('/', require('./routes/index'));
app.use('/user', require('./routes/users'));

app.use(function (request, response) {
  response.status(404);
  view(request, response, 'errors/404', {title: '404 Not Found'});
});

const messages = {
  403: '403 Forbidden',
  500: '500 Korued'
};

app.use(function (err, request, response, next) {
  response.status(err.code);
  view(request, response, `errors/${err.code || 404}`, {
    title: err.code in messages ? messages[err.code] : err.message
  });
  next(err, request, response);
});

app.use(function (err, request, response, next) {
  logger.error(err.stack);
});

module.exports = app;
