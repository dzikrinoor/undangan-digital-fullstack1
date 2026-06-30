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

    <div
      class="absolute top-20 -left-20 opacity-[0.04] pointer-events-none select-none"
    >
      <h2 class="text-[25rem] font-serif leading-none text-teal-deep">R</h2>
    </div>
    <div
      class="absolute bottom-20 -right-20 opacity-[0.04] pointer-events-none select-none"
    >
      <h2 class="text-[25rem] font-serif leading-none text-teal-deep">P</h2>
    </div>

    <div class="max-w-6xl mx-auto px-6 relative z-10">
      <div class="flex flex-col items-center mb-24" data-aos="fade-up">
        <span
          class="text-teal-deep uppercase tracking-[0.6em] text-[10px] font-black mb-4"
          >The Happy Couple</span
        >
        <h2 class="text-5xl font-serif text-charcoal italic">Mempelai</h2>
        <div class="mt-6 flex items-center gap-4">
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
          <div class="w-2 h-2 rounded-full border border-teal-deep/50"></div>
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
        </div>
      </div>

      <div class="flex flex-col gap-32 md:gap-48">
        <div class="flex flex-col md:flex-row items-center gap-12 md:pl-20">
          <div class="relative group" data-aos="fade-right">
            <div
              class="relative w-64 h-80 md:w-72 md:h-96 z-10 overflow-hidden rounded-2xl shadow-2xl border border-teal-deep/10 transition-transform duration-700 group-hover:scale-[1.02]"
            >
              <img
                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=400"
                class="w-full h-full object-cover grayscale transition-all duration-1000 group-hover:grayscale-0 group-hover:scale-110"
              />
            </div>
            <div
              class="absolute -top-6 -left-6 w-full h-full border border-teal-deep/20 rounded-2xl -z-0"
            ></div>
          </div>

          <div
            class="text-center md:text-left space-y-4 bg-white/80 backdrop-blur-sm p-10 rounded-3xl border border-teal-deep/5 shadow-xl shadow-teal-deep/5"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <h3 class="text-4xl font-serif font-bold text-charcoal">
              Dzikri M Noer
            </h3>
            <p
              class="text-teal-deep text-sm font-bold tracking-[0.3em] uppercase"
            >
              @dzikrinoor
            </p>
            <div class="h-[1px] w-full bg-teal-deep/10 my-4"></div>
            <p class="text-sm text-charcoal/70 leading-relaxed max-w-xs">
              Putra bungsu tercinta dari <br />
              <span
                class="text-charcoal font-bold text-base block mt-2 font-serif italic tracking-wide underline decoration-teal-deep/10 underline-offset-8"
              >
                Bapak Mulyadi (alm) <br />
                & Ibu Nurkilah
              </span>
            </p>
          </div>
        </div>

        <div
          class="flex flex-col md:flex-row-reverse items-center gap-12 md:pr-20"
        >
          <div class="relative group" data-aos="fade-left">
            <div
              class="relative w-64 h-80 md:w-72 md:h-96 z-10 overflow-hidden rounded-2xl shadow-2xl border border-teal-deep/10 transition-transform duration-700 group-hover:scale-[1.02]"
            >
              <img
                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=400"
                class="w-full h-full object-cover grayscale transition-all duration-1000 group-hover:grayscale-0 group-hover:scale-110"
              />
            </div>
            <div
              class="absolute -bottom-6 -right-6 w-full h-full bg-teal-deep/5 rounded-2xl border border-teal-deep/10 -z-0"
            ></div>
          </div>

          <div
            class="text-center md:text-right space-y-4 bg-white/80 backdrop-blur-sm p-10 rounded-3xl border border-teal-deep/5 shadow-xl shadow-teal-deep/5"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <h3 class="text-4xl font-serif font-bold text-charcoal">
              Mita Purnamasari
            </h3>
            <p
              class="text-teal-deep text-sm font-bold tracking-[0.3em] uppercase"
            >
              @itta_philles
            </p>
            <div class="h-[1px] w-full bg-teal-deep/10 my-4"></div>
            <p
              class="text-sm text-charcoal/70 leading-relaxed max-w-xs md:ml-auto"
            >
              Putri pertama tercinta dari <br />
              <span
                class="text-charcoal font-bold text-base block mt-2 font-serif italic tracking-wide underline decoration-teal-deep/10 underline-offset-8"
              >
                Bapak Siswanto <br />
                & Ibu Maemunah
              </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
