// const appUrl = import.meta.env.VITE_APP_URL;
const appUrl = process.env.VITE_APP_URL;
export default {
  rootApiUrl: appUrl +'/api',
  apiVersion: 1,
};
