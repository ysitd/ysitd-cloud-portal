import winston from 'winston';
import config from './config';

winston.add(winston.transports.File, {filename: `${__dirname}/../../storages/logs/${config('LOG_FILES', 'debug.log')}`});
winston.level = process.env.NODE_ENV && process.env.NODE_ENV === 'production' ? 'error' : 'debug';

export default winston;