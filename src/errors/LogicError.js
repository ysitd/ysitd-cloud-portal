function LogicError(message, code) {
  Error.call(this, 'Logic Error');
  Error.captureStackTrace(this, this.constructor);
  this.name = 'LogicError';
  this.message = message;
  this.status = code;
  this.code = code;
}

LogicError.prototype = Object.create(Error.prototype);
LogicError.prototype.constructor = LogicError;

export default LogicError;
