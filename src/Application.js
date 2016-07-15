import fs from 'fs';
import {basename} from 'path';
import express from 'express';
import compression from 'compression';
import bodyParser from 'body-parser';
import morgan from 'morgan';
import serveStatic from 'serve-static';
import {Environment, FileSystemLoader} from 'nunjucks';

const app = express();

const stream = fs.createWriteStream(`${__dirname}/../storages/logs/access.log`, {flags: 'a'});

// Add middleware
const env = new Environment(new FileSystemLoader(`${__dirname}/../views`, {watch: true}));
app.engine('html', function (file, opts, cb) {
  env.render(basename(file), opts, cb)
});
app.set('view engine', 'html');

app.use(compression());
app.use(morgan('combined', {stream}));
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
