<script setup>
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';
import ErrorsF from '../common/ErrorsF.vue';

const {user, errors} = storeToRefs(useAuthStore())

const {getUser, updateUser} = useAuthStore()
 
 onMounted(()=>{
    getUser()
 })
</script>

<template>
    <section class="py-4 my-auto ">
        <div class="lg:w-[80%] md:w-[90%] xs:w-[96%] mx-auto flex gap-4">
            <div
                class="lg:w-[88%] md:w-[80%] sm:w-[88%] xs:w-full mx-auto shadow-2xl p-4 rounded-md h-fit self-center bg-indigo-200">
                <!--  -->
                <div class="">
                    <h1
                        class="mb-2 font-serif font-extrabold text-indigo-700 lg:text-3xl md:text-2xl sm:text-xl xs:text-xl">
                        Profile
                    </h1>
                    <ErrorsF :errors="errors"/>
                    <form @submit.prevent="updateUser()" >

                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <label for="" class="text-indigo-700 ">Name</label>
                                <input type="text" v-model="user.name"
                                    class="w-full p-3 mt-2 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
                                    placeholder="Name">
                            </div>
                            <div class="w-full mb-4 lg:mt-6">
                                <label for="" class="text-indigo-700 ">Email</label>
                                <input type="email"  v-model="user.email"
                                    class="w-full p-3 mt-2 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
                                    placeholder="Email">
                            </div>
                        </div>
                        
                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <label for="" class="text-indigo-700 ">Phone</label>
                                <input type="text"  v-model="user.phone"
                                    class="w-full p-3 mt-2 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
                                    placeholder="Phone">
                            </div>
                            <div class="w-full mb-4 lg:mt-6">
                                <label for="" class="text-indigo-700 ">Address</label>
                                <input type="text"  v-model="user.address"
                                    class="w-full p-3 mt-2 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-200"
                                    placeholder="Address">
                            </div>
                        </div>

                        <div class="w-full mt-4 text-lg font-semibold text-white bg-indigo-700 rounded-md hover:bg-indigo-900">
                            <button type="submit" class="w-full p-2">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>


