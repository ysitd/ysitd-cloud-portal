function AuthError() {
  Error.call(this, 'Forbidden');
  Error.captureStackTrace(this, this.constructor);
  this.message = 'Forbidden';
  this.name = 'AuthError';
  this.status = 403;
  this.inner = null;
}

AuthError.prototype = Object.create(Error.prototype);
AuthError.prototype.constructor = AuthError;

export default AuthError;
