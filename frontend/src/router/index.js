import Vue from 'vue'
import Router from 'vue-router'

import ExameList from '@/views/ExameList.vue'
import PacoteList from '@/views/PacoteList.vue'
import SolicitacaoExames from '@/views/SolicitacaoExames.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    { path: '/', redirect: '/solicitacao' },
    { path: '/exames', component: ExameList },
    { path: '/pacotes', component: PacoteList },
    { path: '/solicitacao', component: SolicitacaoExames }
  ]
})
