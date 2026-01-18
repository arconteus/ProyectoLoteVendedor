<template>
  <div>
    <h2 class="mb-3">Lista de Lotes</h2>
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Lista de Lotes</h2>
        <button class="btn btn-success" @click="showCreateModal = true">
          <i class="bi bi-plus-lg"></i> Nueva Sucursal
        </button>
      </div>
    <div v-if="loading" class="text-info">Cargando lotes...</div>
    <div v-else-if="error" class="text-danger">{{ error }}</div>
    <table v-else class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Nombre</th>
          <th>Dirección</th>
          <th>Identificador</th>
          <th>Activo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="lote in lotes" :key="lote.id">
          <td class="text-center">
            <button class="btn btn-sm btn-outline-primary me-1" title="Editar" @click="editLote(lote)">
              <i class="bi bi-pencil"></i>
            </button>
          </td>
          <td>{{ lote.id }}</td>
          <td>{{ lote.nombre }}</td>
          <td>{{ lote.direccion }}</td>
          <td>{{ lote.identificador }}</td>
          <td>{{ lote.activo ? 'Sí' : 'No' }}</td>
          <td>
            <button class="btn btn-sm btn-outline-danger" title="Eliminar" @click="deleteLote(lote.id)">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
</div>
    <SucursalCreateModal
      :show="showCreateModal"
      @close="showCreateModal = false"
      @created="fetchLotes"
    />
  <LoteEditModal
    :show="showEditModal"
    :lote="loteToEdit"
    @close="showEditModal = false"
    @updated="fetchLotes"
  />
</template>


<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import LoteEditModal from './LoteEditModal.vue'
import SucursalCreateModal from './SucursalCreateModal.vue'

const showCreateModal = ref(false)

onMounted(async () => {
  try {
    const response = await axios.get('/api/lotes')
    lotes.value = response.data
  } catch (e) {
    error.value = 'No se pudieron cargar los lotes.'
  } finally {
    loading.value = false
  }
})

const lotes = ref([])
const loading = ref(true)
const error = ref('')

async function fetchLotes() {
  loading.value = true
  try {
    const response = await axios.get('/api/lotes')
    lotes.value = response.data
  } catch (e) {
    error.value = 'No se pudieron cargar los lotes. ' + e.message
  } finally {
    loading.value = false
  }
}

onMounted(fetchLotes)

const showEditModal = ref(false)
const loteToEdit = ref(null)

function editLote(lote) {
  loteToEdit.value = { ...lote }
  showEditModal.value = true
}

async function deleteLote(id) {
  if (confirm('¿Seguro que deseas eliminar este lote?')) {
    try {
      await axios.delete(`/api/lotes/${id}`)
      lotes.value = lotes.value.filter(l => l.id !== id)
    } catch (e) {
      let msg = 'No se pudo eliminar el lote.'
      if (e.response && e.response.data && e.response.data.message) {
        msg = e.response.data.message
      } else if (e.message) {
        msg += ' ' + e.message
      }
      alert(msg)
    }
  }
}
</script>
