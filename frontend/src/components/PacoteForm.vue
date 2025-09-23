<template>
  <v-card
    class="pa-4"
    elevation="2"
  >
    <v-form
      ref="form"
      v-model="valid"
      @submit.prevent="submit"
    >
      <v-text-field
        v-model="form.name"
        label="Package Name"
        :rules="[v => !!v || 'Name is required']"
        required
      />
      <v-textarea
        v-model="form.observations"
        label="Observations"
        auto-grow
      />
      <v-select
        v-model="form.exam_ids"
        :items="exams"
        item-text="name"
        item-value="id"
        label="Select Exams"
        multiple
        chips
        :rules="[v => v.length > 0 || 'Select at least one exam']"
        required
      />
      <v-btn
        color="primary"
        :disabled="!valid"
        type="submit"
      >
        Create Package
      </v-btn>
    </v-form>
  </v-card>
</template>

<script>
import api from '@/services/api'
export default {
  name: 'PacoteForm',
  props: {
  exams: {
      type: Array,
      default: () => []
    }
  },
  data: () => ({
    valid: false,
    form: { name: '', observations: '', exam_ids: [] }
  }),
  methods: {
    async submit() {
      if (!this.valid) return
      const res = await api.post('/packages', this.form)
      this.$emit('created', res.data.data || res.data)
      this.form = { name: '', observations: '', exam_ids: [] }
      this.$refs.form.resetValidation()
    }
  }
}
</script>