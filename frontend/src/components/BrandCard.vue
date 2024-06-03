<template>
  <div class="shadow-lg rounded-lg overflow-hidden hover:transform hover:scale-105 transition duration-300 ease-in-out">
    <img :src="brand.logo_url" :alt="brand.name" class="w-full h-56 object-cover" />
    <div class="p-4">
      <span class="font-bold text-l">{{ brand.name }}</span>
    </div>
    <div class="p-4" v-if="authStore.isAdmin">
      <button
        @click="showDeleteConfirmation = true"
        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
      >
        Delete Item
      </button>
      <DeleteConfirmation
        :isVisible="showDeleteConfirmation"
        @confirm="handleDeletion(brand.id)"
        @cancel="showDeleteConfirmation = false"
      />
    </div>
    <div v-if="authStore.isAdmin">
  <router-link :to="{ name: 'EditBrandForm', params: { id: brand.id }}" class="text-black hover:text-gray-300">
    <button class="py-1 px-2">Edit</button>
  </router-link>
</div>
  </div>
</template>

<script setup lang="ts">
import { defineProps, type PropType, ref } from 'vue'
import { useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/useAuthStore';
import DeleteConfirmation from '@/components/DeleteConfirmation.vue';
import { useBrandStore } from '@/stores/useBrandStore';

const showDeleteConfirmation = ref(false);
const authStore = useAuthStore();
const brandStore = useBrandStore();


defineProps({
  brand: {
    type: Object as PropType<Brand>,
    required: true,
    default: () => {}
  },
  cardWidth: {
    type: String,
    default: '300px'
  }
})

const handleDeletion = async (id: number) => {
  const carId = id;
  try {
    const response = await brandStore.delete(id);
    console.log('Item deleted', response);
    showDeleteConfirmation.value = false;
    router.push('/cars');
  } catch (error) {
    console.error('Failed to delete item:', error);
  }
    console.log(id); // Output the value to the console
};

const router = useRouter()

function goToBrand(id: number) {
  router.push(`/brands/${id}`)
}
</script>
