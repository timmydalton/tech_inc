import axios from "axios";

const manageProductModule = {
  namespaced: true,
  state: () => ({
    data: null,
  }),
  mutations: {
    'set-data': (state, payload) => {
      state.data = payload
    }
  },
  actions: {
    'fetch-product': ({state}, payload) => {
      const url = `${import.meta.env.VITE_APP_API_URL}/product/all`
      axios.get(url, {headers: {"Accept":"application/json"}})
        .then(res => {
          if (res.status == 200) {
            state.data = res.data.data
          }
        })
        .catch(err => {
          console.log(err, 'request failed')
        })
    }
  }
}

export default manageProductModule
