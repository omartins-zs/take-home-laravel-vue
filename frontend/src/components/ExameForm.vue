<template>
  <v-form ref="form" @submit.prevent="submit">
    <v-text-field
      v-model="form.name"
      label="Name"
      required
    />
    <v-select
      v-model="form.laterality"
      :items="['OD','OE','AO']"
      label="Laterality"
      clearable
    />
    <v-text-field
      v-model="form.comment"
      label="Comment"
      required
    />
    <v-select
      v-model="form.group"
      :items="['Individual','Grupo 1','Grupo 2','Grupo 3','Grupo 4','Grupo 5']"
      label="Group"
      required
    />
    <v-btn color="primary" type="submit">Add Exam</v-btn>
  </v-form>
</template>

<script>
import api from '@/services/api'
export default {
  name: 'ExameForm',
  data: () => ({
    form: { name: '', laterality: null, comment: '', group: 'Individual' }
  }),
  methods: {
    async submit() {
      const res = await api.post('/exams', this.form)
      this.$emit('created', res.data)
      this.form = { name: '', laterality: null, comment: '', group: 'Individual' }
    }
  }
}
</script>