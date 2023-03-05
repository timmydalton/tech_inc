import Vuex from 'vuex';
import accountModule from './modules/account';

const stores = new Vuex.Store({
  modules: {
    account: accountModule
  }
});

export default stores;
