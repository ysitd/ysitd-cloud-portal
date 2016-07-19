'use strict';
import {render} from 'react-dom';
import './collapse';
import Form from './elements/Form';

$('[data-form-element]').each(function (i, ele) {
  render(<Form json={ele.getAttribute('data-form')} />, ele);
});

$(document.getElementsByTagName('main')[0]).css(
  'padding-bottom',
  `${$(document.getElementsByTagName('footer')[0]).outerHeight()}px`
);
