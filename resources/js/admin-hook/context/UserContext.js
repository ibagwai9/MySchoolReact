import React from "react";
import {URLS, userConstants} from '../../redux/constants'
import { userService } from '../../redux/services';
import { authHeader } from '../../helpers'

var UserStateContext = React.createContext();
var UserDispatchContext = React.createContext();

function userReducer(state={}, action) {
  switch (action.type) {
    case userConstants.GETAUTH_REQUEST:
      return {
        ...state, loading: true
      };
    case userConstants.GETAUTH_SUCCESS:
      return {
        ...state, item: action.user
      };
    case userConstants.GETAUTH_FAILURE:
      return { 
        ...state, error: action.error
      };
    default: {
      throw new Error(`Unhandled action type: ${action.type}`);
    }
  }
}

function authReducer(state={}, action) {
  switch (action.type) {
    case userConstants.GETAUTH_REQUEST:
      return {
        ...state, loading: true
      };
    case userConstants.GETAUTH_SUCCESS:
      return {
        ...state, item: action.user
      };
    case userConstants.GETAUTH_FAILURE:
      return { 
        ...state, error: action.error
      };
    default: {
      throw new Error(`Unhandled action type: ${action.type}`);
    }
  }
}

function UserProvider({ children }) {
  var [state, dispatch] = React.useReducer(userReducer, {
    isAuthenticated: !!localStorage.getItem("user"),
  });

  return (
    <UserStateContext.Provider value={state}>
      <UserDispatchContext.Provider value={dispatch}>
        {children}
      </UserDispatchContext.Provider>
    </UserStateContext.Provider>
  );
}

function useUserState() {
  var context = React.useContext(UserStateContext);
  if (context === undefined) {
    throw new Error("useUserState must be used within a UserProvider");
  }
  return context;
}

function useUserDispatch() {
  var context = React.useContext(UserDispatchContext);
  if (context === undefined) {
    throw new Error("useUserDispatch must be used within a UserProvider");
  }
  return context;
}

export { UserProvider, useUserState, useUserDispatch, loginUser, signOut, getAll, getAuth };

// ###########################################################

function loginUser(dispatch, login, password, history, setIsLoading, setError) {
  setError(false);
  setIsLoading(true);

  userService.login(login, password)
    .then(
        user => { 
            dispatch({type:userConstants.LOGIN_SUCCESS});
            console.log({action_success:user})
            history.push('/admin/dashboard')
        },
        error => {
            dispatch({ type: userConstants.LOGIN_FAILURE });
            console.log({error})
            setError(true);
            setIsLoading(false);
        }
    )
}
function getAll(dispatch) {
    return dispatch => {
        dispatch(request());

        userService.getAll()
            .then(
                users => dispatch(success(users)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: userConstants.GETALL_REQUEST } }
    function success(users) { return { type: userConstants.GETALL_SUCCESS, users } }
    function failure(error) { return { type: userConstants.GETALL_FAILURE, error } }
}

function getAuth(dispatch) {

    return dispatch => {
        dispatch(request());

        userService.getAuth()
            .then(
                user => dispatch(success(user)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: userConstants.GETAUTH_REQUEST } }
    function success(user) { return { type: userConstants.GETAUTH_SUCCESS, user} }
    function failure(error) { return { type: userConstants.GETAUTH_FAILURE, error } }
}

function signOut(dispatch, history) {
  localStorage.removeItem("user");
  userService.logout();
  dispatch({ type: "SIGN_OUT_SUCCESS" });
  history.push("/login");

}
