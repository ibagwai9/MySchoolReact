export const parentHeader= ()=> {
    // return authorization header with jwt token
    let parent = JSON.parse(localStorage.getItem('parent'));
    console.log({authHeader:parent});
    if (parent && parent.token) {
        return { 'Authorization': 'Bearer ' + parent.token };
    } else {
        return {};
    }
}