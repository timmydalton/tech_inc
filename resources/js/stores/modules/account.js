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
  }
}

export default accountModule
