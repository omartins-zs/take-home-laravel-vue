<template>
  <v-form ref="form" @submit.prevent="submit">
    <v-text-field
      v-model="form.name"
      label="Name"
      required
    />
    <v-textarea
      v-model="form.observations"
      label="Observations"
    />
    <v-select
      v-model="form.exam_ids"
      :items="exams"
      item-text="name"
      item-value="id"
      label="Exams"
      multiple
      chips
    />
    <v-btn color="primary" type="submit">Create Package</v-btn>
  </v-form>
</template>

<script>
import api from '@/services/api'
export default {
  name: 'PacoteForm',
  props: { exams: Array },
  data: () => ({ form: { name: '', observations: '', exam_ids: [] } }),
  methods: {
    async submit() {
      const res = await api.post('/packages', this.form)
      this.$emit('created', res.data)
      this.form = { name: '', observations: '', exam_ids: [] }
    }
  }
}
</script>