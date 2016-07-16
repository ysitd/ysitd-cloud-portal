import {Router} from 'express';
import GithubOAuth from '../auth/GithubOAuth';
import {config, query, view} from '../utils';

const router = Router();

/* GET users listing. */
if (process.env.NODE_ENV === 'dev') {
  router.get('/', function (request, response) {
    request.session.root = true;
    request.session.user = {
      id: '00000000-0000-0000-0000-000000000000',
      name: 'test',
      email: 'example@example.com',
      logo: '/images/user.png'
    };
    response.end();
  });
}
const auth = new GithubOAuth({
  id: config('GITHUB_OAUTH_ID'),
  secret: config('GITHUB_OATH_SECRET'),
  signup: false
});

router.get('/signin', function (request, response) {
  auth.signin(request, response);
});

router.get('/callback', auth.callback, function (request, response, next) {
  const sql = 'SELECT user_id AS id, display_name AS name, email, root, logo FROM users WHERE user_name = $1 AND github_id = $2 LIMIT 1';
  query(sql, [request.session.user.username, request.session.user.github], function (e, result) {
    if (e) {
      next(e, request, response);
      return ;
    }

    if (result.rows.length === 0) {
      view('register', {title: 'Register'});
    } else {
      const {id, name, email, root, logo}  = result.rows[0];
      request.session.user.id = id;
      request.session.user.name = name;
      request.session.user.email = email;
      request.session.user.logo = logo;
      request.session.root = root;
      response.status(302);
      response.redirect('/');
      response.end();
    }
  });
});

module.exports = router;
