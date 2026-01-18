<template>
  <div>
    <Header />
    <div class="container py-4">
      <LotesList />
      <VendedoresList class="mt-5" />
    </div>
  </div>
</template>

<script setup>
import LotesList from './LotesList.vue'
import VendedoresList from './VendedoresList.vue'
import Header from './Header.vue'
</script>
