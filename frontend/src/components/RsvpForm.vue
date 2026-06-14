<script setup>
import { reactive, ref } from "vue";
import axios from "axios";

const emit = defineEmits(["update-list"]);
const loading = ref(false);
const form = reactive({ nama: "", kehadiran: "hadir", ucapan: "" });

const kirimRSVP = async () => {
  loading.value = true;
  try {
    await axios.post("http://127.0.0.1:8000/api/rsvp", form);
    alert("Terima kasih atas konfirmasinya!");
    form.nama = "";
    form.ucapan = "";
    form.kehadiran = "hadir";
    emit("update-list");
  } catch (error) {
    alert("Gagal terhubung ke server.");
  } finally {
    loading.value = false;
  }
};
</script>

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
        class="absolute -top-20 -right-20 w-96 h-96 border border-teal-deep rounded-full"
      ></div>
    </div>

    <div class="max-w-xl mx-auto px-6 relative z-10 w-full" data-aos="fade-up">
      <div class="flex flex-col items-center mb-16">
        <span
          class="text-teal-deep uppercase tracking-[0.6em] text-[10px] font-black mb-4"
          >Reservation</span
        >
        <h2 class="text-5xl font-serif text-charcoal italic text-center">
          Konfirmasi Kehadiran
        </h2>
        <div class="mt-6 flex items-center gap-4">
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
          <div class="w-2 h-2 rounded-full border border-teal-deep/50"></div>
          <div class="h-[1px] w-12 bg-teal-deep/30"></div>
        </div>
      </div>

      <div
        class="bg-white/80 backdrop-blur-md p-8 md:p-12 rounded-[2.5rem] shadow-xl shadow-teal-deep/5 border border-teal-deep/10 relative overflow-hidden"
      >
        <form @submit.prevent="kirimRSVP" class="space-y-6">
          <div class="space-y-2 text-left">
            <label
              class="text-[10px] uppercase tracking-[0.3em] font-black text-teal-deep ml-2"
              >Nama Lengkap</label
            >
            <input
              v-model="form.nama"
              type="text"
              placeholder="Masukkan Nama Anda"
              class="w-full px-6 py-4 rounded-2xl border border-teal-deep/10 outline-none bg-white focus:bg-white focus:border-teal-deep focus:ring-4 focus:ring-teal-deep/5 transition-all duration-300 text-sm text-charcoal placeholder:text-charcoal/30"
              required
            />
          </div>

          <div class="space-y-2 text-left">
            <label
              class="text-[10px] uppercase tracking-[0.3em] font-black text-teal-deep ml-2"
              >Konfirmasi</label
            >
            <div class="relative">
              <select
                v-model="form.kehadiran"
                class="w-full px-6 py-4 rounded-2xl border border-teal-deep/10 outline-none bg-white text-charcoal focus:bg-white focus:border-teal-deep transition-all duration-300 text-sm appearance-none cursor-pointer"
              >
                <option value="hadir">Berkenan Hadir</option>
                <option value="tidak_hadir">Maaf, Tidak Bisa Hadir</option>
              </select>
              <div
                class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none opacity-40 text-teal-deep"
              >
                <span class="text-xs">▼</span>
              </div>
            </div>
          </div>

          <div class="space-y-2 text-left">
            <label
              class="text-[10px] uppercase tracking-[0.3em] font-black text-teal-deep ml-2"
              >Pesan & Doa Restu</label
            >
            <textarea
              v-model="form.ucapan"
              rows="4"
              placeholder="Tuliskan ucapan hangat untuk mempelai..."
              class="w-full px-6 py-4 rounded-2xl border border-teal-deep/10 outline-none bg-white text-charcoal focus:bg-white focus:border-teal-deep focus:ring-4 focus:ring-teal-deep/5 transition-all duration-300 text-sm resize-none placeholder:text-charcoal/30"
            ></textarea>
          </div>

          <div class="pt-4">
            <button
              type="submit"
              :disabled="loading"
              class="group relative w-full overflow-hidden bg-charcoal text-[#fdfbf9] py-5 rounded-full font-black shadow-xl transition-all hover:scale-[1.02] active:scale-95 disabled:opacity-50"
            >
              <div
                class="absolute inset-0 bg-teal-deep translate-y-full group-hover:translate-y-0 transition-transform duration-500"
              ></div>
              <span
                class="relative z-10 uppercase tracking-[0.3em] text-[10px]"
              >
                {{ loading ? "Mengirim Data..." : "Kirim Konfirmasi" }}
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>
</template>

<style scoped>
/* Menyesuaikan select option agar tidak kaku */
select option {
  background-color: white;
  color: #2d3436;
}

input:focus,
textarea:focus {
  box-shadow: 0 10px 25px -5px rgba(52, 101, 109, 0.1);
}
</style>
