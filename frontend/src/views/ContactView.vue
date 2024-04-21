<template>
  <div>
    <!-- Contact Form Section -->
    <section class="py-12 bg-gray-100">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Contact Us</h2>
        <!-- Contact Form -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden border-2 border-gray-300">
          <form class="p-8">
            <!-- Name Input -->
            <div class="mb-6">
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input
                type="text"
                id="name"
                name="name"
                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-4 py-3 transition duration-300 ease-in-out transform hover:scale-105"
              />
            </div>
            <!-- Email Input -->
            <div class="mb-6">
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-4 py-3 transition duration-300 ease-in-out transform hover:scale-105"
              />
            </div>
            <!-- Message Input -->
            <div class="mb-6">
              <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
              <textarea
                id="message"
                name="message"
                rows="6"
                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md px-4 py-3 transition duration-300 ease-in-out transform hover:scale-105"
              ></textarea>
            </div>
            <!-- Submit Button -->
            <div class="text-center">
              <button
                type="submit"
                class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded shadow-md transition duration-300 ease-in-out transform hover:scale-105"
              >
                Send Message
              </button>
            </div>
          </form>
        </div>
        <!-- Additional Information -->
        <div class="mt-8 text-gray-600 text-center">
          <p class="mb-2">For any inquiries or questions, please fill out the form.</p>
          <p>We'll get back to you as soon as possible.</p>
        </div>
      </div>
    </section>
  </div>
</template>
<style scoped>
input[type='text'],
input[type='email'],
textarea {
  border: 2px solid #d2d6dc;
}

input[type='text']:focus,
input[type='email']:focus,
textarea:focus {
  border-color: #4299e1;
}

button {
  transition: all 0.3s ease;
}

button:hover {
  background-color: #2b6cb0;
  transform: translateY(-2px);
}

button:focus {
  outline: none;
}
</style>
