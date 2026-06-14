<script setup>
import { onMounted, onUnmounted, ref } from "vue";

const scrollY = ref(0);

const handleScroll = () => {
  scrollY.value = window.scrollY;
};

onMounted(() => {
  window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
  window.removeEventListener("scroll", handleScroll);
});

// Fungsi parallax (Multi-depth)
const parallaxStyle = (factor = 0.05) => {
  return {
    transform: `translateY(${scrollY.value * factor}px) scale(1.15)`,
  };
};

// -----------------------------------------------------------
// PATH GAMBAR DARI FOLDER PUBLIC/IMAGES/
// Pastikan nama file dan ekstensinya (.jpg/.webp) sudah benar
// -----------------------------------------------------------

const foto1_Portrait = "/images/foto1.jpeg"; // Foto Tinggi
const foto2_Square = "/images/foto2.jpeg"; // Foto Kotak
const foto3_Landscape = "/images/foto3.jpeg"; // Foto Lebar
const foto4_Square = "/images/foto4.jpeg"; // Foto Kotak
const foto5_Portrait = "/images/foto5.jpeg"; // Foto Tinggi
const foto6_Square = "/images/foto6.jpeg"; // Foto Kotak
const foto7_Square = "/images/foto7.jpeg"; // Foto Kotak

// -----------------------------------------------------------
</script>

<template>
  <section class="py-24 bg-[#fdfbf9] overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 md:px-6">
      <div class="text-center mb-16" data-aos="fade-up">
        <span
          class="text-teal-deep uppercase tracking-[0.5em] text-[10px] font-black opacity-60"
          >Our Beautiful Journey</span
        >
        <h2
          class="text-5xl font-serif text-charcoal mt-3 relative inline-block italic"
        >
          Gallery
          <span
            class="absolute -bottom-2 left-0 w-full h-[1px] bg-teal-deep/20"
          ></span>
        </h2>
      </div>

      <div
        class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5 auto-rows-[180px] md:auto-rows-[220px]"
      >
        <div
          data-aos="fade-up"
          class="row-span-2 col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto1_Portrait"
            :style="parallaxStyle(0.04)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="100"
          class="col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto2_Square"
            :style="parallaxStyle(0.02)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="200"
          class="col-span-2 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto3_Landscape"
            :style="parallaxStyle(0.01)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="300"
          class="col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-sm"
        >
          <img
            :src="foto4_Square"
            :style="parallaxStyle(0.03)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="400"
          class="row-span-2 col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto5_Portrait"
            :style="parallaxStyle(0.05)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="500"
          class="col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto6_Square"
            :style="parallaxStyle(0.02)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>

        <div
          data-aos="fade-up"
          data-aos-delay="600"
          class="col-span-1 rounded-2xl md:rounded-3xl overflow-hidden group relative shadow-md"
        >
          <img
            :src="foto7_Square"
            :style="parallaxStyle(0.04)"
            class="w-full h-[125%] object-cover absolute top-[-12%] grayscale group-hover:grayscale-0 transition-all duration-1000"
          />
        </div>
      </div>

      <div class="mt-20 text-center" data-aos="fade-up">
        <p class="font-serif italic text-charcoal/40 text-lg md:text-xl">
          "Every picture tells a story of our love."
        </p>
      </div>
    </div>
  </section>
</template>

<style scoped>
img {
  will-change: transform;
  pointer-events: none;
  backface-visibility: hidden;
}

.shadow-md {
  box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
}

.rounded-2xl,
.rounded-3xl {
  -webkit-mask-image: -webkit-radial-gradient(white, black);
  mask-image: -webkit-radial-gradient(white, black);
}

.transition-all {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}
</style>
