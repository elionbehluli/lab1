<template>
  <div
    v-if="isVisible"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4"
  >
    <div class="bg-white p-6 rounded-lg w-full max-w-2xl">
      <h2 class="text-lg font-bold mb-4">Edit Car Features</h2>
      <form @submit.prevent="saveFeatures">
        <div v-for="(feature, index) in features" :key="index" class="mb-2 flex items-center">
          <input
            type="text"
            v-model="features[index]"
            class="border rounded-md px-2 py-1 flex-grow"
            :placeholder="'Feature ' + (index + 1)"
          />
          <button
            type="button"
            @click="removeFeature(index)"
            class="ml-2 bg-red-500 text-white px-2 py-1 rounded"
          >
            Remove
          </button>
        </div>
        <button
          type="button"
          @click="addFeature"
          class="bg-green-500 text-white px-2 py-1 rounded my-2"
        >
          Add Feature
        </button>
        <div class="mt-4 flex justify-end">
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md mr-2">
            Save
          </button>
          <button
            type="button"
            @click="$emit('cancel')"
            class="bg-gray-500 text-white px-4 py-2 rounded-md"
          >
            Cancel
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  features: Array,
  isVisible: Boolean
})

const emits = defineEmits(['update-features', 'cancel'])
console.log(props.features)
function addFeature() {
  props.features.push('')
}

function removeFeature(index) {
  props.features.splice(index, 1)
}

function saveFeatures() {
  emits('update-features', props.features)
  emits('cancel') // Optionally close the modal after saving
}
</script>
