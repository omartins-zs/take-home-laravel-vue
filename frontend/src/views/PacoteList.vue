<template>
  <v-app class="d-flex flex-column fill-height pa-4">
    <div class="d-flex justify-end mb-4">
      <base-modal title="New Package">
        <template #activator>
          <v-btn
            color="primary"
            dark
          >
            New Package
          </v-btn>
        </template>
        <template #body>
          <pacote-form
            :exams="exams"
            @created="refresh"
          />
        </template>
      </base-modal>
    </div>

    <v-card
      elevation="1"
      class="flex-grow-1 d-flex flex-column pa-4"
    >
      <h2 class="mb-4">
        Packages
      </h2>
      <v-data-table
        :headers="headers"
        :items="packages"
        class="elevation-1 flex-grow-1"
        dense
      >
        <template #item.exams="{ item }">
          <div class="d-flex flex-wrap">
            <v-chip
              v-for="ex in item.exams"
              :key="ex.id"
              small
              class="ma-1"
            >
              {{ ex.name }}
            </v-chip>
          </div>
        </template>
      </v-data-table>
    </v-card>
  </v-app>
</template>

<script>
import BaseModal from '@/components/BaseModal.vue'
import PacoteForm from '@/components/PacoteForm.vue'
import api from '@/services/api'

export default {
  name: 'PacoteList',
  components: { BaseModal, PacoteForm },
  data: () => ({
    packages: [],
    exams: [],
    headers: [
      { text: 'Name', value: 'name' },
      { text: 'Observations', value: 'observations' },
      { text: 'Exams', value: 'exams' }
    ]
  }),
  created() {
    this.fetch()
  },
  methods: {
    async fetch() {
      const [pkgRes, exRes] = await Promise.all([
        api.get('/packages'),
        api.get('/exams')
      ])
      this.packages = pkgRes.data.data || pkgRes.data
      this.exams = exRes.data.data || exRes.data
    },
    refresh() {
      this.fetch()
    }
  }
}
</script>

<style scoped>
html, body, #app {
  height: 100%;
  margin: 0;
}
</style>
