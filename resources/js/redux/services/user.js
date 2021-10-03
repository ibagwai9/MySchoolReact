import { URLS } from '../constants'
import { authHeader } from '../../helpers';

export const userService = {
  login,
  register,
  logout,
  getAuth,
  getAll
};

function login(username, password) {
  const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ username, password })
  };

  return fetch(`${URLS.ROOT}/login`, requestOptions)
    .then(handleResponse)
    .then(res => {
      // login successful if there's a jwt token in the response
      console.log({fre_service_res:res.success});
      if (res.success) {
        // store user details and jwt token in local storage to keep user logged in between page refreshes
        //console.log({service_res:res.success});
        localStorage.setItem('user', JSON.stringify(res.data.user));
        localStorage.setItem('token', JSON.stringify(res.data.token));
        
					// location.replace('/dashboard');
      }

      return res.data.user;
    });
}

function register(data) {
  const requestOptions = {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data
  };

  return fetch(`${URLS.ROOT}/register`, requestOptions)
    .then(handleResponse)
    .then(res => {
      // login successful if there's a jwt token in the response
      console.log({fre_service_res:res.success});
      if (res.success) {
        // store user details and jwt token in local storage to keep user logged in between page refreshes
        //console.log({service_res:res.success});
        localStorage.setItem('user', JSON.stringify(res.data.user));
        localStorage.setItem('token', JSON.stringify(res.data.token));
        
					// location.replace('/dashboard');
      }

      return res.data.user;
    });
}

function logout() {
  // remove user from local storage to log user out
  localStorage.removeItem('user');
  localStorage.removeItem('token');
}

function getAll() {
  const requestOptions = {
    method: 'POST',
    headers: authHeader()
  };

  return fetch(`${URLS.ROOT}/users`, requestOptions).then(handleResponse);
}

function getAuth() {
  const requestOptions = {
    method: 'POST',
    headers: authHeader(),
  };

  return fetch(`${URLS.ROOT_ADMIN}/user`, requestOptions).then(handleResponse);
}

function handleResponse(response) {
  return response.text().then(text => {
    const data = text && JSON.parse(text);
    if (!response.ok) {
      if (response.status === 401) {
        // auto logout if 401 response returned from api
        logout();
        // location.reload(true)
      }

      const error = (data && data.message) || response.statusText;
      return Promise.reject(error);
    }
    return data;
  });
}