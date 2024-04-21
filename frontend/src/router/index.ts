import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import DefaultLayout from '../layouts/DefaultLayout.vue'
import AboutView from '../views/AboutView.vue'
import ServicesView from '@/views/ServicesView.vue'
import CarsView from '@/views/CarsView.vue'
import ContactView from '@/views/ContactView.vue'
import DashboardView from '@/views/DashboardView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import { useAuthStore } from '@/stores/useAuthStore'
import ForgotPasswordView from '@/views/ForgotPasswordView.vue'
import ResetPasswordView from '@/views/ResetPasswordView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: DefaultLayout,
      children: [
        { path: '/', component: HomeView },
        { path: 'about', component: AboutView },
        { path: 'services', component: ServicesView },
        { path: 'cars', component: CarsView },
        { path: 'contact', component: ContactView }
      ]
    },
    {
      path: '/login',
      meta: {
        requiresGuest: true
      },
      component: LoginView
    },
    {
      path: '/register',
      meta: {
        requiresGuest: true
      },
      component: RegisterView
    },
    {
      path: '/dashboard',
      meta: {
        requiresAuth: true
      },
      component: DashboardView
    },
    {
      path: '/forgot-password',
      meta: {
        requiresAuth: false
      },
      component: ForgotPasswordView
    },
    {
      path: '/reset-password',
      meta: {
        requiresAuth: false
      },
      component: ResetPasswordView
    }
  ]
})

router.beforeEach((to, _from, next) => {
  const authStore = useAuthStore()

  const requiresAuth = to.matched.some((x) => x.meta.requiresAuth)
  const requiresGuest = to.matched.some((x) => x.meta.requiresGuest)

  if (requiresAuth && !authStore.isLoggedIn) {
    next('/')
  } else if (requiresGuest && authStore.isLoggedIn) {
    next('/')
  } else {
    next()
  }
})

export default router
