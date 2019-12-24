import React, { Component } from 'react'
import { Route, Router } from 'react-router-dom'
import { Provider } from "react-redux"
import { history } from './helpers'
 import {
  PageIndex,
  PageLogin,  
  UserProfilePage ,
  PageSignUp } from './routes/main'

class Application extends Component {
  render() {
    return (
       <Router history={history}>
            <Route path="/" exact component={PageIndex} />
            <Route path="/login" component={PageLogin} />
            <Route path="/sign-up" component={PageSignUp} />
            <Route path="/profile/:username" component={UserProfilePage} />
            <Route path="/dashboard/" component={UserProfilePage} />
        </Router>
    )
  }
} 

export default Application;
