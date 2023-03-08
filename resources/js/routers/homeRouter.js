import Home from '../components/views/Home.vue'
import NotFound from '../components/views/NotFound.vue'
import Login from '../components/views/Login.vue'
import Signup from '../components/views/Signup.vue'
import Profile from '../components/views/Profile.vue'
import ProductType from '../components/views/ProductType.vue'

const homeRouter = [
  {
    path: '/home',
    component: Home,
    name: 'Home'
  },
  {
    path: '/login',
    component: Login,
    name: 'Login'
  },
  {
    path: '/signup',
    component: Signup,
    name: 'Signup'
  },
  {
    path: '/profile',
    component: Profile,
    name: 'Profile'
  },
  {
    path: '/product-type/:type',
    component: ProductType,
    name: "ProductType"
  },
  {
    path: '/:catchAll(.*)',
    component: Home,
    name: 'Home'
  },
];

export default homeRouter;
