import React from 'react'
import { Route, Router, Redirect } from 'react-router-dom'
import { Provider } from "react-redux"
import { history } from './helpers'
import { ThemeProvider } from "@material-ui/styles";
import { CssBaseline } from "@material-ui/core";
import logo from './images/logo.png'
import Themes from "./admin-hook/themes";
import { LayoutProvider } from "./admin-hook/context/LayoutContext";
import { UserProvider } from "./admin-hook/context/UserContext";
import ParentProfile from './apps/parent/dashboard/Dashboard';
import ChildProfile from './apps/parent/dashboard/Student';
import TerminalReport from './apps/parent/dashboard/TerminalReportConnected';
import SessionReport from './apps/parent/dashboard/Session';
import MainSession from './apps/parent/dashboard/MainSession';

 import {
  PageIndex,
  ParentLogin,  
  UserProfilePage ,
  PageSignUp } from './routes/main'
import App from './admin-hook/components/App'
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
const ParentRoute = ({ component: Component, ...rest }) => (
    <Route {...rest} render={props => (
        localStorage.getItem('parent')
            ? <Component {...props} />
            : <Redirect to={{ pathname: '/login', state: { from: props.location } }} />
    )} />
)
const AdminRoute = ({ component: Component, ...rest }) => (
    <Route {...rest} render={props => (
        localStorage.getItem('admin')
            ? <Component {...props} />
            : <Redirect to={{ pathname: '/parent-login', state: { from: props.location } }} />
    )} />
)


class Application extends React.Component {
  render() {
    return (
       <Router history={history}>
            <Route path="/" exact component={PageIndex} />
            <Route path="/login" component={ParentLogin} />
            <Route path="/sign-up" component={PageSignUp} />
            <Route path="/profile" component={UserProfilePage} />

            <Route path="/g-login" component={ParentLogin} />
            <Route path="/g-register" component={PageSignUp} />
            <ParentRoute path="/g-profile/" component={ParentProfile} />
            <ParentRoute path="/g-child/:id" component={ChildProfile} />
            <ParentRoute path="/g-child-report/:id/:session/:term" component={TerminalReport} />
            <ParentRoute path="/g-child-ses-reports/:id/:session" component={SessionReport} />
            <ParentRoute path="/g-child-view-reports/:id/:session" component={MainSession} />
            <Route path="/auth" exact component={AdminApp} />
            
            <AdminRoute path="/admin-dashboard" component={ParentProfile} />
            <Route path="/admin-login" component={ParentLogin} />
        </Router>
    )
  }
} 

export default Application;
