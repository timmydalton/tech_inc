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

import { Button, Input, Carousel, Alert, Popover, Menu, MenuDivider, SubMenu, MenuItem, MenuItemGroup, Table, Dropdown, Modal, Select, SelectOption, Upload, Pagination } from 'ant-design-vue'

const app = createApp(App)

app.use(store)
app.use(routers)

app.component(Button.name, Button)

app.use(Input)
app.use(Carousel)
app.component(Alert.name, Alert)
app.component(Popover.name, Popover)
app.component(Menu.name, Menu)
app.component(MenuItem.name, MenuItem)
app.component(MenuDivider.name, MenuDivider)
app.component(SubMenu.name, SubMenu)
app.component(MenuItemGroup.name, MenuItemGroup)
app.component(Table.name, Table)
app.component(Dropdown.name, Dropdown)
app.component(Modal.name, Modal)
app.component(Select.name, Select)
app.component(Upload.name, Upload)
app.component(Pagination.name, Pagination)
app.use(SelectOption)

app.mount('#app')
