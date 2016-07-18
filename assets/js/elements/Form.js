import {Component} from 'react';
import classNames from 'classnames';

export default class Form extends Component {

  constructor(props, context) {
    super(props, context);
    this.state = {
      load: false
    }
  }

  render() {

    const classes = classNames(this.props.className, 'el-loading', {
      'el-loading-done': this.state.load
    });

    return (
      <div className={classes} {...this.props}>
        <div className="el-loading-indicator">
          <div className="progress progress-position-absolute-top">
            <div className="progress-bar-indeterminate" />
          </div>
        </div>

        <div>

        </div>
      </div>
    );
  }
}