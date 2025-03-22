<script setup>
import { RouterLink } from 'vue-router';

defineProps(['pack'])
</script>

<template>

  <div class="antialiased text-gray-900 ">
    <div class="overflow-hidden bg-white rounded-lg shadow-xl w-60 h-96 shadow-indigo-400">
      <!--E11-->
      <img class="object-cover w-full h-48 object-end" :src="pack.image" alt="Home in Countryside" />

      <div class="px-3 py-4">
        <span
          class="inline-block px-4 py-1 mx-1 text-xs font-semibold tracking-wide text-indigo-800 uppercase bg-indigo-200 rounded-full">{{
            pack.category }}</span>
        <RouterLink :to="{ name: 'packages.details', params: { slug: pack.slug } }">
          <h4 class="text-lg font-semibold leading-tight truncate ">{{ pack.title }}</h4>
        </RouterLink>
        <div class="flex items-baseline">

          <div class="text-xs font-semibold tracking-wide text-gray-600 uppercase ">
            {{ pack.destination }}<br />
            {{ pack.duration }} days
          </div>
        </div>

        <div class="mt-1">
          <span>$ {{ pack.price }}</span>  <span v-if="pack.priced"
            class="inline-block px-4 py-1 mx-1 text-xs font-semibold tracking-wide text-red-800 uppercase bg-red-200 rounded-full"
            title="Discount">10% </span>
         
        </div>

      </div>
    </div>
  </div>
</template>
