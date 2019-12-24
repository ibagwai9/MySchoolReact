/*import { createStore, combineReducers, applyMiddleware } from "redux";
import { reducer as formReducer } from "redux-form";
import thunk from 'redux-thunk';
//import PostsReducer from "./reducer_posts";

const rootReducer = combineReducers({
  //posts: PostsReducer,
  form: formReducer
});

const store = createStore(
  rootReducer,
  applyMiddleware(thunk)
 );

export default store;
*/

import { createStore,  combineReducers, applyMiddleware } from "redux";
import { reducer as formReducer } from "redux-form";
import reduxThunk from 'redux-thunk';
//import userReducer from "./reducers/users";
//import ReduxPromise from 'redux-promise';


const rootReducer = combineReducers({
  //posts: PostsReducer,

  //auth: userReducer,
  form: formReducer,
});

const store = createStore(rootReducer, {}, applyMiddleware(reduxThunk));
/*
const store = createStore(rootReducer, {}, applyMiddleware(reduxThunk, ReduxPromise));

const createStoreWithMiddleWare = applyMiddleware(reduxThunk)(createStore);
const store = createStoreWithMiddleWare(rootReducer);
*/

export default store;
