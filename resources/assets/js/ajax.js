'use strict';

export default class Ajax {

  constructor() {
    this.xhr = null;
  }

  init(method, url) {
    this.xhr = new XMLHttpRequest();
    this.xhr.open(method, url, true);
  }

  get(url, param, cb) {
    if (!cb) {
      cb = param;
      param = []
    }

    const query = this.query(param);

    this.init('GET', `${url}?${query}`);
    this.xhr.onreadystatechange = () => {
      if (xhr.readyState === 4) {
        cb.call(null, this.xhr);
      }
    };
    this.xhr.send();
  }

  getJSON(url, cb) {
    this.get(url, function (xhr) {
      const data = JSON.parse(xhr.responseText);
      cb.call(data);
    });
  }

  post(url, param, type, cb) {
    if (!type) {
      cb = param;
      type = 'application/x-www-form-urlencoded';
      param = [];
    } else if (!cb) {
      cb = type;
      type = 'application/x-www-form-urlencoded';
    }
    this.init('POST', url);
    this.xhr.setRequestHeader('Content-Type', type);
    const data = type === 'application/x-www-form-urlencoded' ? this.query(param) : JSON.stringify(param);
    this.xhr.onreadystatechange = () => {
      if (xhr.readyState === 4) {
        cb.call(null, this.xhr);
      }
    };
    this.xhr.send(data);
  }

  static query(form) {
    return $.param(form);
  }

}

