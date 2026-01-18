<template>
  <div>
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="mb-0">Lista de Vendedores</h2>
      <button class="btn btn-primary" @click="showSyncModal = true">
        <i class="bi bi-arrow-repeat"></i>
        Sincronizar vendedores
      </button>
    </div>
    <div v-if="loading" class="text-info">Cargando vendedores...</div>
    <div v-else-if="error" class="text-danger">{{ error }}</div>
    <table v-else class="table table-dark table-striped table-bordered align-middle">
      <thead>
        <tr>
          <th>
            <button class="btn btn-link p-0 text-light" @click="sort('id')">ID <i :class="sortIcon('id')"></i></button>
          </th>
          <th>
            <button class="btn btn-link p-0 text-light" @click="sort('nombre')">Nombre <i :class="sortIcon('nombre')"></i></button>
          </th>
          <th>
            <button class="btn btn-link p-0 text-light" @click="sort('email')">Email <i :class="sortIcon('email')"></i></button>
          </th>
          <th>
            <button class="btn btn-link p-0 text-light" @click="sort('telefono')">Teléfono <i :class="sortIcon('telefono')"></i></button>
          </th>
          <th>
            <button class="btn btn-link p-0 text-light" @click="sort('lote_id')">Lote <i :class="sortIcon('lote_id')"></i></button>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="vendedor in vendedores" :key="vendedor.id">
          <td>{{ vendedor.id }}</td>
          <td>{{ vendedor.nombre }}</td>
          <td>{{ vendedor.email }}</td>
          <td>{{ vendedor.telefono }}</td>
          <td>
            {{ vendedor.lote?.nombre || 'Sin lote' }}
            <button class="btn btn-sm btn-outline-info ms-2" @click="openAsignarSucursal(vendedor)">
              <i class="bi bi-pencil"></i> Asignar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <SyncVendedoresModal
      :show="showSyncModal"
      :lotes="lotes"
      @close="showSyncModal = false"
      @synced="handleSynced"
    />
    <AsignarSucursalModal
      :show="showAsignarModal"
      :vendedor="vendedorSeleccionado"
      :lotes="lotes"
      @close="showAsignarModal = false"
      @asignado="handleAsignado"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import SyncVendedoresModal from './SyncVendedoresModal.vue'
import AsignarSucursalModal from './AsignarSucursalModal.vue'
const showAsignarModal = ref(false)
const vendedorSeleccionado = ref(null)
function openAsignarSucursal(vendedor) {
  vendedorSeleccionado.value = vendedor
  showAsignarModal.value = true
}

function handleAsignado() {
  fetchVendedores()
}

const vendedores = ref([])
const loading = ref(true)
const error = ref('')
const orderBy = ref('id')
const orderDirection = ref('asc')
const showSyncModal = ref(false)
const lotes = ref([])

function sort(field) {
  if (orderBy.value === field) {
    orderDirection.value = orderDirection.value === 'asc' ? 'desc' : 'asc'
  } else {
    orderBy.value = field
    orderDirection.value = 'asc'
  }
  fetchVendedores()
}

function sortIcon(field) {
  if (orderBy.value !== field) return 'bi bi-arrow-down-up'
  return orderDirection.value === 'asc' ? 'bi bi-arrow-up' : 'bi bi-arrow-down'
}

async function fetchVendedores() {
  loading.value = true
  try {
    const response = await axios.get('/api/vendedores', {
      params: {
        orderBy: orderBy.value,
        orderDirection: orderDirection.value
      }
    })
    vendedores.value = response.data
  } catch (e) {
    error.value = 'No se pudieron cargar los vendedores. ' + (e.message || '')
  } finally {
    loading.value = false
  }
}


// Cargar lotes activos para el modal de sincronización
async function fetchLotes() {
  try {
    const response = await axios.get('/api/lotes', {
      params: { where: { activo: 1 } }
    })
    lotes.value = response.data
  } catch (e) {
    lotes.value = []
  }
}

function handleSynced() {
  fetchVendedores()
}

onMounted(() => {
  fetchVendedores()
  fetchLotes()
})
</script>
