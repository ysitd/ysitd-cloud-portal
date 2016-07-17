import {Environment, FileSystemLoader} from 'nunjucks';
import {realpathSync as realpath} from 'fs';

const source = realpath(`${__dirname}/../../views`);
const env = new Environment(new FileSystemLoader(source, {watch: true}));

env.addGlobal('nodes', [
  {id: 'hkg-1', name: 'HKG - 1'}
]);

function view() {
  return function (file, opts, cb) {
    const filename = file.replace(source, '').replace(/^\//, '');
    env.render(filename, opts, cb)
  };
}

function register(app) {
  app.engine('jinja', view());
  app.set('view engine', 'jinja');
}

export default view;
export {register};