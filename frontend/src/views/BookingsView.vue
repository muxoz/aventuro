<script setup>
import PaginationC from '@/components/common/PaginationC.vue';
import LoadingC from '@/components/common/LoadingC.vue';
import client from '@/utils/client';
import BookingItem from '@/components/items/BookingItem.vue'
import { onMounted, reactive, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useFilterStore } from '@/stores/filter';

const bookings = reactive({
    list: {},
    links: [],
    meta: {},
})

const route = useRoute()
const filter =useFilterStore()

watch(()=> route.query, async (newQ) => {
    let res = await client.get('/api/v1/bookings', { 
        params:{
            page: newQ.page ? newQ.page : 1 
        }
    });
    Object.assign(bookings, res.data);
    
}, {immediate: true})

onMounted(()=>{
  filter.queries.page= 1; 
})
</script>

<template>
    <div>
        <div class="flex justify-start gap-5 ms-5">
            <h3 class="text-2xl font-bold text-center md:text-5xl">Bookings</h3>
        </div>
        
        <template v-if="bookings.list.length >0">
             <div class="flex flex-wrap justify-center gap-4 p-6 font-serif text-lg" 
        >
            <template v-for="booking, index in bookings.list" v-bind:key="index">
                <BookingItem :booking />
            </template>
        </div>
        <div class="mx-auto sm:w-1/2">
            <PaginationC :meta="bookings.meta" name="bookings"  />
        </div>
        </template>
        <div v-else class="flex justify-center w-screen mt-10">
            <LoadingC />
        </div>
        

        
    </div>

</template>
