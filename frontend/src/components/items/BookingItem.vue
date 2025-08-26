<script setup>
import { RouterLink } from 'vue-router';


defineProps(['booking'])
</script>

<template>
    <RouterLink :to="{ name: 'packages.details', params: { slug: booking.package.slug } }"
        class="card w-96 bg-white/80 card-lg shadow-sm text-gray-800">
        <div class="card-body">
            <h2 class="card-title">
                {{ booking.package.title }}
            </h2>
            <p class="flex flex-col text-lg">
                <span>Date: {{ booking.travel_date }}</span> 
                <span>Status: {{ booking.status }}</span>
                <span>Peoples: {{ booking.quantity }}</span> 
                <span>Total: {{ booking.total }}</span>
            </p>
        </div>
    </RouterLink>
</template>
