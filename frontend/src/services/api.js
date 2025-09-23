// import axios from 'axios'

// export default axios.create({
//   baseURL: 'http://localhost:8081/api',
//   headers: {
//     Accept: 'application/json',
//   }
// })

import axios from "axios";
import { EventBus } from "@/event-bus";

const api = axios.create({
  baseURL:
    process.env.VUE_APP_API_BASE_URL ||
    //  "http://localhost:8081/api",
    "http://backend:8081/api",
  timeout: 10000,
  headers: { Accept: "application/json" },
});

api.interceptors.response.use(
  (res) => res,
  (err) => {
    if (!err.response) {
      EventBus.$emit("api-toast", {
        message: "Não foi possível conectar à API.",
        color: "error",
      });
    } else if (err.response.status >= 500) {
      EventBus.$emit("api-toast", {
        message: err.response.data?.message || "Erro interno no servidor.",
        color: "error",
      });
    }
    return Promise.reject(err);
  }
);

export default api;
