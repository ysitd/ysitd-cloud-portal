/**
 * Create and return a database client.
 */
import pg from 'pg';
import config from './config';
import logger from './logger';

function connect(cb){
	pg.connect(config('DATABASE_URL'), cb);
}

function query(query, data, cb) {
	connect (function handler (e, conn, done){
		if(e) {
			logger.log('error', 'Failed connecting database!', e);
			cb(e, null);
		} else {
			logger.log('info', `Executing query '${query}'`);
			logger.profile('db_query');
			conn.query(query, data, function(e, data) {
				if(e) {
					logger.log('error', 'Query returned an error!', e);
					cb(e, null);
				} else {
					logger.profile('db_query');
					cb(e, data);
					process.nextTick(function(){
						// Return the connection to pool
						done();
					});
				}
			});
		}
	});
}

function transaction(cb) {
	connect(function(e, conn, done) {
		if(e) {
			cb(e);
			return;
		}

		const rollback = function(cb) {
			conn.query('ROLLBACK', function(e) {
				if(e) {
					// Rollback are having errors, we are messed up
					logger.error("SQL Rollback error", e);
					cb(e);
					process.nextTick(function() {
						// Pass the error to cause a disconnect from the connection pool
						done(e);
					});
				}
				else {
					cb();
				}
			});
		};

		const commit = function() {
			logger.profile('db_transcation');
			conn.query('COMMIT', done);
		};

		conn.query('BEGIN', function(e) {
			if(e) {
				rollback(function(_e) {
					if(_e) {
						cb(_e);
						return;
					}

					cb(e);
				});
			}
			else {
				logger.profile('db_transcation');
				process.nextTick(function() {
					cb(e, conn, {
						commit,
						rollback
					});
				});
			}
		});
	});
}

export { query, transaction };
