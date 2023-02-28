import Home from '../components/views/Home.vue'
import NotFound from '../components/views/NotFound.vue'
import Login from '../components/views/Login.vue'
import Signup from '../components/views/Signup.vue'

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
    path: '/:catchAll(.*)',
    component: Home,
    name: 'Home'
  }
];

export default homeRouter;