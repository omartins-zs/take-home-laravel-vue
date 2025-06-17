<template>
  <v-dialog
    v-model="visible"
    max-width="600px"
  >
    <slot
      name="activator"
      :on="{ click: open }"
    />
    <v-card>
      <v-toolbar
        dark
        color="primary"
      >
        <v-toolbar-title>{{ title }}</v-toolbar-title>
        <v-spacer />
        <v-btn
          icon
          @click="close"
        >
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <slot name="body" />
      </v-card-text>
      <v-divider />
      <v-card-actions>
        <slot name="footer">
          <v-spacer />
          <v-btn
            text
            @click="close"
          >
            Cancel
          </v-btn>
        </slot>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "BaseModal",
  props: {
    title: { type: String, default: "Modal Title" },
  },
  data: () => ({ visible: false }),
  methods: {
    open() {
      this.visible = true;
    },
    close() {
      this.visible = false;
      this.$emit("close");
    },
  },
};
</script>
