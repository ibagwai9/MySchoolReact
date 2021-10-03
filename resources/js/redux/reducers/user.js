import { userConstants } from '../constants';
const init = {
  user: {},
  loading:false,
  error:null,
}
export function user(state = init, action) {
  switch (action.type) {
    case userConstants.GETAUTH_REQUEST:
      return {
        ...state,
        loading: true
      };
    case userConstants.GETAUTH_SUCCESS:
      return {
        ...state,
        user: action.user
      };
    case userConstants.GETAUTH_FAILURE:
      return { 
        ...state,
        error: action.error,
        loading:false,
      };
    default:
      return state
  }
}