<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import Preloader from "./components/Preloader.vue";
import Cover from "./components/Cover.vue";
import Mempelai from "./components/Mempelai.vue";
import Acara from "./components/Acara.vue";
import Countdown from "./components/Countdown.vue";
import Galeri from "./components/Galeri.vue";
import RsvpForm from "./components/RsvpForm.vue";
import GuestBook from "./components/GuestBook.vue";

// State Management
const isLoading = ref(true);
const sudahBuka = ref(false);
const audioPlayer = ref(null);
const isPlaying = ref(false);
const daftarUcapan = ref([]);

// Fungsi mengambil data dari Laravel API
const ambilUcapan = async () => {
  try {
    const res = await axios.get("http://127.0.0.1:8000/api/rsvp");
    daftarUcapan.value = res.data;
  } catch (err) {
    console.error("Gagal memuat ucapan");
  }
};

// Logika Transisi dari Preloader ke Halaman
onMounted(async () => {
  // Ambil data terlebih dahulu
  await ambilUcapan();

  // Berikan waktu minimal 2.5 detik agar animasi Preloader terasa cinematic
  setTimeout(() => {
    isLoading.value = false;
  }, 2500);
});

// Logika Interaksi Undangan
const handleBuka = () => {
  sudahBuka.value = true;
  isPlaying.value = true;
  setTimeout(() => {
    if (audioPlayer.value) audioPlayer.value.play();
  }, 100);
};

const toggleMusic = () => {
  if (audioPlayer.value) {
    if (isPlaying.value) {
      audioPlayer.value.pause();
    } else {
      audioPlayer.value.play();
    }
    isPlaying.value = !isPlaying.value;
  }
};
</script>

<template>
  <div
    class="min-h-screen bg-cream-light text-charcoal font-sans selection:bg-teal-deep selection:text-white"
  >
    <transition name="fade">
      <Preloader v-if="isLoading" />
    </transition>

    <div v-if="!isLoading">
      <audio ref="audioPlayer" loop src="/backsound.mp3"></audio>

      <transition name="fade">
        <Cover v-if="!sudahBuka" @buka="handleBuka" />
      </transition>

      <main v-if="sudahBuka" class="pb-20 overflow-x-hidden">
        <Mempelai />
        <Countdown />
        <Acara />
        <Galeri />

        <div class="py-20 px-6 space-y-12 bg-white/30 backdrop-blur-sm">
          <RsvpForm @update-list="ambilUcapan" />
          <GuestBook :data="daftarUcapan" />
        </div>

        <footer
          class="text-center py-10 opacity-50 text-[10px] tracking-widest uppercase"
        >
          Created with love by Dzikri M Noer
        </footer>
      </main>

      <div v-if="sudahBuka" class="fixed bottom-6 right-6 z-50">
        <button
          @click="toggleMusic"
          class="group relative w-16 h-16 bg-charcoal text-white rounded-full flex items-center justify-center shadow-[0_0_20px_rgba(0,0,0,0.3)] border-2 border-teal-deep transition-all duration-500 hover:scale-110 active:scale-90"
        >
          <span
            v-if="isPlaying"
            class="absolute inset-0 rounded-full bg-teal-deep animate-ping opacity-20"
          ></span>

          <div class="flex flex-col items-center">
            <div class="flex gap-[2px] items-end h-3 mb-1">
              <div
                class="w-1 bg-white rounded-full transition-all duration-500"
                :class="
                  isPlaying
                    ? 'animate-[music_0.8s_ease-in-out_infinite]'
                    : 'h-1'
                "
              ></div>
              <div
                class="w-1 bg-white rounded-full transition-all duration-500"
                :class="
                  isPlaying
                    ? 'animate-[music_1.1s_ease-in-out_infinite]'
                    : 'h-2'
                "
              ></div>
              <div
                class="w-1 bg-white rounded-full transition-all duration-500"
                :class="
                  isPlaying
                    ? 'animate-[music_0.9s_ease-in-out_infinite]'
                    : 'h-1'
                "
              ></div>
            </div>
            <span
              class="text-[8px] font-black tracking-widest uppercase select-none"
            >
              {{ isPlaying ? "Pause" : "Play" }}
            </span>
          </div>
        </button>
      </div>
    </div>
  </div>
</template>

<style>
/* Animasi Transisi Halus (Fade) */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 1s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Animasi Bar Musik */
@keyframes music {
  0%,
  100% {
    height: 4px;
  }
  50% {
    height: 12px;
  }
}

/* Global Scrollbar Style */
::-webkit-scrollbar {
  width: 6px;
}
::-webkit-scrollbar-track {
  background: #f8f5f2;
}
::-webkit-scrollbar-thumb {
  background: #34656d;
  border-radius: 10px;
}
</style>
