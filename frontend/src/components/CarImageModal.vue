<template>
  <div
    v-if="isVisible"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4"
  >
    <div class="bg-white p-6 rounded-lg w-full max-w-3xl">
      <h2 class="text-lg font-bold mb-4">Manage Car Images</h2>
      <div
        class="drop-area border-2 border-dashed border-gray-300 p-4 text-center"
        @dragover.prevent
        @dragenter.prevent
        @drop="handleDrop"
      >
        <input
          ref="fileInput"
          type="file"
          accept="image/*"
          multiple
          class="hidden"
          @change="handleFiles"
        />
        <p>Drag & Drop photos here or click to browse</p>
        <button @click="openFileInput" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">
          Browse
        </button>
      </div>
      <div class="grid grid-cols-3 gap-4 mt-4">
        <div v-for="(photo, index) in carImages" :key="photo.id" class="relative">
          <img :src="photo.image_url" :alt="'Uploaded Photo ' + index" class="max-w-full h-auto" />
          <button
            @click="deletePhoto(index, photo)"
            class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 rounded-full"
          >
            x
          </button>
        </div>
      </div>
      <div class="mt-4 flex justify-end">
        <button @click="saveImages" class="bg-green-500 text-white px-4 py-2 rounded-md mr-2">
          Save
        </button>
        <button @click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded-md">
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineEmits, toRefs, type PropType } from 'vue'

const props = defineProps({
  carImages: {
    type: Array as PropType<Image[]>,
    required: true
  },
  isVisible: Boolean
})

const emits = defineEmits(['update-images', 'cancel'])

const { carImages } = toRefs(props)
const newImages = ref<File[]>([])
const deletedImageIds = ref<number[]>([])

const fileInput = ref<HTMLInputElement | null>(null)

function openFileInput() {
  fileInput.value?.click()
}

function handleFiles(event: Event) {
  const files = (event.target as HTMLInputElement).files
  if (files) {
    processFiles(files)
  }
}

function handleDrop(event: DragEvent) {
  event.preventDefault()
  const files = event.dataTransfer?.files
  if (files) {
    processFiles(files)
  }
}

function processFiles(files: FileList) {
  for (let i = 0; i < files.length; i++) {
    const file = files[i]
    if (file.type.startsWith('image/')) {
      const reader = new FileReader()
      reader.onload = () => {
        carImages.value.push({ id: -1, car_id: -1, image_url: reader.result as string, mime_type: '', size: '', created_at: '', updated_at: '' })
      }
      reader.readAsDataURL(file)
      newImages.value.push(file)
    }
  }
}

function deletePhoto(index: number, photo: Image) {
  if (photo.id !== -1) {
    deletedImageIds.value.push(photo.id)
  } else {
    const newIndex = newImages.value.indexOf(photo as unknown as File)
    if (newIndex > -1) newImages.value.splice(newIndex, 1)
  }
  carImages.value.splice(index, 1)
}

function saveImages() {
  emits('update-images', {
    newImages: newImages.value,
    deletedImageIds: deletedImageIds.value
  })
  closeModal()
}

function closeModal() {
  emits('cancel')
}
</script>

<style scoped>
.drop-area {
  cursor: pointer;
}
</style>
