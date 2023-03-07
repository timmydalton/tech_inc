import axios from "axios";

const accountModule = {
  namespaced: true,
  state: () => ({
    data: null,
  }),
  mutations: {
    'set-account': (state, payload) => {
      state.data = payload
      if (payload) state.data.info = JSON.parse(payload.info)
    }
  },
  actions: {
    'fetch-account': ({state}, payload) => {
      const { token } = payload
      const url = `${import.meta.env.VITE_APP_API_URL}/account/login_token?token=${token}`
      axios.get(url, {headers: {"Accept":"application/json"}})
        .then(res => {
        if (res.status == 200) {
          const user = res.data.data
          state.data = user
          if (user) state.data.info = JSON.parse(user.info)
        }
        })
        .catch(err => {
          console.log(err, 'token failed')
          document.cookie = 'Token=; Max-Age=-99999999;';
        })
    }
  }
}

export default accountModule
