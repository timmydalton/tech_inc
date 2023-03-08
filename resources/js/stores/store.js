import Vuex from 'vuex';
import accountModule from './modules/account';
import categoriesModule from './modules/categories';
import manageProductModule from './modules/manageProduct';
import productTypeModule from './modules/productType';
import productModule from './modules/product';

const stores = new Vuex.Store({
  modules: {
    account: accountModule,
    categories: categoriesModule,
    manageProduct: manageProductModule,
    productType: productTypeModule,
    products: productModule
  }
});

export default stores;
