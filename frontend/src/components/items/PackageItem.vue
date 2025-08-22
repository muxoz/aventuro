<script setup>
import { RouterLink } from 'vue-router';

defineProps(['pack'])
</script>

<template>

  <div class="antialiased text-gray-900 ">
    <div class="border border-gray-100 bg-white/70 backdrop-blur-lg
    overflow-hidden rounded-lg shadow-lg  w-60 h-96 shadow-indigo-300">
      <img class="object-cover w-full h-48 object-end" :src="pack.image" alt="Home in Countryside" />

      <div class="px-3 py-4">
        <span class="badge badge-primary rounded-lg">{{ pack.category }}</span>

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
          <span>$ {{ pack.price }}</span>
          <span v-if="pack.priced" class="badge badge-error rounded-lg mx-1" title="Discount">10%
          </span>

        </div>

      </div>
    </div>
  </div>
</template>
