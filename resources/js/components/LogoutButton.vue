<template>
  <button class="btn btn-danger btn-sm float-end mt-2" @click="logout">Cerrar sesión</button>
</template>

<script setup>
import axios from 'axios'

function logout() {
  axios.post('/logout').then(() => {
    window.location.href = '/'
  })
}
</script>
