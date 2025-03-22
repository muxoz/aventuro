<script setup>
import { useFilterStore } from '@/stores/filter';
import { onMounted } from 'vue';
import { RouterLink } from 'vue-router';


const c = useFilterStore()



const filters = useFilterStore()

const search = ()=>{
   filters.queries.page = 1
    filters.navigate()
}

onMounted(()=>{
  c.getCategories()
})
</script>

<template>
<section>
    <!-- Container -->
    <div class="w-full px-5 mx-auto md:px-10 ">
      <!-- Component -->
      <div class="flex flex-col gap-12">
        <!-- Title -->
        <div class="flex flex-col gap-5">
          <h3 class="text-2xl font-bold md:text-5xl">Filter packages</h3>
        </div>
        <!-- Content -->
        <div class="grid gap-10 md:gap-12 lg:grid-cols-[max-content_1fr]">
          <!-- Filters -->
          <div class="mb-4 max-w-none lg:max-w-sm">
            <form name="wf-form-Filter-2" method="get" class="flex-col gap-6">
              <!-- Filters title -->
              <div class="mb-6 flex items-center justify-between py-4 [border-bottom:1px_solid_rgb(217,_217,_217)]">
                <h5 class="text-xl font-bold">Filters</h5>
                <RouterLink to="/packages" class="text-sm">
                  <p>Clear all</p>
                </RouterLink>
              </div>
              <!-- Search input -->
              <input type="text" v-model="filters.queries.q"
              @input="search()"
                class="mb-10 block h-9 min-h-[44px] w-full rounded-md border border-solid border-[#cccccc] bg-[#f2f2f7] bg-[16px_center] bg-no-repeat py-3 pl-11 pr-4 text-sm font-bold text-[#333333] [background-size:18px] [border-bottom:1px_solid_rgb(215,_215,_221)]"
                placeholder="Search"
                style="background-image: url('https://assets.website-files.com/6458c625291a94a195e6cf3a/64b7a3a33cd5dc368f46daaa_MagnifyingGlass.svg');" />
              <!-- Categories -->
              <div class="flex flex-col gap-6">
                <p class="font-semibold">Categories</p>
                <div class="flex flex-wrap items-center gap-2">
                  <template v-for="category, index in c.categories" v-bind:key="index" >
                    <button type="button" class="flex gap-3 rounded-md bg-[#f2f2f7] p-3 font-semibold" :class="filters.category === category.id ? 'bg-red-500': ''"
                    @click="()=>{ 
                      filters.queries.categoryId = category.id 
                      search()
                      }">
                    <img
                      src="https://assets.website-files.com/6458c625291a94a195e6cf3a/64b7a3a33cd5dc368f46daab_design.svg"
                      alt="" class="inline-block" />
                    <p>{{ category.name }}</p>
                  </button> 
                  </template>
                             
                </div>
              </div>
            </form>
          </div>
          <!-- Decor -->
          <slot/>
          
        </div>
      </div>
    </div>
  </section>
</template>


