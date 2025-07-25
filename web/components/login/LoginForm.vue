<script setup lang="ts">
const onSubmit = (e: Event) => {
  e.preventDefault()
  // Handle login
}
</script>

<template>
  <div class="card card-login">
    <div class="card-body">
      <h1 class="login-title h5 mb-4">Willkommen zurück!</h1>

      <form @submit="onSubmit" novalidate>
        <!-- Email -->
        <div class="mb-3">
          <label class="form-label small text-muted mb-1">E-Mail</label>
          <div class="position-relative">
            <input type="email" class="form-control" required />
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted">…</span>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-2">
          <label class="form-label small text-muted mb-1">Passwort</label>
          <div class="position-relative">
            <input type="password" class="form-control" required />
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
              <span class="me-2">…</span>
              <span role="button" aria-label="show password">👁</span>
            </span>
          </div>
        </div>

        <!-- Forgot Password -->
        <div class="mb-4">
          <NuxtLink to="#" class="small text-decoration-none gMbXYi">
            Passwort vergessen <span class="ms-1">›</span>
          </NuxtLink>
        </div>

        <!-- Login Button -->
        <div class="d-grid mb-3">
          <button type="submit" class="btn btn-brand jrsyPi">Anmelden</button>
        </div>

        <!-- Create Account -->
        <div class="d-grid">
          <NuxtLink to="#" class="btn btn-outline-secondary kWwaJi">
            Konto anlegen
          </NuxtLink>
        </div>
      </form>
    </div>
  </div>
</template>
