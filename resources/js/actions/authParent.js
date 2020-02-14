import { parentConstants,URLS } from '../constants';
import { parentService } from '../services';
import { alertActions } from './';
import { history } from '../helpers';

export const parentActions = {
    login,
    logout,
    getAuth,
    getAll,
    getChild,
    getSessionsFrom
};

function login(username, password) {
    return dispatch => {
        dispatch(request({ username }));

        parentService.login(username, password)
            .then(
                parent => { 
                    dispatch(success(parent));
                    console.log({action_success:parent})
                    history.push('/g-profile')
                },
                error => {
                    dispatch(failure(error));
                    console.log({error})
                    dispatch(alertActions.error(error));
                }
            );
    };

    function request(parent) { return { type: parentConstants.LOGIN_REQUEST, parent } }
    function success(parent) { return { type: parentConstants.LOGIN_SUCCESS, parent } }
    function failure(error) { return { type: parentConstants.LOGIN_FAILURE, error } }
}

function logout() {
    parentService.logout();
    return { type: parentConstants.LOGOUT };
}

function getAll() {
    return dispatch => {
        dispatch(request());

        parentService.getAll()
            .then(
                students => dispatch(success(students)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: parentConstants.GETALL_REQUEST } }
    function success(students) { return { type: parentConstants.GETALL_SUCCESS, students } }
    function failure(error) { return { type: parentConstants.GETALL_FAILURE, error } }
}

function getAuth() {
    return dispatch => {
        dispatch(request());

        parentService.getAuth()
            .then(
                parent => dispatch(success(parent)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: parentConstants.GETAUTH_REQUEST } }
    function success(parent) { return { type: parentConstants.GETAUTH_SUCCESS, parent} }
    function failure(error) { return { type: parentConstants.GETAUTH_FAILURE, error } }
}



function getChild(id) {
    return dispatch => {
        dispatch(request());

        parentService.getChild(id)
            .then(
                child => dispatch(success(child)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: parentConstants.GETCHILD_REQUEST } }
    function success(child) { return { type: parentConstants.GETCHILD_SUCCESS, child} }
    function failure(error) { return { type: parentConstants.GETCHILD_FAILURE, error } }
}

function getSessionsFrom(id) {
    return dispatch => {
        dispatch(request());

        parentService.getSessionsFrom(id)
            .then(
                child => dispatch(success(child)),
                error => dispatch(failure(error))
            );
    };

    function request() { return { type: parentConstants.GET_SESSIONS_REQUEST } }
    function success(sessions) { return { type: parentConstants.GET_SESSIONS_SUCCESS, sessions} }
    function failure(error) { return { type: parentConstants.GET_SESSIONS_FAILURE, error } }
}