import {Component, PropTypes} from 'react';
import classNames from 'classnames';

export default class FormField extends Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      value: this.props.value || false
    }
  }

  render() {
    const id = this.props.label.replace(/\s+/, '-');
    const {color} = this.props;
    const classes = classNames(this.props.className, 'form-group', 'form-group-label', {
      'control-highlight': !!this.state.value
    }, `form-group-${color === 'accent' ? 'brand-accent' : color}`);
    return (
      <div className={classes} {...this.props}>
        <label className="floating-label" htmlFor={id}>{this.props.label}</label>
        <input
          ref={(ref) => this.input = ref}
          className="form-control"
          id={id}
          type={this.props.type}
          onChange={this.handleChange.bind(this)}
        />
      </div>
    );
  }

  handleChange() {
    this.setState({value: this.input.value});
  }
}

FormField.propTypes = {
  label: PropTypes.string
};

FormField.defaultProps = {
  color: 'brand'
};
