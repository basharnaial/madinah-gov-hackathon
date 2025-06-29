import { createRouter, createWebHistory, type RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    name: 'Home',
    component: () => import('@/views/Home.vue'),
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import('@/views/Register.vue'),
  },
  {
    path: '/thank-you',
    name: 'ThankYou',
    component: () => import('@/views/ThankYou.vue'),
  },
  {
    path: '/admin/login',
    name: 'AdminLogin',
    component: () => import('@/views/AdminLogin.vue'),
    meta: { guestOnly: true },
  },
  {
    path: '/admin/dashboard',
    name: 'AdminDashboard',
    component: () => import('@/views/AdminDashboard.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/admin/timeline',
    name: 'TimelineManagement',
    component: () => import('@/views/admin/TimelineManagement.vue'),
    meta: { requiresAuth: true },
  },
  {
    path: '/:catchAll(.*)',
    redirect: '/',
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior() {
    return { top: 0 };
  },
});

// Navigation guards for admin auth
import { useAdminStore } from '@/stores/admin';
router.beforeEach((to, from, next) => {
  const adminStore = useAdminStore();
  if (to.meta.requiresAuth && !adminStore.isAuthenticated) {
    next({ name: 'AdminLogin' });
  } else if (to.meta.guestOnly && adminStore.isAuthenticated) {
    next({ name: 'AdminDashboard' });
  } else {
    next();
  }
});

export default router; 