<template>
  <div
    class="fixed inset-0 z-[100] bg-cream-light flex flex-col items-center justify-center"
  >
    <div class="relative">
      <h1
        class="text-6xl font-serif text-teal-deep animate-pulse tracking-tighter"
      >
        R<span class="text-charcoal opacity-30">&</span>P
      </h1>
      <div
        class="absolute inset-0 bg-teal-deep/10 rounded-full scale-150 blur-xl animate-ping"
      ></div>
    </div>

    <div class="mt-8 flex flex-col items-center gap-2">
      <span
        class="text-[10px] uppercase tracking-[0.5em] text-charcoal/40 font-black"
      >
        Preparing Happiness
      </span>
      <div class="w-32 h-[1px] bg-charcoal/10 relative overflow-hidden">
        <div
          class="absolute inset-0 bg-teal-deep animate-[loading_2s_infinite]"
        ></div>
      </div>
    </div>
  </div>
</template>

<style scoped>
@keyframes loading {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(100%);
  }
}
</style>
