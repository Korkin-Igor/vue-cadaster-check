<template>
  <div id="app">
    <Header />
    <main class="main-content">
      <HeroSection />
      <WhyImportant />
      <WhoNeedsIt />
      <WhatToDo />
      <HowToSubmit />
      <FreeCheck />
    </main>
    <Footer />
  </div>
</template>

<script setup>
import Header from './components/Header.vue'
import HeroSection from './components/HeroSection.vue'
import WhyImportant from './components/WhyImportant.vue'
import WhoNeedsIt from './components/WhoNeedsIt.vue'
import WhatToDo from './components/WhatToDo.vue'
import HowToSubmit from './components/HowToSubmit.vue'
import FreeCheck from './components/FreeCheck.vue'
import Footer from './components/Footer.vue'
</script>

<style>
:root {
  --primary-color: #1533aa;
  --primary-hover: #1d4ed8;
  --text-main: #1f2937;
  --text-secondary: #4b5563;
  --bg-light: #f3f4f6;
  --white: #ffffff;
  --danger-bg: #fef2f2;
  --danger-text: #991b1b;
  --success-text: #065f46;
}

* { box-sizing: border-box; margin: 0; padding: 0; }

body {
  font-family: system-ui, -apple-system, sans-serif;
  color: var(--text-main);
  line-height: 1.6;
}

.container {
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
}

.main-content {
  margin-top: 70px;
}
</style>