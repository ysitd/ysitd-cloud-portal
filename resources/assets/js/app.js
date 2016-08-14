'use strict';
import {render} from 'react-dom';
import './collapse';
import Form from './elements/Form';

document.querySelectorAll('[data-form-element]').forEach(function (ele) {
  render(<Form json={ele.getAttribute('data-form')} />, ele);
});
