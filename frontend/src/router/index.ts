import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import NavbarLayout from '../layouts/NavbarLayout.vue'
import AboutView from '../views/AboutView.vue'
import ServicesView from '@/views/ServicesView.vue'
import CarsView from '@/views/CarsView.vue'
import ContactView from '@/views/ContactView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },

    {
      path: '/',
      component: NavbarLayout,
      children: [
        { path: '', redirect: '/about' },
        { path: 'about', component: AboutView },
        { path: 'services', component: ServicesView },
        { path: 'cars', component: CarsView },
        { path: 'contact', component: ContactView },
        { path: 'login', component: LoginView },
        { path: 'register', component: RegisterView }
      ]
    }
  ]
})

export default router
