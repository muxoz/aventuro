<script setup>
import PackageItem from '@/components/items/PackageItem.vue';
import client from '@/utils/client';
import { onMounted, ref } from 'vue';

import { RouterLink } from 'vue-router';

const packs = ref([])


onMounted(async()=>{
    let res = await client.get('/api/v1/packages');
    packs.value = res.data.list.slice(0, 3);
})

</script>


  <template>
    <div class="bg-pattern">
        <header >
            <div class="max-w-screen-xl px-4 py-4 mx-auto sm:px-7">
                <div class="flex items-center justify-center gap-4 md:gap-4">
                    <div class="flex col-span-12 mx-auto text-5xl font-bold md:col-span-4">                    
                            Aventuro
                    </div>
                </div>
            </div>
        </header>
        <section>
            <div class="flex flex-col max-w-screen-xl gap-10 px-4 py-5 mx-auto sm:px-7">
                <h1 data-aos="fade-up" data-aos-delay="500" class="flex flex-col text-2xl text-center md:text-6xl">
                    <span>Explore Beyond the Horizon</span>
                </h1>
            </div>
        </section>
    </div>
    <section class="bg-[radial-gradient(145.05%_100%_at_50%_0%,#1D2B41_0%,#020509_57.38%,#0F1A29_88.16%)]">
        <div class="flex flex-col max-w-screen-xl px-10 mx-auto py-14">
            <h2 class="flex flex-col pb-5 text-2xl font-bold text-center text-white md:text-6xl">
                Our Packages
            </h2>
            <span class="text-white pb-10 max-w-[600px] mx-auto text-center block ">
                Discover a world of adventure with our curated travel packages. Whether you seek a tranquil beach retreat, an exhilarating mountain trek, or a cultural experience, we have the perfect package. 
            </span>
            <div class="flex flex-wrap justify-center gap-4">
            
                <template v-for="pack, index in packs" v-bind:key="index" >
                    <PackageItem :pack/>                
                </template>
              
            </div>
            <RouterLink to="/packages"
                class="inline-block px-6 py-2 mx-auto mt-10 font-bold text-white bg-purple-600 border-2 border-purple-600 rounded-lg hover:bg-white hover:text-purple-600">
                More Packages 
            </RouterLink>
        </div>
    </section>
</template>

