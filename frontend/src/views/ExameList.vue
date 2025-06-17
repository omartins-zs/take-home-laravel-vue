<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="4"
      >
        <exame-form @created="fetchExams" />
      </v-col>
      <v-col
        cols="12"
        md="8"
      >
        <v-card
          elevation="1"
          class="pa-4"
        >
          <h2 class="mb-4">
            Exams
          </h2>
          <v-data-table
            :headers="headers"
            :items="exams"
            class="elevation-1"
            dense
          >
            <template
              slot="item.group"
              slot-scope="{ item }"
            >
              <v-chip small>
                {{ item.group }}
              </v-chip>
            </template>
          </v-data-table>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import ExameForm from '@/components/ExameForm.vue'
import api from '@/services/api'
export default {
  name: 'ExameList',
  components: { ExameForm },
  data: () => ({
    exams: [],
    headers: [
      { text: 'Name', value: 'name' },
      { text: 'Laterality', value: 'laterality' },
      { text: 'Comment', value: 'comment' },
      { text: 'Group', value: 'group' }
    ]
  }),
  created() {
    this.fetchExams()
  },
  methods: {
    async fetchExams() {
      const res = await api.get('/exams')
      this.exams = res.data.data || res.data
    }
  }
}
</script>
