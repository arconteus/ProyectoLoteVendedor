<template>
  <header class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-1">Bienvenido al Dashboard</h1>
      <p class="mb-0 text-secondary">Has iniciado sesión correctamente.</p>
    </div>
    <LogoutButton />
  </header>
</template>

<script setup>
import LogoutButton from './LogoutButton.vue'
</script>
