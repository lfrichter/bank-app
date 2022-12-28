import axios from 'axios';
import config from '../configApi';

export default axios.create({
  baseURL: config.rootApiUrl,
  headers: {
    'Accept-Version': config.apiVersion,
    'Content-Type': 'application/json'
  }
});
