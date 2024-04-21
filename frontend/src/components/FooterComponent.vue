<template>
  <div>
    <footer class="bg-gray-800 py-12 text-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
          <div>
            <h3 class="text-lg font-semibold mb-4">Navigation</h3>
            <ul>
              <li><router-link to="/" class="hover:underline">Home</router-link></li>
              <li><router-link to="/about" class="hover:underline">About Us</router-link></li>
              <li><router-link to="/services" class="hover:underline">Services</router-link></li>
              <li><router-link to="/contact" class="hover:underline">Contact</router-link></li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
            <p>123 Street Name, City, Country</p>
            <p>Email: info@example.com</p>
            <p>Phone: +123 456 7890</p>
          </div>

          <div>
            <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
            <div class="flex space-x-4">
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-facebook"></i></a>
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-white hover:text-gray-400"
                ><i class="fab fa-instagram"></i
              ></a>
              <a href="#" class="text-white hover:text-gray-400"><i class="fab fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
<style scoped>
.view-details-btn {
  background-color: #4a90e2;
  color: #fff;
  padding: 8px 16px;
  border-radius: 4px;
  text-align: center;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.view-details-btn:hover {
  background-color: #3579dc;
}
</style>
