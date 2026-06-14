import { createApp } from "vue";
import "./style.css"; // Mengimpor Tailwind yang sudah kita setting di atas
import App from "./App.vue";
import AOS from "aos";
import "aos/dist/aos.css";

// Inisialisasi AOS untuk animasi interaktif
AOS.init({
  duration: 1000,
  once: true,
});

createApp(App).mount("#app");
