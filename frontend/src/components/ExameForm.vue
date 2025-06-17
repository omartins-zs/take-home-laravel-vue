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
        label="Exam Name"
        :rules="[(v) => !!v || 'Name is required']"
        required
      />
      <v-select
        v-model="form.laterality"
        :items="['OD', 'OE', 'AO']"
        label="Laterality"
        clearable
      />
      <v-text-field
        v-model="form.comment"
        label="Comment"
        :rules="[(v) => !!v || 'Comment is required']"
        required
      />
      <v-select
        v-model="form.group"
        :items="[
          'Individual',
          'Grupo 1',
          'Grupo 2',
          'Grupo 3',
          'Grupo 4',
          'Grupo 5',
        ]"
        label="Group"
        :rules="[(v) => !!v || 'Group is required']"
        required
      />
      <v-btn
        color="primary"
        :disabled="!valid"
        type="submit"
      >
        Add Exam
      </v-btn>
    </v-form>
  </v-card>
</template>

<script>
import api from "@/services/api";
export default {
  name: "ExameForm",
  data: () => ({
    valid: false,
    form: { name: "", laterality: null, comment: "", group: "Individual" },
  }),
  methods: {
    async submit() {
      if (!this.valid) return;
      const res = await api.post("/exams", this.form);
      this.$emit("created", res.data.data || res.data);
      this.form = {
        name: "",
        laterality: null,
        comment: "",
        group: "Individual",
      };
      this.$refs.form.resetValidation();
    },
  },
};
</script>
