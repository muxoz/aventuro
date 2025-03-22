<script setup>
import AlertD from '../common/AlertD.vue';

defineProps(['errors'])
</script>

<template v-if="errors.length > 0">
    <div v-for="error, index in errors" v-bind:key="index">
        <template v-for="(messages, index) in error" v-bind:key="index">
            <AlertD >{{ messages }}</AlertD>
        </template>   
    </div>
          
</template>