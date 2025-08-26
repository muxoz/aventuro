<script setup>
import { useFilterStore } from '@/stores/filter';
import { onMounted } from 'vue';
import { RouterLink } from 'vue-router';
import Category from '../icons/Category.vue';


const c = useFilterStore()

const filters = useFilterStore()

const search = () => {
  filters.queries.page = 1
  filters.navigate()
}

onMounted(() => {
  c.getCategories()
})
</script>

<template>
  <section>
    <!-- Container -->
    <div class="w-full px-5 mx-auto md:px-10 py-5 ">
      <!-- Component -->
      <div class="flex flex-col gap-12 ">
        <!-- Title -->
        <div class="flex flex-col gap-5">
          <h3 class="text-2xl font-bold md:text-5xl">Filter packages</h3>
        </div>
        <!-- Content -->
        <div class="grid gap-10 md:gap-12 lg:grid-cols-[max-content_1fr]">
          <!-- Filters -->
          <div class="mb-4 max-w-none lg:max-w-sm">
            <form name="wf-form-Filter" method="get" class="flex-col gap-6">
              <!-- Filters title -->
              <div class="mb-6 flex items-center justify-between py-4 [border-bottom:1px_solid_rgb(217,_217,_217)]">
                <h5 class="text-xl font-bold">Filters</h5>
                <RouterLink to="/packages" class="text-sm">
                  <p>Clear all</p>
                </RouterLink>
              </div>
              <!-- Search input -->
              <label class="input bg-white text-gray-900 mx-auto w-full mb-5">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                  <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5" fill="none"
                    stroke="currentColor">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                  </g>
                </svg>
                <input type="search w-full" class="grow" placeholder="Search" v-model="filters.queries.q"
                  @input="search()" />
              </label>
              <!-- Categories -->
              <div class="flex flex-col gap-6">
                <p class="font-semibold">Categories</p>
                <div class="flex flex-wrap items-center gap-2">
                  <template v-for="category, index in c.categories" v-bind:key="index">
                    <button type="button"
                      class="flex gap-3 rounded-md border border-gray-100 shadow bg-white/80 backdrop-blur-lg text-gray-900 p-1 font-semibold"
                      :class="filters.category === category.id ? 'bg-red-500' : ''" @click="() => {
                        filters.queries.categoryId = category.id
                        search()
                      }">
                      <Category class="w-5" />{{ category.name }}
                    </button>
                  </template>

                </div>
              </div>
            </form>
          </div>

          <slot />

        </div>
      </div>
    </div>
  </section>
</template>
