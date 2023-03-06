import Vuex from 'vuex';
import accountModule from './modules/account';
import categoriesModule from './modules/categories';

const stores = new Vuex.Store({
  modules: {
    account: accountModule,
    categories: categoriesModule
  }
});

export default stores;
