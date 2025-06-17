import Vue from 'vue'
import App from './App.vue'
import router from './router'

// Vuetify
import Vuetify from 'vuetify/lib'
import 'vuetify/dist/vuetify.min.css'

Vue.config.productionTip = false
Vue.use(Vuetify)

const vuetify = new Vuetify({
  theme: {
    dark: true, 
  },
})

new Vue({
  router,
  vuetify,     
  render: h => h(App)
}).$mount('#app')
