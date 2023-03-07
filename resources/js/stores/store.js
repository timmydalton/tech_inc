import Vuex from 'vuex';
import accountModule from './modules/account';
import categoriesModule from './modules/categories';
import manageProductModule from './modules/manageProduct';

const stores = new Vuex.Store({
  modules: {
    account: accountModule,
    categories: categoriesModule,
    manageProduct: manageProductModule
  }
});

export default stores;
