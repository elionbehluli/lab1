<template>
  <nav class="bg-gray-800 py-4">
    <div class="max-w-7xl mx-auto px-4">
      <div class="flex justify-between">
        <div class="flex space-x-4">
          <router-link to="/" class="text-white text-xl font-bold">Your Logo</router-link>

          <router-link to="/" class="page-link">Home</router-link>
          <router-link to="/about" class="page-link">About</router-link>
          <router-link to="/services" class="page-link">Services</router-link>
          <router-link to="/cars" class="page-link">Cars</router-link>
          <router-link to="/contact" class="page-link">Contact</router-link>
        </div>

        <div class="flex space-x-4">
          <router-link to="/login" class="text-white hover:text-gray-300">
            <button class="button">Login</button>
          </router-link>
          <router-link to="/register" class="text-white hover:text-gray-300">
            <button class="button">Register</button>
          </router-link>
        </div>
      </div>
    </div>
  </nav>
</template>
