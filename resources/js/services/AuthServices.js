import axiosClient from "../axios";

class AuthServices {
  /**
   * Check registration email
   */
  static async check_email(email){
    return axiosClient.post('/check_email', {email})
      .then(({data}) => {
        return data;
      })
  }
  static async check_username(username){
    return axiosClient('/check_username', {username})
      .then(({data}) => {
        return data;
      })
  }
  static async resend_email(email, active){
    return axiosClient.post('/resend', {email, active})
      .then(({data}) => {
        return data;
      })
  }
}

export default AuthServices
