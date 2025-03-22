<script setup>
import LoadingC from '@/components/common/LoadingC.vue';
import router from '@/router';
import { useAuthStore } from '@/stores/auth';
import client from '@/utils/client';
import { storeToRefs } from 'pinia';
import { ref, watch } from 'vue';
import { RouterLink, useRoute } from 'vue-router';

const {token} = storeToRefs(useAuthStore())

const route = useRoute()

const pack = ref();

watch(
  () => route.params.slug,
  async (newSlug) => {
    try {
        let res = await client.get(`/api/v1/packages/${newSlug}`);
        pack.value = res.data.package
    } catch (error) {
        if(error.response.status === 404) router.push('/404')
    }
  }, {immediate: true})


</script>

<template>
    <div class="py-2 ">
        <div class="max-w-6xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col -mx-4 md:flex-row" v-if="pack">
                <div class="px-4 md:flex-1">
                    <div class="h-[460px] rounded-lg  ">
                        <img class="object-cover w-full h-full rounded-lg"
                            :src="pack.image"
                            alt="Product Image">
                    </div>
                </div>
                <div class="px-4 py-1 md:flex-1">
                    <span class="inline-block px-4 py-1 mx-1 text-xs font-semibold tracking-wide text-indigo-800 uppercase bg-indigo-200 rounded-full"> 
                         {{ pack.category }}
                    </span>
                    <span class="inline-block px-4 py-1 mx-1 text-xs font-semibold tracking-wide text-red-800 uppercase bg-red-200 rounded-full" v-if="pack.priced" > 
                         With Discount: {{ pack.offer.discount }}%
                    </span>
                    <h1 class="mb-2 text-2xl font-bold text-gray-800 ">
                        {{ pack.title }}
                    </h1>
                    <p class="mt-2 text-gray-600 text-md">
                        {{ pack.description }}
                    </p>
                    <div>
                        <ul class="my-3 space-y-3 font-medium" v-for="item, index in pack.items" v-bind:key="index">
                            <li class="flex items-start lg:col-span-1">
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <p class="ml-3 leading-5 text-gray-800">
                                    {{ item.name }}
                                </p>
                            </li>
                        </ul>
                    </div>

                    <div class="flex flex-wrap mb-4 ">
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 ">Destination: </span>
                            <span class="text-gray-600 "> {{ pack.destination }}</span>
                        </div>
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 ">Duration: </span>
                            <span class="text-gray-600 "> {{ pack.duration }}</span>
                        </div>
                        <div class="mr-4">
                            <span class="font-bold text-gray-700 ">Price: </span>
                            <span class="text-gray-600 "> $ {{ pack.price }}</span>
                            <span class="text-red-600 " v-if="pack.priced">🎁 $ {{ parseInt(pack.priced) }}</span>
                        </div>
                    </div>

                    <div class="w-1/2 px-2 ">
                        <RouterLink :to="{name:'bookings.create', params: { slug: pack.slug }}" v-if="token" 
                            class="block w-full px-4 py-2 font-bold text-center text-white bg-indigo-600 rounded-full hover:bg-indigo-800">
                            Reserve
                        </RouterLink >
                        <RouterLink :to="{name:'login'}" v-else
                            class="block w-full px-4 py-2 font-bold text-center text-white bg-indigo-600 rounded-full hover:bg-indigo-800">
                            Reserve
                        </RouterLink >
                    </div>

                </div>
            </div>
            <div v-else class="flex justify-center">
                <LoadingC/>
            </div>
                
        </div>
    </div>
</template>
