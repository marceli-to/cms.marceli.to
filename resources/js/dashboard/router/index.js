import { createRouter, createWebHistory } from 'vue-router'

import Components from '@/views/Components.vue'

const routes = [
  {
    path: '/dashboard',
    redirect: '/dashboard/components',
  },
  {
    path: '/dashboard/components',
    name: 'components',
    component: Components,
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router
