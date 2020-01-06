import React, { Component } from 'react'
import { Route, Router } from 'react-router-dom'
import { Provider } from "react-redux"
import { history } from './helpers'
import { ThemeProvider } from "@material-ui/styles";
import { CssBaseline } from "@material-ui/core";

import Themes from "./admin/themes";
import { LayoutProvider } from "./admin/context/LayoutContext";
import { UserProvider } from "./admin/context/UserContext";

 import {
  PageIndex,
  PageLogin,  
  UserProfilePage ,
  PageSignUp } from './routes/main'
import App from './admin/components/App'
const AdminApp =()=>{
  return <LayoutProvider>
    <UserProvider>
      <ThemeProvider theme={Themes.default}>
        <CssBaseline />
        <App />
      </ThemeProvider>
    </UserProvider>
  </LayoutProvider>
}


class Application extends Component {
  render() {
    return (
       <Router history={history}>
            <Route path="/" exact component={PageIndex} />
            <Route path="/login" component={PageLogin} />
            <Route path="/sign-up" component={PageSignUp} />
            <Route path="/profile/:username" component={UserProfilePage} />
            <Route path="/dashboard/" component={UserProfilePage} />
            <Route path="/auth" exact component={AdminApp} />
        </Router>
    )
  }
} 

export default Application;
