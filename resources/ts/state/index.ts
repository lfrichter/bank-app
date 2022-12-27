import { reactive } from 'vue'
import { User } from '../interfaces';

export const state = reactive({

  authenticated: localStorage.getItem('authenticated') == 'true',
  user: localStorage.getItem('user') || null,
  token: localStorage.getItem('token') || null,
  admin: localStorage.getItem('admin') == 'true',

  setAuthentication(user: User|any, token: string, admin?: string): void {
    localStorage.setItem('user', user);
    localStorage.setItem('token', token);
    localStorage.setItem('authenticated', 'true');
    localStorage.setItem('admin', '' + admin);
    this.user = user
    this.token = token
    this.authenticated = true;
    this.admin = admin == 'true';
  },

  setLogoff(): void {
    localStorage.removeItem('user');
    localStorage.removeItem('token');
    localStorage.removeItem('authenticated');
    localStorage.removeItem('admin');
    this.user = null
    this.token = null
    this.authenticated = false;
    this.admin = false;
  },

  isAdmin(): boolean {
    return this.admin === true
  }

})




