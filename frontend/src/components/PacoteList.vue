<template>
  <v-container>
    <h2>Packages</h2>
    <Modal title="New Package">
      <PacoteForm :exams="exams" @created="onCreated" slot="body" />
      <template #activator>
        <v-btn color="primary">New Package</v-btn>
      </template>
    </Modal>
    <v-row>
      <v-col cols="12" md="6" v-for="pkg in packages" :key="pkg.id">
        <v-card>
          <v-card-title>{{ pkg.name }}</v-card-title>
          <v-card-text>
            <p>{{ pkg.observations }}</p>
            <v-list dense>
              <v-list-item v-for="ex in pkg.exams" :key="ex.id">
                <v-list-item-content>{{ ex.name }}</v-list-item-content>
              </v-list-item>
            </v-list>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import Modal from '@/components/Modal.vue'
import PacoteForm from '@/components/PacoteForm.vue'
import api from '@/services/api'
export default {
  name: 'PacoteList',
  components: { Modal, PacoteForm },
  data: () => ({ packages: [], exams: [] }),
  methods: {
    async fetchData() {
      const [pkgRes, exRes] = await Promise.all([
        api.get('/packages'), api.get('/exams')
      ])
      this.packages = pkgRes.data.data || pkgRes.data
      this.exams = exRes.data.data || exRes.data
    },
    onCreated() { this.fetchData() }
  },
  created() { this.fetchData() }
}
</script>