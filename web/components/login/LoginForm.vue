<script setup lang="ts">
import { useForm, useField } from 'vee-validate'
import * as yup from 'yup'

// Validation schema
const schema = yup.object({
  email: yup.string().required('E-Mail ist erforderlich').email('Ungültige E-Mail-Adresse'),
  password: yup.string().required('Passwort ist erforderlich'),
})

// Initialize form
const { handleSubmit, errors } = useForm({
  validationSchema: schema,
})

// Fields
const { value: email } = useField<string>('email')
const { value: password } = useField<string>('password')

// Submit handler
const onSubmit = handleSubmit((values) => {
  console.log('Login:', values)
  alert(`Anmelden mit ${values.email}`)
})
</script>

<template>
  <div class="card card-login">
    <div class="card-body">
      <h1 class="login-title h5 mb-5">Willkommen zurück!</h1>

      <form @submit.prevent="onSubmit" novalidate>
        <!-- Email -->
        <div class="mt-2 mb-3">
          <div class="position-relative">
            <input
                id="email"
                v-model="email"
                type="email"
                class="form-control"
                :class="{ 'is-invalid': errors.email }"
                placeholder="E-Mail eingeben"
            />
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3 text-muted">…</span>
            <div v-if="errors.email" class="invalid-feedback">{{ errors.email }}</div>
          </div>
        </div>

        <!-- Password -->
        <div class="mb-4">
          <div class="position-relative">
            <input
                id="password"
                v-model="password"
                type="password"
                class="form-control"
                :class="{ 'is-invalid': errors.password }"
                placeholder="Passwort eingeben"
            />
            <span class="position-absolute top-50 end-0 translate-middle-y pe-3">
              <span class="me-2">…</span>
              <span role="button" aria-label="show password">👁</span>
            </span>
            <div v-if="errors.password" class="invalid-feedback">{{ errors.password }}</div>
          </div>
        </div>

        <!-- Forgot Password -->
        <div class="mb-4">
          <NuxtLink to="#" class="small text-decoration-none gMbXYi">
            Passwort vergessen <span class="ms-1">›</span>
          </NuxtLink>
        </div>

        <!-- Login Button -->
        <div class="d-grid mt-5 mb-3">
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

<style scoped>
.is-invalid {
  border-color: #dc3545;
}
.invalid-feedback {
  color: #dc3545;
  font-size: 0.85rem;
}
.form-control {
  height: 48px;
  padding: 10px 12px;
  font-size: 1rem;
  border-radius: 6px;
}
.login-title {
  margin: 0px;
  font-size: 24px;
  font-weight: 600;
  letter-spacing: 0.03px;
  font-style: normal;
  line-height: 24px;
  font-family: "Open Sans", ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
  color: rgb(64, 64, 64);
}
</style>
