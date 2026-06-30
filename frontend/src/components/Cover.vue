<script setup>
import { ref, onMounted } from "vue";

defineEmits(["buka"]);

const namaTamu = ref("Tamu Undangan");

onMounted(() => {
  // Mengambil parameter 'to' dari URL
  const params = new URLSearchParams(window.location.search);
  const to = params.get("to");

  if (to) {
    // Mengganti karakter plus (+) atau %20 menjadi spasi agar rapi
    namaTamu.value = decodeURIComponent(to);
  }
});
</script>

<template>
  <section
    class="h-screen flex items-center justify-center p-6 bg-[#f8f5f2] relative overflow-hidden"
  >
    <div class="absolute inset-0 z-0">
      <img
        src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&q=80"
        class="w-full h-full object-cover opacity-40 scale-110 animate-[slowZoom_20s_infinite]"
        alt="Wedding Background"
      />
      <div
        class="absolute inset-0 bg-gradient-to-b from-transparent via-white/20 to-[#f8f5f2]"
      ></div>
    </div>

    <div
      class="absolute w-[500px] h-[500px] border border-teal-deep/10 rounded-full -top-20 -right-20 animate-pulse"
    ></div>
    <div
      class="absolute w-[300px] h-[300px] border border-teal-deep/10 rounded-full -bottom-10 -left-10"
    ></div>

    <div
      data-aos="fade-up"
      data-aos-duration="1500"
      class="z-10 text-center space-y-6"
    >
      <div class="space-y-2">
        <span
          class="text-teal-deep uppercase tracking-[0.5em] text-[10px] font-black opacity-70"
        >
          The Wedding Celebration of
        </span>

        <div class="py-4">
          <h1
            class="text-6xl md:text-8xl font-serif text-charcoal leading-tight"
          >
            Dzikri <span class="text-teal-deep font-light">&</span> Mita
          </h1>
        </div>

        <div class="flex items-center justify-center gap-4 text-charcoal/60">
          <div class="h-[1px] w-8 bg-teal-deep/30"></div>
          <p class="text-sm font-medium tracking-[0.2em] uppercase">
            14 . 12 . 2026
          </p>
          <div class="h-[1px] w-8 bg-teal-deep/30"></div>
        </div>
      </div>

      <div class="mt-12 space-y-4">
        <p class="text-[10px] uppercase tracking-widest text-charcoal/50">
          Tamu Undangan:
        </p>
        <div
          class="bg-white/60 backdrop-blur-md border border-white/80 py-4 px-8 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] inline-block min-w-[250px]"
        >
          <h2
            class="text-charcoal font-serif text-2xl italic tracking-wide capitalize"
          >
            {{ Faiz (bogez) & Partner }}
          </h2>
        </div>
      </div>

      <div class="pt-6">
        <button
          @click="$emit('buka')"
          class="group relative overflow-hidden bg-charcoal text-cream-light px-12 py-4 rounded-full font-bold transition-all shadow-2xl hover:shadow-teal-deep/20"
        >
          <span class="relative z-10 uppercase tracking-[0.2em] text-xs"
            >Buka Undangan</span
          >
          <div
            class="absolute inset-0 bg-teal-deep translate-y-full group-hover:translate-y-0 transition-transform duration-500"
          ></div>
        </button>
      </div>
    </div>
  </section>
</template>

<style scoped>
@keyframes slowZoom {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
  }
}

h1 {
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.05);
}

/* Animasi halus untuk nama tamu agar terlihat lebih "hidup" */
h2 {
  animation: fadeInDown 1.2s ease-out;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
