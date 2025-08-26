<template>
    <details class="dropdown">
        <summary class="btn m-1">User</summary>
        <ul class="menu dropdown-content bg-base-100 rounded-box z-1 w-52 p-2 shadow-sm">
            <li>
                <RouterLink to="/profile">
                    Profile
                </RouterLink>
            </li>
            <li>
                <RouterLink to="/bookings">
                    Bookings
                </RouterLink>
            </li>
            <li>
                <button @click="handleLogout()">
                    Log out
                </button>
            </li>
        </ul>
    </details>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { RouterLink } from 'vue-router';

const { handleLogout } = useAuthStore();

</script>
