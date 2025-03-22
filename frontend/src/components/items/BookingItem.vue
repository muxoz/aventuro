<script setup>
import { RouterLink } from 'vue-router';


defineProps(['booking'])
</script>

<template>
    <RouterLink :to="{ name: 'packages.details', params: { slug: booking.package.slug } }"
        class="flex-grow w-full px-3 py-2 text-black bg-gray-100 border-l-8 rounded-md md:w-5/12 lg:w-3/12" 
        :class="{
            'border-indigo-500': booking.status === 'Pending',
            'border-green-500': booking.status === 'Payed' ,
            'border-red-500': booking.status === 'Cancelled' ,
            }">
        {{ booking.package.title }}

        <div class="pt-1 text-sm font-thin text-gray-500 gap-x-1">
            <span>date: {{ booking.travel_date }}</span> <br>
            <span>status: {{ booking.status }}</span>
        </div>
        <div class="pt-1 text-sm font-thin text-gray-500 gap-x-1">
            <span>peoples: {{ booking.quantity }}</span> <br>
            <span>total: {{ booking.total }}</span>
        </div>
    </RouterLink>
</template>
