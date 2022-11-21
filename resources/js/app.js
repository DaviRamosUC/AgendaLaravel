require('./bootstrap')

import { createApp } from 'vue'
import router from './router/index.js'

import NavigationBarComponent from './components/NavigationBarComponent.vue'
import LoginScreen from './screens/LoginScreen.vue'
import RegisterScreen from './screens/RegisterScreen.vue'
import HomeScreen from './screens/HomeScreen.vue'

import '../css/app.css'

const app = createApp({})

app.use(router)

app.component('navigationbarcomponent', NavigationBarComponent)

app.mount('#app')