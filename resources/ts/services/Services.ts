export default class Services {

  getHeader(token: any): Object {
     return {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json'
                }
            }
  }

  getHeaderUpload(token: any): Object {
     return {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'multipart/form-data',
                }
            }
  }

}
