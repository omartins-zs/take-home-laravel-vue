<template>
  <v-list-item>
    <v-list-item-content>
      <v-list-item-title>{{ exam.name }} ({{ exam.group }})</v-list-item-title>
      <v-list-item-subtitle>{{ exam.comment }}</v-list-item-subtitle>
    </v-list-item-content>
  </v-list-item>
</template>

<script>
export default { name: 'ExameItem', props: { exam: Object } }
</script>