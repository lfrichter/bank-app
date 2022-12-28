import http from './Axios';
import { Purchase } from '../interfaces';
import Services from './Services'

class PurchaseService extends Services {

    addPurchase(purchase: Purchase, token: string): Promise<any> {
        return new Promise((resolve, reject) => {
            http
            .post(`purchase/`, {
                amount: purchase.amount,
                created_at: purchase.created_at,
                description: purchase.description,
            }, this.getHeader(token))
            .then(response => resolve(response.data as any))
            .catch(error => {
                reject(error);
            });
        });
    }

    getPurchaseForm(): Purchase{
        return {
            amount: '',
            created_at: '',
            description: '',
        };
    }
}

export default new PurchaseService();

