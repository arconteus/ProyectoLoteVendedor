<template>
  <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);" v-if="show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Agregar Nuevo Lote</h5>
          <button type="button" class="btn-close" @click="$emit('close')"></button>
        </div>
        <form @submit.prevent="submit">
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nombre</label>
              <input v-model="form.nombre" type="text" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Dirección</label>
              <input v-model="form.direccion" type="text" class="form-control" required />
            </div>
            <div class="mb-3">
              <label class="form-label">Identificador</label>
              <input v-model="form.identificador" type="text" class="form-control" required />
            </div>
            <div class="form-check mb-3">
              <input v-model="form.activo" type="checkbox" class="form-check-input" id="activoCheck" />
              <label class="form-check-label" for="activoCheck">Activo</label>
            </div>
            <div v-if="error" class="alert alert-danger">{{ error }}</div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="$emit('close')">Cancelar</button>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, reactive } from 'vue'
import axios from 'axios'

const props = defineProps({
  show: Boolean
})
const emit = defineEmits(['close', 'created'])

const form = reactive({
  nombre: '',
  direccion: '',
  identificador: '',
  activo: true
})
const error = ref('')

watch(() => props.show, (val) => {
  if (val) {
    form.nombre = ''
    form.direccion = ''
    form.identificador = ''
    form.activo = true
    error.value = ''
  }
})

async function submit() {
  error.value = ''
  try {
    await axios.post('/api/lotes', form)
    emit('created')
    emit('close')
  } catch (e) {
    error.value = e.response?.data?.message || 'Error al crear lote.'
  }
}
</script>
