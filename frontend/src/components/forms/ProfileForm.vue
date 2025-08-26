<script setup>
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';
import ErrorsF from '../common/ErrorsF.vue';

const { user, errors } = storeToRefs(useAuthStore())

const { getUser, updateUser } = useAuthStore()

onMounted(() => {
    getUser()
})
</script>

<template>
    <section class="py-4 my-auto ">
        <div class="lg:w-[80%] md:w-[90%] xs:w-[96%] mx-auto flex gap-4">
            <div
                class="lg:w-[88%] md:w-[80%] sm:w-[88%] xs:w-full mx-auto shadow-2xl p-4 rounded-md h-fit self-center bg-white/80">
                <!--  -->
                <div class="">
                    <h1
                        class="mb-2 font-serif font-extrabold text-gray-800 lg:text-3xl md:text-2xl sm:text-xl xs:text-xl">
                        Profile
                    </h1>
                    <ErrorsF :errors="errors" />
                    <form @submit.prevent="updateUser()">
                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset ">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Name</legend>
                                    <input type="text" class="input w-full" placeholder="Name"
                                        v-model="user.name" />
                                </fieldset>
                            </div>

                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Email</legend>
                                    <input type="email" class="input w-full" placeholder="Email"
                                        v-model="user.email" />
                                </fieldset>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Phone</legend>
                                    <input type="phone" class="input w-full" v-model="user.phone" />
                                </fieldset>
                            </div>

                            <div class="w-full mb-4 lg:mt-6 ">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Address</legend>
                                    <input type="text" class="input w-full"  v-model="user.address" />
                                </fieldset>
                            </div>
                        </div>

                        <div
                            class="btn btn-primary btn-block">
                            <button type="submit" class="w-full p-2">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
