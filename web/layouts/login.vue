<template>
  <div class="login-layout d-flex flex-column min-vh-100">
    <!-- Header -->
    <header class="login-header border-bottom bg-white">
      <div class="container-header">
        <img src="/Logo_Raisin_homepage.svg" alt="WeltSparen" height="24" />
      </div>
    </header>

    <!-- Main content (centered between header & footer) -->
    <main class="flex-fill d-flex align-items-center justify-content-center">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="border-top bg-white">
      <div class="w-100 d-flex justify-content-center">
        <LoginFooter />
      </div>
    </footer>

  </div>
</template>

<script setup>
import LoginFooter from '~/components/login/LoginFooter.vue'
</script>

<style scoped>
.login-layout {
  background: #fff;
}
</style>
