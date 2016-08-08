import {Component, PropTypes} from 'react';
import classNames from 'classnames';

const InputTypeMap = {
  N: 'number',
  integer: 'number'
};

export default class FormField extends Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      value: !!this.props.value
    }
  }

  render() {
    const id = this.props.label.replace(/\s+/, '_').toLowerCase();
    const {color} = this.props;
    const type = this.props.type in InputTypeMap ? InputTypeMap[this.props.type] : this.props.type;
    const checkbox = type === 'boolean';
    const classes = classNames(this.props.className, 'form-group', {
      'form-group-label': !checkbox,
      'control-highlight': !!this.props.value
    }, `form-group-${color === 'accent' ? 'brand-accent' : color}`);

    let method;
    switch (type) {
      case 'boolean':
        method = 'Boolean';
        break;
      case 'enum':
        method = 'Selection';
        break;
      case 'block':
        method = 'Block';
        break;
      default:
        method = 'Input';
    }
    method = `render${method}`;

    return (
      <div className={classes} {...this.props}>
        {this[method]({id, type}, this.props)}
      </div>
    );
  }

  renderBoolean({id}) {
    return (
      <div className="checkbox switch">
        <label htmlFor={id}>
          <input
            className="access-hide"
            id={id}
            name={id}
            type="checkbox"
          />
          <span className="switch-toggle"/>
          {this.props.label}
        </label>
      </div>
    )
  }

  renderBlock({id}) {
    return (
      <div>
        <label className="floating-label" htmlFor={id}>
          {this.props.label}
        </label>
        <textarea className="form-control textarea-autosize" id={id} name={id} rows="1" />
      </div>
    )
  }

  renderInput({id, type}) {
    return (
      <div>
        <label className="floating-label" htmlFor={id}>
          {this.props.label}
        </label>
        <input
          className="form-control"
          id={id}
          type={type}
          name={id}
          required={this.props.required !== false}
        />
      </div>
    );
  }
}

FormField.propTypes = {
  label: PropTypes.string
};

FormField.defaultProps = {
  color: 'brand'
};
