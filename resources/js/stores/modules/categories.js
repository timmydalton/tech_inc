import axios from "axios";

const categoriesModule = {
  namespaced: true,
  state: () => ({
    categories: [],
    productType: []
  }),
  actions: {
    'fetch-data': ({state}, payload) => {
      const cateUrl = `${import.meta.env.VITE_APP_API_URL}/categories/all`
      axios.get(cateUrl)
        .then(res => {
          if (res.status == 200) {
            state.categories = res.data.data.categories
            state.productType = res.data.data.product_type
          }
        })
        .catch(err => {
          console.log(err, 'get categories failed')
        })
    }
  }
}

export default categoriesModule
