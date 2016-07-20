import {realpathSync} from 'fs';
import {GulpPaths, config} from 'laravel-elixir';

const baseDir = realpathSync(`${__dirname}/../../`);

function gulpPaths(srcDir, src, destDir, dest) {
  return new GulpPaths()
    .src(src, config.get(srcDir))
    .output(config.get(destDir), dest);
}

export {gulpPaths};