import {Route} from 'express';
import GithubOAuth from '../auth/GithubOAuth';
import {config, query, view} from '../utils';

var router = Route();

/* GET users listing. */
router.get('/', function(req, res, next) {
  res.send('respond with a resource');
});
const auth = new GithubOAuth({
  id: config('GITHUB_OAUTH_ID'),
  secret: config('GITHUB_OATH_SECRET'),
  signup: false
});

router.get('/signin', function (request, response) {
  auth.signin(request, response);
});

router.get('/callback', auth.callback, function (request, response, next) {
  const sql = 'SELECT user_id AS id, display_name AS name, email FROM users WHERE user_name = $1 AND github_id = $2 LIMIT 1';
  query(sql, [request.session.user.username, request.session.user.github], function (e, result) {
    if (e) {
      next(e, request, response);
      return ;
    }

    if (result.rows.length === 0) {
      view('register', {title: 'Register'});
    } else {
      const {id, name, email}  = result.rows[0];
      request.session.user.id = id;
      request.session.user.name = name;
      request.session.user.email = email;
      response.status(302);
      response.redirect('/');
      response.end();
    }
  });
});

module.exports = router;
