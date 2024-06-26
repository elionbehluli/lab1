<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Services</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Name</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Description</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="service in services" :key="service.id" class="border-t">
            <td class="py-2 px-4">{{ service.name }}</td>
            <td class="py-2 px-4">{{ service.description }}</td>
            <td class="py-2 px-4">
              <button
                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600"
                @click="deleteServices(service.id)"
              >
                Delete
              </button>
            </td>
            <td class="py-2 px-4">
              <button @click="showEditModal(service)" class="text-blue-500 hover:underline">
                Edit
              </button>
            </td>
          </tr>
          <tr v-if="services.length === 0">
            <td colspan="3" class="py-2 px-4 text-center text-gray-500">No users found</td>
          </tr>
        </tbody>
      </table>
    </div>
    <EditServiceModal
      v-if="isRoleSelectionModalVisible"
      :name="selectedService?.name ?? ''"
      :description="selectedService?.description ?? ''"
      @close="isRoleSelectionModalVisible = false"
      @save="updateService"
    />
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useServiceStore } from '@/stores/useServiceStore'
import { useRouter } from 'vue-router'
import EditServiceModal from '@/components/EditServiceModal.vue'
import { useAuthStore } from '@/stores/useAuthStore'

const { services, delete: deleteService, update } = useServiceStore()
const router = useRouter()
const isRoleSelectionModalVisible = ref(false)
const selectedService = ref<Service>()
const authStore = useAuthStore()

const deleteServices = async (id: number) => {
  try {
    const response = await deleteService(id)
    console.log('Item deleted', response)
    router.push('/services')
  } catch (error) {
    console.error('Failed to delete item:', error)
  }
}

const showEditModal = (service: Service) => {
  selectedService.value = service
  isRoleSelectionModalVisible.value = true
}

const updateService = async (data: ServiceRequest) => {
  if (selectedService.value) {
    const serviceId = selectedService.value.id
    selectedService.value.name = data.name
    isRoleSelectionModalVisible.value = false
    try {
      const response = await update(serviceId, data)
      console.log('Item edited', response)
      router.push('/services')
    } catch (error) {
      console.error('Failed to edit item:', error)
    }
  }
}
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
