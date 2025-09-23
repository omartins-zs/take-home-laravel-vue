<template>
  <div>
    <v-btn
      color="primary"
      @click="visible = true"
    >
      Pacote de exames
    </v-btn>

    <v-dialog
      v-model="visible"
      max-width="800px"
    >
      <v-card>
        <v-toolbar
          flat
          color="white"
        >
          <v-toolbar-title>Pacote de exames</v-toolbar-title>
          <v-spacer />
          <v-btn
            icon
            @click="visible = false"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-toolbar>

        <v-card-text>
          <v-text-field
            v-model="search"
            placeholder="Buscar exames"
            append-icon="mdi-magnify"
            clearable
          />

          <v-data-table
            :options.sync="options"
            :headers="headers"
            :items="packages"
            :server-items-length="total"
            :loading="loading"
            class="elevation-1"
            item-key="id"
          >
            <template
              slot="item.select"
              slot-scope="{ item }"
            >
              <v-checkbox
                v-model="selected"
                :value="item"
              />
            </template>

            <template
              slot="item.actions"
              slot-scope="{ item }"
            >
              <v-btn
                icon
                small
                @click="edit(item)"
              >
                <v-icon>mdi-pencil</v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-card-text>

        <v-divider />

        <v-card-actions>
          <v-pagination
            v-model="options.page"
            :length="pages"
          />
          <v-spacer />
          <v-btn
            color="secondary"
            @click="newPackage"
          >
            Novo Pacote de Exames
          </v-btn>
          <v-btn
            color="success"
            :disabled="selected.length === 0"
            @click="applySelected"
          >
            Usar Pacote na Consulta
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import api from "@/services/api";

export default {
  name: "PackageSelectModal",
  data() {
    return {
      visible: false,
      search: "",
      packages: [],
      total: 0,
      loading: false,
      selected: [],
      options: {
        page: 1,
        itemsPerPage: 5,
      },
      headers: [
        { text: "", value: "select", sortable: false },
        { text: "Pacote de Exame", value: "name" },
        { text: "Observação", value: "observations" },
        { text: "Ações", value: "actions", sortable: false },
      ],
    };
  },
  computed: {
    pages() {
      return Math.ceil(this.total / this.options.itemsPerPage);
    },
  },
  watch: {
    options: { handler: "fetchPackages", deep: true },
    search: "fetchPackages",
  },
  methods: {
    async fetchPackages() {
      this.loading = true;
      const { page, itemsPerPage } = this.options;
      const res = await api.get("/packages", {
        params: { page, per_page: itemsPerPage, search: this.search },
      });
      this.packages = res.data.data;
      this.total = res.data.meta.total;
      this.loading = false;
    },
    edit(pkg) {
      this.$emit("edit-package", pkg);
    },
    async destroy(id) {
      await api.delete(`/packages/${id}`);
      this.fetchPackages();
    },
    newPackage() {
      this.$emit("new-package");
    },
    applySelected() {
      this.$emit("apply", this.selected);
      this.visible = false;
    },
  },
};
</script>
