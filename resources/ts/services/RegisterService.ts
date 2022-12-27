import http from './Axios';
import { User, Register } from '../interfaces';

class RegisterService {

    register(userRequest: Register): Promise<any> {
        return new Promise((resolve, reject) => {
            http
            .post(`register/`, {
                name: userRequest.name,
                email: userRequest.email,
                password: userRequest.password,
                password_confirmation: userRequest.password_confirmation
            })
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }

    getNewRegisterForm(): Register{
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    }
}

export default new RegisterService();

