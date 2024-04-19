<template>
  <div class="about-us-container">
    <div class="about-us-section">
      <h2 class="section-title">Company History</h2>
      <p class="section-content">Our journey began in 2013, when we established Autosallon Ekskluziv with a vision to provide convenient and reliable transportation solutions. Over the years, we have expanded our fleet and services, becoming a trusted name in the car rental industry.</p>
    </div>
    <div class="about-us-section">
      <h2 class="section-title">Our Team</h2>
      <p class="section-content">At Autosallon Ekskluziv, our team is dedicated to ensuring a seamless and enjoyable experience for our customers. From our customer service representatives to our maintenance crew, each member plays a vital role in delivering top-notch service.</p>
    </div>
    <div class="about-us-section">
      <h2 class="section-title">Mission and Values</h2>
      <p class="section-content">Our mission is to provide hassle-free car rental experiences at competitive prices. We are committed to transparency, reliability, and customer satisfaction. These values guide our decisions and interactions every day, ensuring that our customers receive the best possible service.</p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AboutUs'
}
</script>

<style scoped>
.about-us-container {
  max-width: 800px;
  margin: 0 auto;
  padding: 40px;
}

.about-us-section {
  margin-bottom: 40px;
}

.section-title {
  font-size: 24px;
  font-weight: bold;
  color: #3182ce;
  margin-bottom: 10px;
}

.section-content {
  font-size: 16px;
  color: #4a5568;
}

.btn {
  padding: 10px 20px;
  background-color: #3182ce;
  color: #fff;
  border: none;
  border-radius: 5px;
  font-size: 18px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn:hover {
  background-color: #4299e1;
}
</style>
