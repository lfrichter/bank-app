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

    getCheckDetail(id: any, token: string): Promise<Check> {
        return new Promise(async (resolve, reject) => {
            await http
            .get(`admin/checks/${id}`, this.getHeader(token))
            .then(response => resolve(response.data as Check))
            .catch(error => {
                reject(error);
            });
        });
    }

    updateCheck(id: any, status: string, token: string): Promise<Check> {
        return new Promise((resolve, reject) => {
            http
            .put(`admin/checks/${id}`, {status: status}, this.getHeader(token))
            .then(response => resolve(response.data as Check))
            .catch(error => {
                reject(error);
            });
        });
    }
}

export default new BalanceService();

