import axios from "axios";

const productTypeModule = {
  namespaced: true,
  state: () => ({
    activeType: null,
  }),
  actions: {
    'set-data': ({state}, payload) => {
      const { data } = payload
      state.activeType = data
    },
    'fetch': ({state}, payload) => {
      const { type } = payload
      const url = `${import.meta.env.VITE_APP_API_URL}/product_type/by_key`
      const param = {
        key: type
      }
      return axios.post(url, param, {headers: {"Accept":"application/json"}})
    }
  }
}

export default productTypeModule
