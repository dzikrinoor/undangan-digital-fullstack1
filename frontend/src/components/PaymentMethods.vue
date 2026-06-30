<template>
  <div class="payment-methods-container">
    <div class="payment-header">
      <h2>💝 Metode Pembayaran & Hadiah Digital</h2>
      <p class="subtitle">Tamu undangan dapat mengirimkan hadiah melalui metode di bawah</p>
    </div>

    <!-- Loading State -->
    <div v-if="loading" class="loading-state">
      <div class="spinner"></div>
      <p>Memuat metode pembayaran...</p>
    </div>

    <!-- Error State -->
    <div v-else-if="error" class="error-state">
      <p>{{ error }}</p>
      <button @click="fetchPaymentMethods" class="retry-btn">Coba Lagi</button>
    </div>

    <!-- Payment Methods Display -->
    <div v-else class="payment-content">
      <!-- Bank Transfer Section -->
      <div v-if="groupedMethods.bank.length > 0" class="payment-section">
        <div class="section-header">
          <span class="section-icon">🏦</span>
          <h3>Transfer Bank</h3>
        </div>
        <div class="payment-grid">
          <div
            v-for="method in groupedMethods.bank"
            :key="method.id"
            class="payment-card bank-card"
          >
            <div class="card-header">
              <h4>{{ method.bank_name }}</h4>
              <span class="bank-code">{{ method.bank_code }}</span>
            </div>
            <div class="card-body">
              <div class="info-row">
                <label>Nomor Rekening:</label>
                <div class="info-value copyable" @click="copyToClipboard(method.account_number)">
                  <span>{{ method.account_number }}</span>
                  <i class="copy-icon">📋</i>
                </div>
              </div>
              <div class="info-row">
                <label>Atas Nama:</label>
                <p class="info-value">{{ method.account_holder }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Digital Wallets Section -->
      <div v-if="groupedMethods.wallet.length > 0" class="payment-section">
        <div class="section-header">
          <span class="section-icon">📱</span>
          <h3>Dompet Digital</h3>
        </div>
        <div class="payment-grid">
          <div
            v-for="method in groupedMethods.wallet"
            :key="method.id"
            class="payment-card wallet-card"
          >
            <div class="card-header">
              <h4>{{ getWalletLabel(method.wallet_type) }}</h4>
              <span class="wallet-badge">{{ method.name }}</span>
            </div>
            <div class="card-body">
              <div class="info-row">
                <label>Nomor:</label>
                <div class="info-value copyable" @click="copyToClipboard(method.phone_number)">
                  <span>{{ formatPhoneNumber(method.phone_number) }}</span>
                  <i class="copy-icon">📋</i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- QRIS Section -->
      <div v-if="groupedMethods.qris.length > 0" class="payment-section">
        <div class="section-header">
          <span class="section-icon">📲</span>
          <h3>QRIS - Quick Response Code</h3>
        </div>
        <div class="payment-grid">
          <div
            v-for="method in groupedMethods.qris"
            :key="method.id"
            class="payment-card qris-card"
          >
            <div class="qris-image">
              <img :src="method.qris_url" :alt="method.display_text" class="qr-code" />
            </div>
            <p class="qris-text">{{ method.display_text }}</p>
            <p class="qris-instruction">Scan dengan aplikasi banking atau e-wallet</p>
          </div>
        </div>
      </div>

      <!-- Cryptocurrency Section -->
      <div v-if="groupedMethods.crypto.length > 0" class="payment-section">
        <div class="section-header">
          <span class="section-icon">₿</span>
          <h3>Cryptocurrency</h3>
        </div>
        <div class="payment-grid">
          <div
            v-for="method in groupedMethods.crypto"
            :key="method.id"
            class="payment-card crypto-card"
          >
            <div class="card-header">
              <h4>{{ method.currency }}</h4>
              <span class="crypto-badge">{{ method.name }}</span>
            </div>
            <div class="card-body">
              <div class="info-row">
                <label>Alamat Dompet:</label>
                <div class="info-value copyable wallet-address" @click="copyToClipboard(method.wallet_address)">
                  <span>{{ truncateAddress(method.wallet_address) }}</span>
                  <i class="copy-icon">📋</i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Suggested Gift Amounts -->
      <div class="gift-amounts-section">
        <h3>💝 Jumlah Hadiah yang Disarankan</h3>
        <div class="amount-grid">
          <button
            v-for="amount in suggestedAmounts"
            :key="amount"
            class="amount-btn"
            @click="selectAmount(amount)"
          >
            <span class="amount-label">Rp</span>
            <span class="amount-value">{{ formatCurrency(amount) }}</span>
          </button>
        </div>
      </div>

      <!-- Copy Notification -->
      <Transition name="fade">
        <div v-if="copyNotification" class="copy-notification">
          ✓ {{ copyNotification }}
        </div>
      </Transition>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'

const props = defineProps({
  invitationId: {
    type: [String, Number],
    required: true
  },
  apiBaseUrl: {
    type: String,
    default: import.meta.env.VITE_API_BASE_URL || 'http://localhost:8000/api'
  }
})

const emit = defineEmits(['amount-selected', 'payment-method-clicked'])

// State
const paymentMethods = ref([])
const loading = ref(true)
const error = ref(null)
const copyNotification = ref(null)
const suggestedAmounts = ref([25000, 50000, 100000, 250000, 500000])

// Computed
const groupedMethods = computed(() => {
  return {
    bank: paymentMethods.value.filter(m => m.type === 'bank'),
    wallet: paymentMethods.value.filter(m => m.type === 'wallet'),
    qris: paymentMethods.value.filter(m => m.type === 'qris'),
    crypto: paymentMethods.value.filter(m => m.type === 'crypto')
  }
})

// Methods
const fetchPaymentMethods = async () => {
  try {
    loading.value = true
    error.value = null

    const response = await fetch(
      `${props.apiBaseUrl}/payment-methods/invitation/${props.invitationId}`
    )

    if (!response.ok) {
      throw new Error('Gagal memuat metode pembayaran')
    }

    const data = await response.json()
    paymentMethods.value = data.data || []
  } catch (err) {
    error.value = err.message || 'Terjadi kesalahan saat memuat metode pembayaran'
    console.error('Error fetching payment methods:', err)
  } finally {
    loading.value = false
  }
}

const copyToClipboard = async (text) => {
  try {
    await navigator.clipboard.writeText(text)
    copyNotification.value = 'Berhasil disalin!'
    setTimeout(() => {
      copyNotification.value = null
    }, 2000)
  } catch (err) {
    console.error('Failed to copy:', err)
  }
}

const formatPhoneNumber = (phone) => {
  if (!phone) return ''
  const clean = phone.replace(/\D/g, '')
  if (clean.startsWith('62')) {
    return '+' + clean.slice(0, 2) + ' ' + clean.slice(2, 5) + ' ' + clean.slice(5, 8) + ' ' + clean.slice(8)
  }
  return phone
}

const formatCurrency = (amount) => {
  return new Intl.NumberFormat('id-ID').format(amount)
}

const truncateAddress = (address) => {
  if (!address || address.length <= 20) return address
  return address.slice(0, 10) + '...' + address.slice(-10)
}

const getWalletLabel = (walletType) => {
  const labels = {
    'gopay': 'GoPay',
    'dana': 'Dana',
    'ovo': 'OVO',
    'linkaja': 'LinkAja',
    'shopeepay': 'ShopeePay',
    'other': 'Dompet Digital'
  }
  return labels[walletType] || 'Dompet Digital'
}

const selectAmount = (amount) => {
  emit('amount-selected', amount)
}

// Lifecycle
onMounted(() => {
  fetchPaymentMethods()
})
</script>

<style scoped>
.payment-methods-container {
  width: 100%;
  max-width: 1000px;
  margin: 0 auto;
  padding: 2rem 1rem;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.payment-header {
  text-align: center;
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 2px solid #f0f0f0;
}

.payment-header h2 {
  font-size: 1.8rem;
  color: #333;
  margin: 0 0 0.5rem 0;
}

.subtitle {
  color: #666;
  font-size: 0.95rem;
  margin: 0;
}

/* Loading & Error States */
.loading-state,
.error-state {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  min-height: 300px;
  gap: 1rem;
}

.spinner {
  border: 4px solid #f3f3f3;
  border-top: 4px solid #4CAF50;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

.error-state p {
  color: #d32f2f;
  font-size: 0.95rem;
}

.retry-btn {
  padding: 0.75rem 1.5rem;
  background: #4CAF50;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-size: 0.9rem;
  transition: background 0.3s;
}

.retry-btn:hover {
  background: #45a049;
}

/* Sections */
.payment-section {
  margin-bottom: 3rem;
}

.section-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #e0e0e0;
}

.section-icon {
  font-size: 1.5rem;
}

.section-header h3 {
  margin: 0;
  font-size: 1.3rem;
  color: #333;
}

/* Payment Grid */
.payment-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 1.5rem;
}

/* Payment Cards */
.payment-card {
  background: white;
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 1.5rem;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  transition: all 0.3s ease;
}

.payment-card:hover {
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
  transform: translateY(-2px);
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  padding-bottom: 1rem;
  border-bottom: 1px solid #f0f0f0;
}

.card-header h4 {
  margin: 0;
  font-size: 1.1rem;
  color: #333;
}

.bank-code,
.wallet-badge,
.crypto-badge {
  display: inline-block;
  padding: 0.25rem 0.75rem;
  background: #f0f0f0;
  color: #666;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
}

.card-body {
  display: flex;
  flex-direction: column;
  gap: 1rem;
}

.info-row {
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.info-row label {
  font-size: 0.85rem;
  color: #999;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 0.5px;
}

.info-value {
  font-size: 0.95rem;
  color: #333;
  word-break: break-all;
}

.copyable {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 0.5rem;
  padding: 0.75rem;
  background: #f9f9f9;
  border-radius: 4px;
  cursor: pointer;
  transition: background 0.2s;
}

.copyable:hover {
  background: #f0f0f0;
}

.copy-icon {
  opacity: 0.6;
  transition: opacity 0.2s;
}

.copyable:hover .copy-icon {
  opacity: 1;
}

.wallet-address {
  font-family: 'Courier New', monospace;
  font-size: 0.85rem;
}

/* Bank Card Specific */
.bank-card {
  border-left: 4px solid #1976D2;
}

/* Wallet Card Specific */
.wallet-card {
  border-left: 4px solid #FF9800;
}

/* QRIS Card Specific */
.qris-card {
  text-align: center;
}

.qris-image {
  margin-bottom: 1rem;
  display: flex;
  justify-content: center;
}

.qr-code {
  max-width: 200px;
  width: 100%;
  height: auto;
  border: 1px solid #e0e0e0;
  border-radius: 4px;
  padding: 0.5rem;
}

.qris-text {
  margin: 0 0 0.5rem 0;
  font-size: 0.95rem;
  color: #333;
  font-weight: 500;
}

.qris-instruction {
  margin: 0;
  font-size: 0.85rem;
  color: #999;
}

/* Crypto Card Specific */
.crypto-card {
  border-left: 4px solid #F57C00;
}

/* Suggested Amounts */
.gift-amounts-section {
  margin-top: 3rem;
  padding-top: 2rem;
  border-top: 2px solid #f0f0f0;
  text-align: center;
}

.gift-amounts-section h3 {
  font-size: 1.2rem;
  color: #333;
  margin: 0 0 1.5rem 0;
}

.amount-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
  gap: 1rem;
}

.amount-btn {
  padding: 1rem;
  background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
  color: white;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-weight: 600;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
}

.amount-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.amount-btn:active {
  transform: translateY(0);
}

.amount-label {
  font-size: 0.8rem;
  opacity: 0.9;
}

.amount-value {
  font-size: 1.1rem;
}

/* Copy Notification */
.copy-notification {
  position: fixed;
  bottom: 2rem;
  right: 2rem;
  padding: 1rem 1.5rem;
  background: #4CAF50;
  color: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
  animation: slideIn 0.3s ease;
  z-index: 1000;
}

@keyframes slideIn {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .payment-methods-container {
    padding: 1rem;
  }

  .payment-header h2 {
    font-size: 1.4rem;
  }

  .payment-grid {
    grid-template-columns: 1fr;
  }

  .amount-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .copy-notification {
    left: 1rem;
    right: 1rem;
    bottom: 1rem;
  }

  .section-header {
    flex-direction: column;
    align-items: flex-start;
  }
}

@media (max-width: 480px) {
  .payment-methods-container {
    padding: 0.5rem;
  }

  .payment-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
  }

  .payment-header h2 {
    font-size: 1.2rem;
  }

  .payment-card {
    padding: 1rem;
  }

  .amount-grid {
    grid-template-columns: 1fr;
  }
}
</style>
