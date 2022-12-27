import http from './Axios';
import httpToken from './AxiosToken';
import { Login } from '../interfaces';

class AuthService {

    login(userLogin: Login): Promise<any> {
        return new Promise((resolve, reject) => {
            http
            .post(`login`, {
                email: userLogin.email,
                password: userLogin.password,
            })
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }

    getLoginForm(): Login{
        return {
            email: '',
            password: '',
        };
    }

    logout(): Promise<any> {
        return new Promise((resolve, reject) => {
            httpToken
            .post(`logout`)
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }


    adminLogin(userLogin: Login): Promise<any> {
        return new Promise((resolve, reject) => {
            http
            .post(`admin/login`, {
                email: userLogin.email,
                password: userLogin.password,
            })
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }
}

export default new AuthService();

