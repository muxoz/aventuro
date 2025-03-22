<script setup lang="ts">
import { RouterLink } from 'vue-router';
import DropDown from './DropDown.vue';
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';

const {token} = storeToRefs(useAuthStore());
</script>

<template>
    <header
        class="fixed inset-x-0 top-0 z-30 w-full max-w-screen-md py-2 mx-auto border border-gray-100 shadow bg-white/80 backdrop-blur-lg md:top-2 md:rounded-3xl lg:max-w-screen-lg">
        <div class="px-4">
            <div class="flex items-center justify-between">
                <div class="flex shrink-0">
                    <RouterLink aria-current="page" class="flex items-center" to="/">
                        <img class="w-auto h-10" src="/favicon.ico" alt="logo">
                    </RouterLink>
                </div>
                <div class=" md:flex md:items-center md:justify-center md:gap-5">
                    <RouterLink to="/packages" active-class="border-b border-indigo-600 "
                        class="inline-block px-2 py-1 text-sm font-medium text-gray-900 transition-all duration-200 hover:bg-gray-100 hover:text-gray-900">
                        Packages
                    </RouterLink>
                </div>
                <div class="flex items-center justify-end gap-3">
                    <template v-if="!token">
                        <RouterLink to="/register"
                            class="items-center justify-center px-3 py-2 text-sm font-semibold text-gray-900 transition-all duration-150 bg-white shadow-sm rounded-xl ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:inline-flex">
                            Register
                        </RouterLink>
                        <RouterLink to="/login"
                            class="inline-flex items-center justify-center px-3 py-2 text-sm font-semibold text-white transition-all duration-150 bg-indigo-600 shadow-sm rounded-xl hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Login
                        </RouterLink>
                    </template>
                    <template v-else>
                          <DropDown/>
                    </template>
                </div>
            </div>
        </div>
    </header>

</template>