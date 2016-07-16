import queryString from 'querystring';
import {createHash, randomBytes} from 'crypto';
import curl from 'request';

export default class GithubOAuth {
  constructor(options) {
    if (!('id' in options && 'secret' in options)) {
      throw new Error('id or secret is not set');
    }
    this.options = options;
  }

  signin(request, response) {
    const digest = createHash('sha1');
    const salt = randomBytes(8).toString('hex');
    digest.update(request.ip);
    digest.update(salt);
    const state = digest.digest('hex');
    request.session.state = state;
    request.session.salt = salt;

    const queryObj = {
      state,
      'client_id': this.options.id,
      'allow_signup': 'signup' in this.options ? this.options.signup : true
    };
    if ('scope' in this.options) {
      queryObj.scope = this.options.scope;
    }

    if ('callback' in this.options) {
      queryObj.redirect_url = this.options.callback;
    }

    const query = queryString.stringify(queryObj);

    response.status(302);
    response.redirect(`https://github.com/login/oauth/authorize?${query}`);
    response.end();
  }

  callback(request, response, next) {
    if (!('code' in request.query && 'state' in request.query)) {
      next(new Error('No code provided in request from GitHub.'), request, response);
      return;
    }

    // Verify state code
    const stateSession = request.session.state;
    const stateQuery = request.query.state;
    const digest = createHash('sha1');
    digest.update(request.ip);
    digest.update(request.session.salt);
    const stateRegen = digest.digest('hex');
    if (stateQuery != stateSession || stateSession != stateRegen || stateQuery != stateRegen) {
      next(new Error('State Check Fail'), request, response);
      return ;
    }

    curl.post({
      url: 'https://github.com/login/oauth/access_token',
      headers: {
        Accept: 'application/json'
      }
    }, {
      client_id: this.options.id,
      client_secret: this.options.secret,
      code: request.query.code,
      state: request.query.state
    }, function (e, response, body) {
      if (e) {
        next(e, request, response);
        return ;
      }
      const data = JSON.parse(body);
      const token = data.access_token;
      curl({
        url: `https://api.github.com/user?access_token=${token}`,
        headers: {
          Accept: 'application/json'
        }
      }, function (e, response, body) {
        if (e) {
          next(e, request, response);
          return ;
        }
        const usermeta = JSON.parse(body);
        request.session.user = {
          username: usermeta.login,
          token: token,
          github: usermeta.id
        };
        next();
      });
    });
  }

}