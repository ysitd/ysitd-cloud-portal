import {Router} from 'express';
import view from '../utils/views';

const router = Router();

/* GET home page. */
router.get('/', function(request, response) {
  view(response, 'index', { title: 'Dashboard' });
});

module.exports = router;
