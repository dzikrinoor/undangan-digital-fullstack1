<template>
  <section class="py-32 relative overflow-hidden bg-[#fdfbf9]">
    <div class="absolute inset-0 z-0">
      <img
        src="https://images.unsplash.com/photo-1522673607200-164883eeba3c?auto=format&fit=crop&q=80"
        class="w-full h-full object-cover opacity-[0.08]"
        alt="Background Texture"
      />
      <div
        class="absolute inset-0 bg-gradient-to-b from-[#fdfbf9] via-transparent to-[#fdfbf9]"
      ></div>
    </div>

    <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
      <div
        class="absolute -top-20 -left-20 w-96 h-96 border border-teal-deep rounded-full"
      ></div>
      <div
        class="absolute -bottom-20 -right-20 w-[30rem] h-[30rem] border border-teal-deep rounded-full"
      ></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 relative z-10">
      <div class="flex flex-col items-center mb-24" data-aos="fade-up">
        <span
          class="text-teal-deep uppercase tracking-[0.6em] text-[10px] font-black mb-4"
          >The Celebration</span
        >
        <h2 class="text-5xl font-serif text-charcoal italic">Waktu & Lokasi</h2>
        <div class="mt-6 flex items-center gap-4">
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
          <div class="w-2 h-2 rounded-full border border-teal-deep/50"></div>
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
        </div>
      </div>

      <div class="grid md:grid-cols-2 gap-8 md:gap-12">
        <div
          data-aos="fade-right"
          class="group bg-white/80 backdrop-blur-sm p-10 md:p-14 rounded-[2.5rem] border border-teal-deep/10 hover:border-teal-deep/40 transition-all duration-500 relative overflow-hidden shadow-xl shadow-teal-deep/5"
        >
          <div class="relative z-10 text-center md:text-left">
            <h3
              class="text-teal-deep text-xs uppercase tracking-[0.3em] font-black mb-10 border-l-2 border-teal-deep pl-4 inline-block md:block"
            >
              Akad Nikah
            </h3>

            <div class="space-y-8">
              <div class="flex flex-col md:flex-row items-center gap-6">
                <span class="text-7xl font-serif text-charcoal">11</span>
                <div
                  class="flex flex-col border-l border-teal-deep/20 pl-6 text-left"
                >
                  <span
                    class="text-xl font-bold uppercase tracking-widest text-charcoal"
                    >Juli 2026</span
                  >
                  <span
                    class="text-xs text-teal-deep font-bold uppercase tracking-[0.2em]"
                    >Sabtu Pagi</span
                  >
                </div>
              </div>

              <div class="h-[1px] w-full bg-teal-deep/10"></div>

              <div class="space-y-5">
                <div
                  class="flex items-center gap-5 justify-center md:justify-start"
                >
                  <span class="text-xl">🕒</span>
                  <p class="text-sm font-bold text-charcoal/80 tracking-wide">
                    08.00 - 10.00 WIB
                  </p>
                </div>
                <div
                  class="flex items-start gap-5 justify-center md:justify-start"
                >
                  <span class="text-xl">📍</span>
                  <p
                    class="text-sm text-charcoal/70 leading-relaxed italic font-serif"
                  >
                    Gedung Pernikahan Bandung<br />Jl. Alamat Lengkap No. 123
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div
          data-aos="fade-left"
          class="group bg-white/80 backdrop-blur-sm p-10 md:p-14 rounded-[2.5rem] border border-teal-deep/10 hover:border-teal-deep/40 transition-all duration-500 relative overflow-hidden shadow-xl shadow-teal-deep/5"
        >
          <div class="relative z-10 text-center md:text-left">
            <h3
              class="text-teal-deep text-xs uppercase tracking-[0.3em] font-black mb-10 border-l-2 border-teal-deep pl-4 inline-block md:block"
            >
              Resepsi
            </h3>

            <div class="space-y-8">
              <div class="flex flex-col md:flex-row items-center gap-6">
                <span class="text-7xl font-serif text-charcoal">11</span>
                <div
                  class="flex flex-col border-l border-teal-deep/20 pl-6 text-left"
                >
                  <span
                    class="text-xl font-bold uppercase tracking-widest text-charcoal"
                    >Juli 2026</span
                  >
                  <span
                    class="text-xs text-teal-deep font-bold uppercase tracking-[0.2em]"
                    >Sabtu Siang</span
                  >
                </div>
              </div>

              <div class="h-[1px] w-full bg-teal-deep/10"></div>

              <div class="space-y-5">
                <div
                  class="flex items-center gap-5 justify-center md:justify-start"
                >
                  <span class="text-xl">🕒</span>
                  <p class="text-sm font-bold text-charcoal/80 tracking-wide">
                    11.00 - Selesai
                  </p>
                </div>
                <div
                  class="flex items-start gap-5 justify-center md:justify-start"
                >
                  <span class="text-xl">📍</span>
                  <p
                    class="text-sm text-charcoal/70 leading-relaxed italic font-serif"
                  >
                    Gedung Pernikahan Bandung<br />Jl. Alamat Lengkap No. 123
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-20 text-center" data-aos="zoom-in">
        <a
          href="http://maps.google.com/?q=Gedung+Pernikahan+Bandung"
          target="_blank"
          class="group relative inline-flex items-center gap-4 bg-charcoal text-[#fdfbf9] px-12 py-5 rounded-full font-black shadow-xl overflow-hidden transition-all hover:scale-105 active:scale-95"
        >
          <span class="relative z-10 tracking-[0.3em] text-[10px]"
            >BUKA LOKASI VIA MAPS</span
          >
          <div
            class="absolute inset-0 bg-teal-deep translate-y-full group-hover:translate-y-0 transition-transform duration-500"
          ></div>
        </a>
      </div>
    </div>
  </section>
</template>
