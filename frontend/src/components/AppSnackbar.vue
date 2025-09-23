<template>
  <v-snackbar
    v-model="visible"
    :timeout="timeout"
    top
    right
    :color="color"
    elevation="6"
  >
    <div class="d-flex align-center">
      <v-icon left v-if="icon" class="mr-2">{{ icon }}</v-icon>
      <span v-html="message"></span>
    </div>

    <template v-slot:action>
      <v-btn text @click="visible = false">Fechar</v-btn>
    </template>
  </v-snackbar>
</template>

<script>
import { EventBus } from "@/event-bus";

export default {
  name: "AppSnackbar",
  data() {
    return {
      visible: false,
      message: "",
      timeout: 6000,
      color: undefined,
      icon: undefined,
    };
  },
  created() {
    EventBus.$on("api-toast", this.showToast);
    // opcional: escuta para toasts customizados da app
    EventBus.$on("toast", this.showToast);
  },
  beforeDestroy() {
    EventBus.$off("api-toast", this.showToast);
    EventBus.$off("toast", this.showToast);
  },
  methods: {
    showToast(payload = {}) {
      // payload: { message, color, timeout, icon }
      this.message = payload.message || "Ocorreu um erro";
      this.timeout = payload.timeout != null ? payload.timeout : 6000;
      this.color = payload.color || undefined;
      this.icon = payload.icon || this.iconForColor(this.color);
      this.visible = true;
    },
    iconForColor(color) {
      if (!color) return undefined;
      if (color.includes("error")) return "mdi-alert-circle-outline";
      if (color.includes("success")) return "mdi-check-circle-outline";
      if (color.includes("warning")) return "mdi-alert-outline";
      return undefined;
    },
  },
};
</script>

<style scoped>
/* opcional: ajustes visuais */
</style>
