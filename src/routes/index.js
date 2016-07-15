import {Router} from 'express';

const router = Router();

/* GET home page. */
router.get('/', function(request, response) {
  response.render('index', { title: 'Dashboard' });
});

module.exports = router;
