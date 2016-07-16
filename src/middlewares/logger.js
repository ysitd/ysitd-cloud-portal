import {createWriteStream} from 'fs';
import morgan from 'morgan';

const stream = createWriteStream(`${__dirname}/../../storages/logs/access.log`, {flags: 'a'});
function logger() {
  return morgan('combined', {stream})
}

function register(app) {
  app.use(logger());
}

export default logger;
export {register};