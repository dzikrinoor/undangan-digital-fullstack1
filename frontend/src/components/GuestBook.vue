<script setup>
defineProps(["data"]);

// Fungsi untuk mendapatkan inisial nama
const getInitial = (name) => {
  return name ? name.charAt(0).toUpperCase() : "?";
};
</script>

<template>
  <section class="py-24 relative overflow-hidden bg-[#fdfbf9]">
    <div class="absolute inset-0 z-0 opacity-[0.06] pointer-events-none">
      <img
        src="https://images.unsplash.com/photo-1522673607200-164883eeba3c?auto=format&fit=crop&q=80"
        class="w-full h-full object-cover"
      />
    </div>

    <div data-aos="fade-up" class="max-w-2xl mx-auto px-6 relative z-10">
      <div class="flex flex-col items-center mb-16">
        <span
          class="text-teal-deep uppercase tracking-[0.6em] text-[10px] font-black mb-4"
          >Guest Book</span
        >
        <h2 class="text-5xl font-serif text-charcoal italic text-center">
          Doa Restu
        </h2>
        <div class="mt-6 flex items-center gap-4">
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
          <div class="w-2 h-2 rounded-full border border-teal-deep/50"></div>
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
        </div>
      </div>

      <div
        class="max-h-[600px] overflow-y-auto pr-4 custom-scrollbar space-y-6"
      >
        <transition-group name="list">
          <div v-for="item in data" :key="item.id" class="relative group">
            <div class="flex gap-4 md:gap-6">
              <div
                class="flex-shrink-0 w-12 h-12 rounded-full bg-white border border-teal-deep/10 flex items-center justify-center shadow-sm transition-all duration-500 group-hover:border-teal-deep/40 group-hover:scale-110"
              >
                <span class="text-teal-deep font-serif font-bold text-lg">{{
                  getInitial(item.nama)
                }}</span>
              </div>

              <div
                class="flex-1 bg-white/80 backdrop-blur-md p-6 rounded-3xl rounded-tl-none shadow-xl shadow-teal-deep/5 border border-teal-deep/5 group-hover:border-teal-deep/20 transition-all duration-500"
              >
                <div class="flex justify-between items-center mb-3">
                  <h4
                    class="text-sm font-black text-charcoal uppercase tracking-widest"
                  >
                    {{ item.nama }}
                  </h4>
                  <span
                    class="text-[9px] px-3 py-1 rounded-full font-bold uppercase tracking-wider"
                    :class="
                      item.kehadiran === 'hadir'
                        ? 'bg-teal-deep/10 text-teal-deep'
                        : 'bg-charcoal/5 text-charcoal/40'
                    "
                  >
                    {{ item.kehadiran === "hadir" ? "Hadir" : "Absen" }}
                  </span>
                </div>

                <p
                  class="text-sm text-charcoal/70 leading-relaxed italic font-serif"
                >
                  "{{ item.ucapan }}"
                </p>

                <div
                  class="mt-4 pt-4 border-t border-teal-deep/5 flex justify-end"
                >
                  <span
                    class="text-[9px] text-teal-deep/40 font-bold tracking-[0.2em] uppercase"
                  >
                    {{
                      new Date(item.created_at).toLocaleDateString("id-ID", {
                        day: "numeric",
                        month: "long",
                        year: "numeric",
                      })
                    }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </transition-group>

        <div
          v-if="data.length === 0"
          class="text-center py-20 bg-white/40 backdrop-blur-sm rounded-[2.5rem] border-2 border-dashed border-teal-deep/10"
        >
          <p class="text-sm text-charcoal/40 font-serif italic tracking-wide">
            Belum ada doa restu yang tertulis. <br />
            Jadilah yang pertama memberikan pesan hangat.
          </p>
        </div>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Animasi List yang Halus */
.list-enter-active,
.list-leave-active {
  transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(-20px);
}

/* Custom Scrollbar Minimalis */
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: rgba(52, 101, 109, 0.1);
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: rgba(52, 101, 109, 0.3);
}

/* Menjaga angka tetap rapi */
span {
  font-feature-settings: "tnum";
}
</style>
