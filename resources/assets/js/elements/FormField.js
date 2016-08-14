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
    const type = this.props.type in InputTypeMap ? InputTypeMap[this.props.type] : this.props.type;
    const checkbox = type === 'boolean';
    const classes = classNames(this.props.className, 'input-field col s12', {
      'form-group-label': !checkbox,
      'control-highlight': !!this.props.value,
    });

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
      <div className="switch">
        <label htmlFor={id}>
          <input
            id={id}
            name={id}
            type="checkbox"
          />
          <span className="lever"/>
          {this.props.label}
        </label>
      </div>
    )
  }

  renderBlock({id}) {
    return (
      <div>
        <label htmlFor={id}>
          {this.props.label}
        </label>
        <textarea className="materialize-textarea" id={id} name={id} rows="1" />
      </div>
    )
  }

  renderInput({id, type}) {
    return (
      <div>
        <input
          className="validate"
          id={id}
          type={type}
          name={id}
          required={this.props.required !== false}
        />
        <label htmlFor={id}>
          {this.props.label}
        </label>
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
