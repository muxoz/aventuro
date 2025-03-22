<script setup>
import { reactive } from 'vue';
import { RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import ErrorsF from '../common/ErrorsF.vue';

const {type} = defineProps({
  type: String
})

const auth = useAuthStore();

const user = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const handleSubmit = ()=>{
  if(type === 'Login'){
    auth.handleLogin(user);
  }else{
    auth.handleRegister(user);
  }
}
</script>

<template>
  <section class="flex items-center justify-center w-full h-screen">
    <div class="w-full max-w-xs p-5 m-auto bg-indigo-300 rounded shadow-2xl ">
      <RouterLink to="/">
        <img class="w-20 mx-auto mb-2" src="/favicon.ico" />
      </RouterLink>
        <ErrorsF :errors="auth.errors"/>
        
      <form @submit.prevent="handleSubmit()" >
        <div v-if="type === 'Register'" >
          <label class="block mb-2 text-indigo-500 rounded-md" for="username">Name</label>
          <input class="w-full p-2 mb-3 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
            type="text" name="username" v-model="user.name">
        </div>
        <div >
          <label class="block mb-2 text-indigo-500 rounded-md" for="username">Email</label>
          <input class="w-full p-2 mb-3 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
            type="email" name="email" v-model="user.email">
        </div>
        <div>
          <label class="block mb-2 text-indigo-500" for="password">Password</label>
          <input class="w-full p-2 mb-3 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
            type="password" name="password" v-model="user.password">
        </div>
        <div v-if="type === 'Register'">
          <label class="block mb-2 text-indigo-500" for="password">Password Confirmation</label>
          <input class="w-full p-2 mb-3 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
            type="password" name="password" v-model="user.password_confirmation">
        </div>
        <div>
          <button class="w-full px-4 py-2 mb-3 font-bold text-white bg-indigo-700 rounded hover:bg-pink-700"
            type="submit">
             {{type}}
          </button>
        </div>
      </form>
      <footer v-if="type === 'Login'">
        <RouterLink class="float-right text-sm text-indigo-700 hover:text-pink-700" to="/register">Create Account</RouterLink>
      </footer>
    </div>
  </section>


</template>


