<script setup>
import { RouterLink } from 'vue-router';


</script>

<template>
    
<section>
  <!-- Container -->
  <div class="px-5 py-16 md:px-10 md:py-16">
    <!-- Component -->
    <div class="flex flex-col items-center w-full max-w-3xl mx-auto text-center ">
      <img src="/favicon.ico" alt="Logo" class="flex-none inline-block object-cover w-56 h-56 mx-auto mb-8 rounded-full shadow-2xl shadow-red-400" />
      <h1 class="mb-4 text-4xl font-bold md:text-6xl">404 Error</h1>
      <p class="max-w-lg mx-auto mb-5 text-sm text-gray-500 sm:text-base md:mb-6 lg:mb-8">
        Oops! Page not found. Let's get you back on track.
      </p>
      <RouterLink to="/" class="items-center inline-block px-8 py-4 font-semibold text-center text-white bg-black rounded-md shadow-2xl shadow-red-400"> Back Home </RouterLink>
    </div>
  </div>
</section>
</template>


