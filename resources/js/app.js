/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';

import App from './components/layouts/App.vue'
import { createApp } from 'vue'
import store from './stores/store'
import routers from './routers/routers';

import { Button, Input, Carousel } from 'ant-design-vue'

const app = createApp(App)

app.use(store)
app.use(routers)

app.component(Button.name, Button)

app.use(Input)
app.use(Carousel)

app.mount('#app')