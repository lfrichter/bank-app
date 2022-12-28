import http from './Axios';
import { Login } from '../interfaces';
import Services from './Services'
class AuthService extends Services {

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

    logout(token: string): Promise<any> {
        return new Promise((resolve, reject) => {
            http
                .post(`logout`,{}, this.getHeader(token))
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

