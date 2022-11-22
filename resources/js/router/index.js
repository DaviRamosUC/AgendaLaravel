import * as VueRouter from 'vue-router'
import NavigationBarComponent from '../components/NavigationBarComponent.vue'
import LoginScreen from '../screens/LoginScreen.vue'
import RegisterScreen from '../screens/RegisterScreen.vue'
import ContactListScreen from '../screens/ContactListScreen.vue'
import RegisterContactScreen from '../screens/RegisterContactScreen.vue'
import HomeScreen from '../screens/HomeScreen.vue'
import auth from '../middleware/auth'

const routes = [
  { 
    path: '/',
    component: HomeScreen
  },
  { 
    path: '/login',
    component: LoginScreen
  },
  { 
    path: '/register',
    component: RegisterScreen
  },
  { 
    path: '/contactlist',
    component: ContactListScreen,
    beforeEnter: (to, from)=>{
      auth(to, from)
    }
  },
  { 
    path: '/registcontact',
    component: RegisterContactScreen,
    beforeEnter: (to, from)=>{
      auth(to, from)
    }
  },
]

const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(process.env.BASE_URL),
  routes,
})

export default router;