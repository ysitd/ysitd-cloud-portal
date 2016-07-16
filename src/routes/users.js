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
  const sql = 'SELECT user_id, display_name, email FROM users WHERE user_name = $1 LIMIT 1';
  query(sql, [request.session.user.username], function (e, result) {
    if (e) {
      next(e, request, response);
      return ;
    }

    if (result.rows.length === 0) {
      view('register', {title: 'Register'});
    } else {
      response.redirect('/');
    }
  });
});

module.exports = router;
