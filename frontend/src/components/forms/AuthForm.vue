<script setup>
import { reactive } from 'vue';
import { RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import ErrorsF from '../common/ErrorsF.vue';

const { type } = defineProps({
  type: String
})

const auth = useAuthStore();

const user = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const handleSubmit = () => {
  if (type === 'Login') {
    auth.handleLogin(user);
  } else {
    auth.handleRegister(user);
  }
}
</script>

<template>
  <section class="flex items-center justify-center w-full h-screen">
    <div class="w-full max-w-xs p-5 m-auto border border-gray-100 shadow bg-white/80 backdrop-blur-lg rounded  ">
      <RouterLink to="/">
        <img class="w-20 mx-auto mb-2" src="/favicon.ico" />
      </RouterLink>
      <ErrorsF :errors="auth.errors" />

      <form @submit.prevent="handleSubmit()">
        <fieldset class="fieldset" v-if="type === 'Register'">
          <legend class="fieldset-legend text-lg text-gray-800">Name</legend>
          <input type="text" class="input" placeholder="Name" name="username" v-model="user.name" />
        </fieldset>

        <fieldset class="fieldset">
          <legend class="fieldset-legend text-lg text-gray-800">Email</legend>
          <input type="email" class="input" placeholder="Email" name="email" v-model="user.email" />
        </fieldset>

        <fieldset class="fieldset">
          <legend class="fieldset-legend text-lg text-gray-800">Password</legend>
          <input type="password" class="input" placeholder="Password" name="password" v-model="user.password" />
        </fieldset>

        <fieldset class="fieldset" v-if="type === 'Register'">
          <legend class="fieldset-legend text-lg text-gray-800">Password Confirmation</legend>
          <input type="password" class="input" placeholder="Password" name="password"
            v-model="user.password_confirmation" />
        </fieldset>

        <div>
          <button class="btn btn-soft btn-primary btn-block  mt-4 mb-1" type="submit">
            {{ type }}
          </button>
        </div>
      </form>
      <footer v-if="type === 'Login'">
        <RouterLink class="btn btn-soft btn-secondary btn-block" to="/register">Create Account</RouterLink>
      </footer>
    </div>
  </section>


</template>
