import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '@/stores/useAuthStore'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: import('@/layouts/DefaultLayout.vue'),
      children: [
        { path: '/', component: import('@/views/HomeView.vue') },
        { path: 'about', component: import('@/views/AboutView.vue') },
        { path: 'services', component: import('@/views/ServicesView.vue') },
        { path: 'cars', component: import('@/views/CarsView.vue') },
        { path: 'contact', component: import('@/views/ContactView.vue') },
        {
          path: '/cars/:id',
          name: 'CarDetail',
          component: import('@/views/CarDetail.vue')
        },
        { path: 'register-car', component: import('@/views/RegisterCarPage.vue') },
        { path: 'brands', component: import('@/views/BrandsView.vue') },
        { path: 'register-brand', component: import('@/views/RegisterBrandPage.vue') },
        {
          path: '/edit-brand/:id',
          name: 'EditBrandForm',
          component: import('@/views/EditBrandForm.vue')
        },
        { path: 'users', component: import('@/views/UsersView.vue') },
        { path: 'register-service', component: import('@/views/RegisterServicePage.vue') },
      ]
    },
    {
      path: '/login',
      meta: {
        requiresGuest: true
      },
      component: import('@/views/LoginView.vue')
    },
    {
      path: '/register',
      meta: {
        requiresGuest: true
      },
      component: import('@/views/RegisterView.vue')
    },
    {
      path: '/dashboard',
      meta: {
        requiresAuth: true
      },
      component: import('@/views/DashboardView.vue')
    },
    {
      path: '/forgot-password',
      meta: {
        requiresAuth: false
      },
      component: import('@/views/ForgotPasswordView.vue')
    },
    {
      path: '/reset-password',
      meta: {
        requiresAuth: false
      },
      component: import('@/views/ResetPasswordView.vue')
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
