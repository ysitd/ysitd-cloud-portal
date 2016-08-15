'use strict';
import './polyfill/Object';
import {render} from 'react-dom';
import './collapse';
import Form from './elements/Form';

Array.prototype.slice.call(document.querySelectorAll('[data-form-element]')).forEach(function (ele) {
  render(<Form json={ele.getAttribute('data-form')} />, ele);
});
