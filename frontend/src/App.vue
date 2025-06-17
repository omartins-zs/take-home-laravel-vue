<template>
  <v-app>
    <v-app-bar
      app
      :color="isDark ? 'grey darken-4' : 'primary'"
      :dark="isDark"
    >
      <v-toolbar-title>My EyeCare</v-toolbar-title>
      <v-spacer />
      <v-btn
        text
        to="/exames"
        router
      >
        Exames
      </v-btn>
      <v-btn
        text
        to="/pacotes"
        router
      >
        Pacotes
      </v-btn>
      <v-btn
        text
        to="/solicitacao"
        router
      >
        Solicitar
      </v-btn>
      <v-btn
        icon
        @click="toggleTheme"
      >
        <v-icon>{{ isDark ? 'mdi-white-balance-sunny' : 'mdi-weather-night' }}</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <v-container class="mt-4">
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'App',
  computed: {
    isDark() {
      return this.$vuetify.theme.dark;
    }
  },
  mounted() {
    const storedTheme = localStorage.getItem('theme_dark');
    if (storedTheme !== null) {
      this.$vuetify.theme.dark = storedTheme === 'true';
    }
  },
  methods: {
    toggleTheme() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark;
      localStorage.setItem('theme_dark', this.$vuetify.theme.dark);
    }
  }
};
</script>
