<template>
  <div class="modal fade show d-block" tabindex="-1" style="background:rgba(0,0,0,0.5);" v-if="show">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Asignar Sucursal</h5>
          <button type="button" class="btn-close" @click="$emit('close')"></button>
        </div>
        <form @submit.prevent="submit">
            <input type="hidden" :value="vendedor.id" />
            <div class="modal-body">
                <div class="mb-3">
                <label class="form-label">Sucursal</label>
                <select v-model="loteId" class="form-select" required>
                    <option value="" disabled>Selecciona una sucursal</option>
                    <option v-for="lote in lotes" :key="lote.id" :value="lote.id">
                    {{ lote.nombre }} ({{ lote.identificador }})
                    </option>
                </select>
                </div>
                <div v-if="error" class="alert alert-danger">{{ error }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="$emit('close')">Cancelar</button>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                <i class="bi bi-arrow-repeat" v-if="loading"></i>
                {{ loading ? 'Asignando...' : 'Asignar' }}
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import axios from 'axios'

const props = defineProps({
  show: Boolean,
  vendedor: Object,
  lotes: Array
})
const emit = defineEmits(['close', 'asignado'])

const loteId = ref('')
const loading = ref(false)
const error = ref('')

watch(() => props.show, (val) => {
  if (val && props.vendedor) {
    loteId.value = props.vendedor.lote_id || ''
    error.value = ''
  }
})

async function submit() {
  if (!loteId.value || !props.vendedor) return
  loading.value = true
  error.value = ''
  try {
    await axios.put(`/api/vendedores/${props.vendedor.id}`, { id: props.vendedor.id, lote_id: loteId.value })
    emit('asignado')
    emit('close')
  } catch (e) {
    error.value = e.response?.data?.message || 'Error al asignar sucursal.'
  } finally {
    loading.value = false
  }
}
</script>
