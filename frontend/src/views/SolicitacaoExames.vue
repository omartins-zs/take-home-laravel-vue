<template>
  <v-container>
    <v-card class="pa-6">
      <v-card-title>
        Solicitação de Exames
        <v-spacer />
        <v-btn
          icon
          @click="clearAll"
        >
          <v-icon>mdi-delete-outline</v-icon>
        </v-btn>
      </v-card-title>

      <v-row class="mb-4">
        <v-col
          cols="12"
          md="6"
        >
          <v-autocomplete
            v-model="selectedExam"
            :items="allExams"
            item-text="name"
            item-value="id"
            label="Selecionar exame"
            clearable
            @change="addAvulso"
          />
        </v-col>
        <v-col
          cols="12"
          md="6"
        >
          <package-select-modal @apply="applyPackages" />
        </v-col>
      </v-row>

      <div
        v-for="(group, idx) in examGroups"
        :key="idx"
        class="mb-6"
      >
        <v-card
          outlined
          class="pa-4"
        >
          <div class="d-flex align-center mb-2">
            <strong>{{ group.title }}</strong>
            <v-spacer />
            <v-select
              v-model="group.printGroup"
              :items="impressaoOptions"
              dense
              hide-details
              outlined
              label="Impressão"
              class="mr-4"
            />
            <v-btn
              text
              small
              color="red"
              @click="removeGroup(idx)"
            >
              Remover pacote
            </v-btn>
          </div>
          <v-simple-table dense>
            <thead>
              <tr>
                <th>Exame</th>
                <th>Lateralidade</th>
                <th>Comentário</th>
                <th>Impressão</th>
                <th />
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(exam, i) in group.exams"
                :key="i"
              >
                <td>{{ exam.name }}</td>
                <td style="width:150px">
                  <v-select
                    v-model="exam.laterality"
                    :items="lateralityOptions"
                    dense
                    hide-details
                    outlined
                  />
                </td>
                <td style="width:200px">
                  <v-text-field
                    v-model="exam.comment"
                    placeholder="Descrever"
                    dense
                    hide-details
                    outlined
                  />
                </td>
                <td style="width:130px">
                  <v-select
                    v-model="exam.groupPrint"
                    :items="impressaoOptions"
                    dense
                    hide-details
                    outlined
                  />
                </td>
                <td>
                  <v-btn
                    icon
                    small
                    color="red"
                    @click="removeExam(idx, i)"
                  >
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </td>
              </tr>
            </tbody>
          </v-simple-table>
          <v-textarea
            v-model="group.observation"
            label="Observação"
            auto-grow
            dense
            hide-details
            outlined
            class="mt-4"
          />
        </v-card>
      </div>

      <v-row
        justify="center"
        class="mt-4"
      >
        <v-btn
          color="success"
          class="mr-4"
          @click="printAvulsosPdf"
        >
          Imprimir Exames Avulsos
        </v-btn>
        <v-btn
          color="primary"
          :disabled="!examGroups.length"
          @click="printPdf"
        >
          Imprimir PDF Customizado
        </v-btn>
      </v-row>
    </v-card>
  </v-container>
</template>

<script>
import api from '@/services/api'
import PackageSelectModal from '@/components/PackageSelectModal.vue'

export default {
  name: 'SolicitacaoExames',
  components: { PackageSelectModal },
  data() {
    return {
      allExams: [],
      selectedExam: null,
      examGroups: [],
      lateralityOptions: ['OD', 'OE', 'AO'],
      impressaoOptions: ['Grupo 1', 'Grupo 2', 'Grupo 3', 'Grupo 4', 'Grupo 5'],
    }
  },
  created() {
    this.fetchAllExams()
  },
  methods: {
    async fetchAllExams() {
      const res = await api.get('/exams')
      this.allExams = res.data.data || res.data
    },
    addAvulso(examId) {
      if (!examId) return

      const exam = this.allExams.find(e => e.id === examId)
      if (!exam) return

      let avulsosGroup = this.examGroups.find(g => g.title === 'Exames Avulsos')

      if (!avulsosGroup) {
        avulsosGroup = {
          title: 'Exames Avulsos',
          exams: [],
          printGroup: this.impressaoOptions[0],
          observation: '',
        }
        this.examGroups.push(avulsosGroup)
      }

      avulsosGroup.exams.push({
        ...exam,
        laterality: null,
        comment: '',
        groupPrint: this.impressaoOptions[0],
      })

      this.selectedExam = null
    },  
    applyPackages(pkgs) {
      pkgs.forEach(pkg => {
        this.examGroups.push({
          title: pkg.name,
          exams: pkg.exams.map(ex => ({
            ...ex,
            laterality: ex.laterality || null,
            comment: ex.comment || '',
            groupPrint: pkg.name,
          })),
          printGroup: pkg.name,
          observation: pkg.observations || '',
        })
      })
    },
    removeGroup(gIdx) { this.examGroups.splice(gIdx, 1) },
    removeExam(gIdx, eIdx) { this.examGroups[gIdx].exams.splice(eIdx, 1) },
    clearAll() { this.examGroups = [] },

    printAvulsosPdf() {
      window.open(
        `${api.defaults.baseURL}/exams/pdf/download?avulsos=1`,
        '_blank'
      )
    },
    printPdf() {
      if (!this.examGroups.length) return

      try {
        const params = encodeURIComponent(JSON.stringify(this.examGroups))
        window.open(`${api.defaults.baseURL}/exams/pdf/download?groups=${params}`, '_blank')
      } catch (err) {
        console.error(err)
        alert('Erro ao gerar PDF. Verifique os dados enviados.')
      }
    }
  }
}
</script>
