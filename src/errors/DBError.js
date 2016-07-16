function DBError(error) {
  Error.call(this, 'Database error');
  Error.captureStackTrace(this, error || this.constructor);
  this.name = 'DBError';
  this.message = 'Database Error';
  this.status = 500;
  this.inner = null;
  this.source = error;
}

DBError.prototype = Object.create(Error.prototype);
DBError.prototype.constructor = DBError;

export default DBError;
