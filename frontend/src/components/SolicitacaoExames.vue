<template>
  <v-container>
    <h2>Solicitação de Exames</h2>
    <v-row>
      <v-col cols="12" md="6">
        <ExameList />
      </v-col>
      <v-col cols="12" md="6">
        <PacoteList />
      </v-col>
    </v-row>
    <v-btn color="success" @click="printPdf">Imprimir</v-btn>
    <GrupoPdfPreview :exams="selectedExams" />
  </v-container>
</template>

<script>
import ExameList from './ExameList.vue'
import PacoteList from './PacoteList.vue'
import GrupoPdfPreview from '@/components/GrupoPdfPreview.vue'
export default {
  name: 'SolicitacaoExames',
  components: { ExameList, PacoteList, GrupoPdfPreview },
  data: () => ({ selectedExams: [] }),
  methods: {
    printPdf() {
      // implementação de download ou abrir nova aba com PDF
    }
  }
}
</script>
