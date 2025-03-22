// services/api.js
import axios from 'axios';

const client = axios.create({
  baseURL: import.meta.env.VITE_BACKEND_URL,
  headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
  },
});

client.interceptors.request.use(
    (config) => {
      const token = localStorage.getItem("token");
      if (token) {
        config.headers["Authorization"] = `Bearer ${token}`;
      }
      return config;
    },
    (error) => {
      return Promise.reject(error);
    }
  );

export default client;



