import http from './Axios';
import { Deposit } from '../interfaces';
import Services from './Services';

class DepositService extends Services {

    deposit(purchase: Deposit, token: string): Promise<any> {

        let formData = new FormData()
        formData.append("amount", purchase.amount)
        formData.append("description", purchase.description)
        formData.append("image", purchase.image)

        return new Promise((resolve, reject) => {
            http
            .post(`deposit/`, formData, this.getHeaderUpload(token))
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }

    getDepositForm(): Deposit{
        return {
            amount: '',
            description: '',
            image: '',
            status: '',
            created_at: '',
        };
    }
}

export default new DepositService();

