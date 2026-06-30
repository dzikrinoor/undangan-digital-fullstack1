<script setup>
import { ref, onMounted } from "vue";

// Target waktu: 14 Desember 2026 jam 08:00 Pagi
const targetDate = new Date("2026/12/14 08:00:00").getTime();

const days = ref(0);
const hours = ref(0);
const minutes = ref(0);
const seconds = ref(0);

const updateCountdown = () => {
  const now = new Date().getTime();
  const distance = targetDate - now;

  if (distance > 0) {
    days.value = Math.floor(distance / (1000 * 60 * 60 * 24));
    hours.value = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
    );
    minutes.value = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    seconds.value = Math.floor((distance % (1000 * 60)) / 1000);
  } else {
    days.value = 0;
    hours.value = 0;
    minutes.value = 0;
    seconds.value = 0;
  }
};

onMounted(() => {
  updateCountdown();
  setInterval(updateCountdown, 1000);
});
</script>

<template>
  <section class="py-20 relative overflow-hidden bg-[#fdfbf9]">
    <div class="absolute inset-0 z-0 opacity-[0.06] pointer-events-none">
      <img
        src="https://images.unsplash.com/photo-1522673607200-164883eeba3c?auto=format&fit=crop&q=80"
        class="w-full h-full object-cover"
      />
    </div>

    <div
      class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-20"
    >
      <div class="w-full h-[1px] bg-teal-deep"></div>
    </div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
      <div class="text-center mb-12" data-aos="fade-up">
        <h2
          class="text-[10px] uppercase tracking-[0.5em] text-teal-deep font-black mb-3"
        >
          Counting Down to the Big Day
        </h2>
        <div class="flex items-center justify-center gap-3">
          <div class="h-[1px] w-8 bg-charcoal/10"></div>
          <p class="text-sm font-serif italic text-charcoal/50">
            Save the Date: 14 Desember 2026
          </p>
          <div class="h-[1px] w-8 bg-charcoal/10"></div>
        </div>
      </div>

      <div
        class="flex gap-4 md:gap-10 justify-center items-center"
        data-aos="zoom-in"
      >
        <div
          v-for="(val, unit) in {
            Hari: days,
            Jam: hours,
            Menit: minutes,
            Detik: seconds,
          }"
          :key="unit"
          class="flex flex-col items-center group"
        >
          <div
            class="relative w-20 h-20 md:w-28 md:h-28 flex flex-col items-center justify-center transition-all duration-700 group-hover:-translate-y-2"
          >
            <div
              class="absolute inset-0 bg-white/80 border border-teal-deep/10 rounded-full shadow-xl shadow-teal-deep/5 group-hover:border-teal-deep/40 transition-all duration-500 backdrop-blur-sm"
            ></div>

            <span
              class="relative z-10 text-3xl md:text-5xl font-serif text-charcoal leading-none"
            >
              {{ val < 10 ? "0" + val : val }}
            </span>
            <span
              class="relative z-10 text-[8px] md:text-[10px] uppercase tracking-[0.3em] font-black text-teal-deep mt-2 opacity-70"
            >
              {{ unit }}
            </span>
          </div>
        </div>
      </div>

      <div class="mt-16 text-center" data-aos="fade-up">
        <div class="inline-block px-8 py-2 border-x border-teal-deep/20">
          <p
            class="text-[10px] tracking-[0.4em] uppercase font-bold text-charcoal/40 transition-all hover:text-teal-deep cursor-default"
          >
            — Our Love Story Begins —
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Menjamin angka tetap tenang dan tidak bergeser saat berganti detik */
span {
  font-feature-settings: "tnum";
  font-variant-numeric: tabular-nums;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.02);
}

/* Memperhalus tampilan di browser mobile */
.rounded-full {
  -webkit-mask-image: -webkit-radial-gradient(white, black);
}
</style>
