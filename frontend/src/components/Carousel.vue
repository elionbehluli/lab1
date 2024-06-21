<template>
  <div class="relative w-full max-w-md mx-auto">
    <div class="overflow-hidden relative">
      <div
        class="flex transition-transform duration-300 ease-in-out"
        :style="{ transform: `translateX(-${currentIndex * 100}%)` }"
      >
        <div v-for="(image, index) in images" :key="index" class="w-full flex-shrink-0">
          <img :src="image.image_url" :alt="`Image ${index + 1}`" class="w-full h-full object-cover" />
        </div>
      </div>
    </div>
    <button @click="prev" class="carousel-button left-0">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
    </button>
    <button @click="next" class="carousel-button right-0">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>
    <div class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 py-4">
      <span
        v-for="(image, index) in images"
        :key="index"
        @click="goTo(index)"
        :class="['block h-2 w-2 rounded-full cursor-pointer', { 'bg-blue-600': index === currentIndex, 'bg-gray-400': index !== currentIndex }]"
      ></span>
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref } from 'vue';

const props = defineProps({
  images: {
    type: Array,
    required: true,
  },
});

const currentIndex = ref(0);

const next = () => {
  if (currentIndex.value < props.images.length - 1) {
    currentIndex.value += 1;
  } else {
    currentIndex.value = 0;
  }
};

const prev = () => {
  if (currentIndex.value > 0) {
    currentIndex.value -= 1;
  } else {
    currentIndex.value = props.images.length - 1;
  }
};

const goTo = (index: number) => {
  currentIndex.value = index;
};
</script>

<style scoped>
.carousel-button {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 0, 0, 0.5);
  border: none;
  color: white;
  padding: 0.5rem;
  cursor: pointer;
  transition: background 0.3s ease-in-out;
}
.carousel-button:hover {
  background: rgba(0, 0, 0, 0.7);
}
.carousel-button svg {
  width: 1.5rem;
  height: 1.5rem;
}
.carousel-button.left-0 {
  left: 0.5rem;
}
.carousel-button.right-0 {
  right: 0.5rem;
}
</style>
