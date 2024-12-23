import { createRouter, createWebHistory } from 'vue-router'
import defaultLayout from '@/components/layout/defaultLayout.vue'
import LoginView from '@/views/LoginView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: defaultLayout,
      meta: { requiresAuth: true },
      children: [
        {
          path: 'profile',
          name: 'profile',
          meta: { requiresAuth: true },
          component: () => import('../views/ProfileView.vue'),
        },
        {
          path: '',
          name: 'home',
          meta: { requiresAuth: true },
          component: () => import('../views/HomeView.vue'),
        },
        {
          path: 'products',
          name: 'products-list',
          meta: { requiresAuth: true },
          component: () => import('../views/Products/ListView.vue'),
        },
        {
          path: 'products/create',
          name: 'products-create',
          meta: { requiresAuth: true },
          component: () => import('../views/Products/CreateView.vue'),
        },
        {
          path: 'products/:id',
          name: 'products-view',
          meta: { requiresAuth: true },
          component: () => import('../views/Products/ShowView.vue'),
        },
        {
          path: 'about',
          name: 'about',
          meta: { requiresAuth: true },
          component: () => import('../views/AboutView.vue'),
        },
      ],
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/RegisterView.vue'),
    },
  ],
})

router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth) {
    const token = localStorage.getItem('token')
    if (token && token !== 'undefined') {
      // User is authenticated, proceed to the route
      next()
    } else {
      // User is not authenticated, redirect to login
      next('/login')
    }
  } else {
    // Non-protected route, allow access
    next()
  }
})

export default router
