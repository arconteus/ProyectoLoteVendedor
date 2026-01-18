<template>
  <div class="login-container">
    <h2>Iniciar Sesión</h2>
    <form @submit.prevent="login">
      <div>
        <label for="email">Email</label>
        <input v-model="email" type="email" id="email" required />
      </div>
      <div>
        <label for="password">Contraseña</label>
        <input v-model="password" type="password" id="password" required />
      </div>
      <button type="submit" :disabled="loading">Entrar</button>
      <div v-if="error" class="error">{{ error }}</div>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

const email = ref('')
const password = ref('')
const error = ref('')
const loading = ref(false)

const login = async () => {
  error.value = ''
  loading.value = true
  try {
    await axios.get('/sanctum/csrf-cookie') // Necesario para Laravel Sanctum
    await axios.post('/login', {
      email: email.value,
      password: password.value
    })
    // Redirigir o actualizar estado global aquí
    window.location.href = '/dashboard'
  } catch (e) {
    error.value = 'Credenciales incorrectas o error de servidor.'
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
.login-container {
  max-width: 400px;
  margin: 2rem auto;
  padding: 2rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  background: #fff;
}
label {
  display: block;
  margin-bottom: 0.5rem;
}
input {
  width: 100%;
  padding: 0.5rem;
  margin-bottom: 1rem;
  border: 1px solid #ccc;
  border-radius: 4px;
}
button {
  width: 100%;
  padding: 0.75rem;
  background: #4f46e5;
  color: #fff;
  border: none;
  border-radius: 4px;
  font-weight: bold;
  cursor: pointer;
}
button:disabled {
  background: #a5b4fc;
}
.error {
  color: #dc2626;
  margin-top: 1rem;
}
</style>
