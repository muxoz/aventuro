import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import AppLayout from '@/components/layouts/AppLayout.vue'
import E404View from '@/views/E404View.vue'
import PackageView from '@/views/PackageView.vue'
import PackagesView from '@/views/PackagesView.vue'
import BookingsView from '@/views/BookingsView.vue'
import ProfileView from '@/views/ProfileView.vue'
import LoginView from '@/views/LoginView.vue'
import RegisterView from '@/views/RegisterView.vue'
import CreateBookingView from '@/views/CreateBookingView.vue'
import { useAuthStore } from '@/stores/auth'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      component: AppLayout,
      children: [
        {
          path: "",
          name: "home",
          component: HomeView,
          meta: { noAuth: true }
        },
        {
          path: "/packages",
          name: "packages",
          component: PackagesView
        },
        {
          path: "/packages/:slug",
          name: "packages.details",
          component: PackageView
        },
        {
          path: "/bookings",
          name: "bookings",
          component: BookingsView,
          meta: { requiresAuth: true }
        },
        {
          path: "/bookings/create/:slug",
          name: "bookings.create",
          component: CreateBookingView,
          meta: { requiresAuth: true }
        },
        {
          path: "/profile",
          name: "profile",
          component: ProfileView,
          meta: { requiresAuth: true }
        },
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
      meta: { noAuth: true }
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
      meta: { noAuth: true }
    },
    {
      path: '/:catchAll(.*)', 
      name: 'NotFound',
      component: E404View,
    },

    // {
      // path: '/about',
      // name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
    //   component: () => import('../views/AboutView.vue')
    // }
  ]
})

router.beforeEach((to, from) => {
 const {token}=useAuthStore();
  
  // explicitly return false to cancel the navigation
  if(to.meta.requiresAuth && !token) return '/login'

   if(to.meta.noAuth && token) return '/packages'

  return true
})

export default router
