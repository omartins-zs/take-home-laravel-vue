<template>
  <v-btn
    icon
    @click="toggleDarkMode"
  >
    <v-icon>{{ isDark ? 'mdi-white-balance-sunny' : 'mdi-weather-night' }}</v-icon>
  </v-btn>
</template>

<script>
export default {
  computed: {
    isDark() {
      return this.$vuetify.theme.dark
    },
  },
  methods: {
    toggleDarkMode() {
      this.$vuetify.theme.dark = !this.$vuetify.theme.dark
    },
  },
}
</script>
