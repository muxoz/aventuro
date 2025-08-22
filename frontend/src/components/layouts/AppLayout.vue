<template>
        <NavBar />
        <main class="pt-20">
                <RouterView />
        </main>
</template>

<script setup>
import NavBar from '@/components/common/NavBar.vue';
import { RouterView } from 'vue-router'

</script>
