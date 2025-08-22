<script setup>
import ErrorsF from '@/components/common/ErrorsF.vue';
import client from '@/utils/client';
import { computed, reactive, ref, watch } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { useToast } from 'vue-toastification';

const toast = useToast();
const route = useRoute()
const r = useRouter()
const count = ref(1);
const pack = reactive({ data: {} });

const booking = reactive({
    package_id: 0,
    phone: '',
    address: '',
    travel_date: '',
    quantity: 1,
    errors: []
})


watch(
    () => route.params.slug,
    async (newSlug) => {
        try {
            let res = await client.get(`/api/v1/packages/${newSlug}`);
            pack.data = res.data.package
        } catch (error) {
            if (error.response.status === 404) r.push('/404')
        }
    }, { immediate: true })



const total = computed(() => count.value * (pack.data.priced ? pack.data.priced : pack.data.price))

const handleSubmit = async () => {
    booking.package_id = pack.data.id
    booking.quantity = count;
    try {
        await client.post('/api/v1/bookings', booking);
        toast.success('Booking Created')
        r.push('/bookings')
    } catch (error) {
        if (error.response.status === 422) {
            booking.errors = error.response.data.errors
        }

    }
}


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
                        Create Bookings
                    </h1>
                    <ErrorsF :errors="booking.errors" />
                    <form @submit.prevent="handleSubmit()">
                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset ">
                                    <legend class="fieldset-legend text-gray-800 text-lg">phone</legend>
                                    <input type="phone" class="input w-full" placeholder="phone" v-model="booking.phone" />
                                </fieldset>
                            </div>

                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Address</legend>
                                    <input type="text" class="input w-full" placeholder="Address" v-model="booking.address" />
                                </fieldset>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center w-full gap-2 lg:flex-row md:flex-col sm:flex-col">
                            <div class="w-full mb-4 lg:mt-6">
                                <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">Travel Date</legend>
                                    <input type="Date" class="input w-full"  v-model="booking.travel_date" />
                                </fieldset>
                            </div>

                            <div class="w-full mb-4 lg:mt-6 text-gray-800">
                                 <fieldset class="fieldset">
                                    <legend class="fieldset-legend text-gray-800 text-lg">People</legend>
                                    <input type="range" class="input w-full" min="1" max="20" v-model="count"/>
                                </fieldset>
                                {{ count }}
                            </div>
                        </div>
                        <p class="mb-2 font-serif font-extrabold text-gray-700 text-md">
                            Price: {{ pack.data.priced ? pack.data.priced : pack.data.price }} *
                            People: {{ count }}
                        </p>

                        <p class="mb-2 font-serif font-extrabold text-gray-800 lg:text-3xl md:text-2xl text-md">
                            {{ 'Total: ' + total }}
                        </p>

                        <div class="btn btn-primary btn-block text-lg">
                            <button type="submit" class="w-full p-2">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
