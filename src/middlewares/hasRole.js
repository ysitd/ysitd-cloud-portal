import {query} from '../utils/db';
import AuthError from '../errors/AuthError';
import DBError from '../errors/DBError';

export default function hasRole(roles, pass) {
  if (typeof roles === 'string') {
    roles = [roles];
  }

  return function (request, response, next) {
    if ('root' in request.session) {
      next();
    }

    const find = [];
    request.session.roles = request.session.roles || [];
    roles.forEach(function (role) {
      if (request.session.roles.indexOf(role) < 0) {
        find.push(role);
      }
    });
    if (find.length === 0) {
      next(request, response);
      return;
    }

    const conditions = [];

    for (let i = find.length; i > 0; i -= 1) {
      conditions.push(`role_id = \$${i + 1}`);
    }

    const sql = `SELECT COUNT(*) AS count FROM users_roles WHERE user_id = $1 AND (${conditions.join(' OR ')})`;
    const param = [request.session.id].concat(find);
    query(sql, param, function (e, result) {
      if (e) {
        next(new DBError(e), request, response);
        return ;
      }
      const {count} = result.rows[0];
      if (count !== find.length) {
        if (!pass) {
          next(new AuthError(), request, response);
        }
      } else {
        request.session.roles.concat(find);
        next();
      }
    })
  };
}