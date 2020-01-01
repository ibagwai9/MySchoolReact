

import { createStore,  combineReducers, applyMiddleware } from "redux";
import { reducer as formReducer } from "redux-form";
import reduxThunk from 'redux-thunk';
//import userReducer from "./reducers/users";
import { authentication } from './reducers/authentication';
import { users } from './reducers/users';
import { user } from './reducers/user';
import { alert } from './reducers/alert';

const rootReducer = combineReducers({
  authentication,
  users,
  user,
  alert,
  form: formReducer,
});

const store = createStore(rootReducer, {}, applyMiddleware(reduxThunk));
/*
const store = createStore(rootReducer, {}, applyMiddleware(reduxThunk, ReduxPromise));

const createStoreWithMiddleWare = applyMiddleware(reduxThunk)(createStore);
const store = createStoreWithMiddleWare(rootReducer);
*/

export default store;
