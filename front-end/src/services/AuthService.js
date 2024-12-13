
import { apiRoutes } from './variables.js';
import Swal from 'sweetalert2';

const login = (email, password) => {

    let response = fetch(apiRoutes.login, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email, password })
    })
        .then(response => {

            if (response.ok) {
                return response.json();
            }

            throw new Error(response.statusText);
        })

        .then(data => {
            localStorage.setItem('token', data.data.token);
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error'
            })
        });

    return response;
}

const logout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');

    window.location.href = '/login';
}

const register = (name, email, password, c_password) => {

    let response = fetch(apiRoutes.register, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, email, password, c_password })
    })
        .then(response => {

            if (response.ok) {
                return response.json();
            }

            throw new Error(response.statusText);
        })

        .then(data => {
            localStorage.setItem('token', data.accessToken);

            Swal.fire({
                title: 'Success!',
                text: data.message,
                icon: 'success'
            });
        })
        .catch(error => {
            Swal.fire({
                title: 'Error!',
                text: error.message,
                icon: 'error'
            });
        });

    return response;
}

export { login, register, logout };