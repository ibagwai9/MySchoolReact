import { userConstants } from '../constants';

export function user(state = {}, action) {
  switch (action.type) {
    case userConstants.GETAUTH_REQUEST:
      return {
        loading: true
      };
    case userConstants.GETAUTH_SUCCESS:
      return {
        item: action.user
      };
    case userConstants.GETAUTH_FAILURE:
      return { 
        error: action.error
      };
    default:
      return state
  }
}