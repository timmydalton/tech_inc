import { createWebHistory, createRouter } from "vue-router";
import homeRouter from './homeRouter';

const routes = [
    ...homeRouter,
];

const routers = createRouter({
  history: createWebHistory(),
  routes
})

export default routers;