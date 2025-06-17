// src/router/index.js
import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    { path: '/', redirect: '/exames' },
    { path: '/exames', component: () => import('@/views/ExameList.vue') },
    { path: '/pacotes', component: () => import('@/views/PacoteList.vue') },
    { path: '/solicitacao', component: () => import('@/views/SolicitacaoExames.vue') },
  ]
})
