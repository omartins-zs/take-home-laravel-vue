// src/plugins/vuetify.js

import Vue from 'vue'
import Vuetify from 'vuetify/lib/framework'

Vue.use(Vuetify)

export default new Vuetify({
  theme: {
    dark: false, // tema padrão (claro)
    themes: {
      light: {
        primary: '#1976D2',
        secondary: '#424242',
        accent: '#82B1FF',
        error: '#FF5252',
        info: '#2196F3',
        success: '#4CAF50',
        warning: '#FB8C00',
      },
      dark: {
        primary: '#90CAF9',
        secondary: '#EEEEEE',
        accent: '#FF4081',
        error: '#EF9A9A',
        info: '#64B5F6',
        success: '#81C784',
        warning: '#FFB74D',
      },
    },
  },
})
