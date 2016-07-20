'use strict';
const route = location.pathname.replace(/^\//, '').split('/')[0];
const ele = document.getElementById(`collapse-${route}`);
if (ele && ele !== null) {
  $(ele).addClass('in');
}
