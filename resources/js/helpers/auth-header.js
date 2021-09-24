export const authHeader= ()=> {
    // return authorization header with jwt token
    let user = JSON.parse(localStorage.getItem('token'));
    console.error({authHeaderwe:user});
    if (user ) {
        return { 'Authorization': 'Bearer ' + token };
    } else {
        return {};
    }
}