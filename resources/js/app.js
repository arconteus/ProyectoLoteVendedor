import { createApp } from 'vue'
import Login from './components/Login.vue'

const app = createApp({})
app.component('Login', Login)
app.mount('#app')
