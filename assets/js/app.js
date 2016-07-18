'use strict';
import {render} from 'react-dom';
import './collapse';
import FormField from './elements/FormField';

$('[data-form-element]').each(function (i, ele) {
  render(<FormField
    label={$(this).attr('data-label')}
    type={$(this).attr('data-type')}
    value={$(this).text()}
  />, ele);
});

