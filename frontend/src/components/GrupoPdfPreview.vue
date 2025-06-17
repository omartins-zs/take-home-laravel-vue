<template>
  <v-expansion-panels>
    <v-expansion-panel
      v-for="(exs, grp) in groupedExams"
      :key="grp"
    >
      <v-expansion-panel-header>Group: {{ grp }}</v-expansion-panel-header>
      <v-expansion-panel-content>
        <v-list dense>
          <v-list-item
            v-for="ex in exs"
            :key="ex.id"
          >
            <v-list-item-content>
              <v-list-item-title>{{ ex.name }}</v-list-item-title>
              <v-list-item-subtitle>{{ ex.comment }}</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-expansion-panel-content>
    </v-expansion-panel>
  </v-expansion-panels>
</template>

<script>
export default {
  name: 'GrupoPdfPreview',
  props: { exams: Array },
  computed: {
    groupedExams() {
      return this.exams.reduce((acc, e) => {
        (acc[e.group] = acc[e.group] || []).push(e)
        return acc
      }, {})
    }
  }
}
</script>
