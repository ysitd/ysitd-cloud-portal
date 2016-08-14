import {Component} from 'react';
import classNames from 'classnames';
import Field from './FormField';

export default class Form extends Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      load: false,
      form: {}
    }
  }

  render() {

    if (!('json' in this.props)) {
      return null;
    }

    const classes = classNames(this.props.className, 'loader', {
      'loading-done': this.state.load
    });

    const element = [];
    if (this.state.load) {
      this.state.form.forEach(function (field) {
        const ele = (
          <Field
            label={field.label}
            color={field.color}
            value={field.value}
            type={field.type}
          />);
        element.push(ele);
      })
    }

    const props = Object.assign({}, this.props);
    delete props.json;

    return (
      <div className={classes} {...props}>
        <div className="loading">
          <div className="progress">
            <div className="indeterminate" />
          </div>
        </div>
        <div>
        {element}
        </div>
      </div>
    );
  }

  componentDidMount() {
    const self = this;
    $.getJSON(`/json/${this.props.json.replace('.', '/')}.json`)
      .done(function (data) {
        self.setState({
          form: data,
          load: true
        })
      });
  }
}