<template>
  <button class="btn btn-danger btn-sm float-end mt-2" :disabled="loading" @click="logout">
    Cerrar sesión
  </button>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const loading = ref(false)

function logout() {
  loading.value = true
  axios.post('/logout')
    .then(() => {
      window.location.href = '/'
    })
    .catch(() => {
      loading.value = false
      alert('Error al cerrar sesión')
    })
}
</script>