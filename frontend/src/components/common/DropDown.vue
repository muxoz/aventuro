<template>
    <div class="relative py-2 cursor-pointer group">

        <div class="flex items-center justify-between px-2 space-x-5 bg-indigo-600 rounded-sm ">
            <a class="my-1 text-base font-medium text-gray-200 menu-hover lg:mx-4">
                User
            </a>
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </span>
        </div>

        <div
            class="absolute z-50 flex flex-col invisible w-full px-4 py-1 text-gray-800 bg-indigo-100 shadow-xl group-hover:visible">

            <RouterLink to="/profile" class="block my-2 font-semibold text-gray-500 border-b border-gray-100 hover:text-black md:mx-2">
                Profile
            </RouterLink>
            <hr>
            <RouterLink to="/bookings" class="block my-2 font-semibold text-gray-500 border-b border-gray-100 hover:text-black md:mx-2">
                Bookings
            </RouterLink>
            <hr>
            <button @click="handleLogout()" class="block my-2 font-semibold text-red-500 border-b border-gray-100 hover:text-red-700 md:mx-2">
                Log out
            </button>


        </div>
    </div>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { RouterLink } from 'vue-router';

const {handleLogout} = useAuthStore();

</script>
