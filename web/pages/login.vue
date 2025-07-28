<script setup lang="ts">
definePageMeta({
  layout: 'login'
})
</script>

<template>
  <div class="login-wrapper">
    <LoginForm />
  </div>
</template>

<style scoped>
.login-wrapper {
  width: 100%;
  max-width: 480px;
}
</style>

<style lang="scss" src="~/assets/scss/login.scss"></style>
<style lang="scss" src="~/assets/scss/borrowed.scss"></style>
