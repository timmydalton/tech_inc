import axios from "axios";

const productModule = {
  namespaced: true,
  state: () => ({
    data: null,
    pagination: null
  }),
  actions: {
    'fetch-product': ({state}, payload) => {
      const { type_id } = payload
      const url = `${import.meta.env.VITE_APP_API_URL}/product/get_by_type_id`
      const param = {
        type_id: type_id
      }
      return axios.post(url, param, {headers: {"Accept":"application/json"}})
        .then(res => {
          if (res.status == 200) {
            state.data = res.data.data
            state.pagination = res.data.pagination
          }
        })
        .catch(err => {
          console.log(err, 'request failed')
        })
    }
  }
}

export default productModule
