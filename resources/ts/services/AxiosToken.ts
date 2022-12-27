import axios from 'axios';
import config from '../config';
import { state } from '../state/index'

export default axios.create({
  baseURL: config.rootApiUrl,
  headers: {
    'Accept-Version': config.apiVersion,
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${state.token}`
  }
});
