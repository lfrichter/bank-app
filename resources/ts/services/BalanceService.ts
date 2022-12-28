import http from './Axios';
import { Balance, Checks, Check } from '../interfaces';
import Services from './Services'

class BalanceService extends Services{

    get(monthYear: any, token: string): Promise<Balance[]> {
        return new Promise((resolve, reject) => {
            http
            .get(`balance/?` +  new URLSearchParams(monthYear).toString(), this.getHeader(token))
            .then(response => resolve(response.data as Balance[]))
            .catch(error => {
                reject(error);
            });
        });
    }

    getCurrentBalance(token: string): Promise<Balance> {
        return new Promise((resolve, reject) => {
            http
            .get(`currentBalance/`, this.getHeader(token))
            .then(response => resolve(response.data as Balance))
            .catch(error => {
                reject(error);
            });
        });
    }

    getExpenses(monthYear: any, token: string): Promise<Balance[]> {
        return new Promise((resolve, reject) => {
            http
            .get(`expenses/?` +  new URLSearchParams(monthYear).toString(), this.getHeader(token))
            .then(response => resolve(response.data as Balance[]))
            .catch(error => {
                reject(error);
            });
        });
    }

    getChecks(monthYear: any, token: string): Promise<Checks> {
        return new Promise((resolve, reject) => {
            http
            .get(`checks?` +  new URLSearchParams(monthYear).toString(), this.getHeader(token))
            .then(response => resolve(response.data as Checks))
            .catch(error => {
                reject(error);
            });
        });
    }
}

export default new BalanceService();

