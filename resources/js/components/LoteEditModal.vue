<template>
  <template v-if="show">
    <div class="modal fade show" tabindex="-1" style="display: block; z-index: 1050;" aria-modal="true" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header">
            <h5 class="modal-title">Editar Lote</h5>
            <button type="button" class="btn-close btn-close-white" @click="$emit('close')"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="submit">
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
                <input v-model="form.activo" class="form-check-input" type="checkbox" id="activoCheck" />
                <label class="form-check-label" for="activoCheck">Activo</label>
              </div>
              <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-secondary me-2" @click="$emit('close')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-backdrop fade show" style="z-index: 1040;"></div>
  </template>
</template>

<script setup>
import { reactive, watch, toRefs } from 'vue'
import axios from 'axios'

const props = defineProps({
  show: Boolean,
  lote: Object
})
const emit = defineEmits(['close', 'updated'])

const form = reactive({
    id: null,
    nombre: '',
    direccion: '',
    identificador: '',
    activo: true
})

watch(() => props.lote, (lote) => {
  if (lote) {
    form.id = lote.id
    form.nombre = lote.nombre
    form.direccion = lote.direccion
    form.identificador = lote.identificador
    form.activo = !!lote.activo
  }
}, { immediate: true })

async function submit() {
  try {
    await axios.put(`/api/lotes/${form.id}`, form)
    emit('updated')
    emit('close')
  } catch (e) {
    alert('No se pudo actualizar el lote. ' + (e.response?.data?.message || e.message))
  }
}
</script>
