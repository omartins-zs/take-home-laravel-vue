const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: ["vuetify"],
  css: {
    loaderOptions: {
      stylus: {},
    },
  },
  devServer: {
    proxy: { "^/api": { target: "http://localhost:8000", changeOrigin: true } },
  },
});
