import express from 'express';
import compression from 'compression';
import bodyParser from 'body-parser';
import morgan from 'morgan';
import serveStatic from 'serve-static';
import {register as registerView} from './middlewares/view';
import {register as registerLogger} from './middlewares/logger';

const app = express();

// Add middleware
registerView(app);
registerLogger(app);
app.use(compression());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({
  extended: true
}));
app.use(serveStatic(`${__dirname}/../public`, {
  maxAge: 1000
}));

// Add Routes
app.use('/', require('./routes/index'));

module.exports = app;
