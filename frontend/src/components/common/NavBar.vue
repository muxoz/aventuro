<script setup lang="ts">
import { RouterLink } from 'vue-router';
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';
import DropDown from './DropDown.vue';

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
                    <RouterLink to="/packages" class="btn btn-secondary rounded-3xl">
                        Packages
                    </RouterLink>
                </div>
                <div class="flex items-center justify-end gap-3">
                    <template v-if="!token">
                        <RouterLink to="/register"
                            class="btn btn-soft btn-secondary rounded-4xl">
                            Register
                        </RouterLink>
                        <RouterLink to="/login"
                            class="btn btn-soft btn-primary rounded-4xl">
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