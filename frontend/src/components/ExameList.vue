<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="8">
        <h2>Exams</h2>
        <ExameForm @created="fetchExams" />
        <v-list>
          <ExameItem v-for="exam in exams" :key="exam.id" :exam="exam" />
        </v-list>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ExameForm from '@/components/ExameForm.vue'
import ExameItem from '@/components/ExameItem.vue'
import api from '@/services/api'
export default {
  name: 'ExameList',
  components: { ExameForm, ExameItem },
  data: () => ({ exams: [] }),
  methods: {
    async fetchExams() {
      const res = await api.get('/exams')
      this.exams = res.data.data || res.data
    }
  },
  created() { this.fetchExams() }
}
</script>