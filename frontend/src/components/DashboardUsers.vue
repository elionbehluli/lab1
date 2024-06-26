<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">User List</h1>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Name</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Email</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Role</th>
            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="border-t">
            <td class="py-2 px-4">{{ user.name }}</td>
            <td class="py-2 px-4">{{ user.email }}</td>
            <!-- <td class="py-2 px-4">{{ user.role }}</td> -->
            <td class="py-2 px-4">
              <button @click="showRoleSelection(user)" class="text-blue-500 hover:underline">
                {{ user.role }}
              </button>
            </td>
            <td class="py-2 px-4">
              <button
                class="bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600"
                @click="deleteUsers(user.id)"
              >
                Delete
              </button>
            </td>
          </tr>
          <tr v-if="users.length === 0">
            <td colspan="3" class="py-2 px-4 text-center text-gray-500">No users found</td>
          </tr>
        </tbody>
      </table>
    </div>
    <RoleSelectionModal
      v-if="isRoleSelectionModalVisible"
      :initialRole="selectedUser?.role ?? ''"
      @close="isRoleSelectionModalVisible = false"
      @save="updateUserRole"
    />
  </div>
</template>

<script setup lang="ts">
import { ref } from 'vue'
import { useUserStore } from '@/stores/useUserStore'
import { useRouter } from 'vue-router'
import RoleSelectionModal from '@/components/EditUserRole.vue'

const { users, delete: deleteUser, editRole } = useUserStore()
const router = useRouter()
const isRoleSelectionModalVisible = ref(false)
const selectedUser = ref<User>()

const deleteUsers = async (id: number) => {
  try {
    const response = await deleteUser(id)
    console.log('Item deleted', response)
    router.push('/users')
  } catch (error) {
    console.error('Failed to delete item:', error)
  }
}

const showRoleSelection = (user: any) => {
  selectedUser.value = user
  isRoleSelectionModalVisible.value = true
}

const updateUserRole = async (newRole: string) => {
  if (selectedUser.value) {
    const userId = selectedUser.value.id
    selectedUser.value.role = newRole
    isRoleSelectionModalVisible.value = false
    const roleRequest = { role: newRole }
    // Here, you can also add the code to update the user role in your backend or state
    try {
      const response = await editRole(userId, roleRequest)
      console.log('Item edited', response)
      router.push('/users')
    } catch (error) {
      console.error('Failed to edit item:', error)
    }
  }
}
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
