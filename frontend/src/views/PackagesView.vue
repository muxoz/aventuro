<script setup>
import PaginationC from '@/components/common/PaginationC.vue';
import PackageItem from '@/components/items/PackageItem.vue'
import FilterP from '@/components/layouts/FilterP.vue';
import { useFilterStore } from '@/stores/filter';
import client from '@/utils/client';
import { onMounted, reactive, watch } from 'vue';
import { useRoute } from 'vue-router';

const packages = reactive({
  list: {},
  links: [],
  meta: {},
})

const route = useRoute()
const filter = useFilterStore()

watch(() => route.query, async (query) => {
  let res = await client.get('/api/v1/packages', {
    params: {
      page: query.page ? query.page : 1,
      // 'title[eq]': query.q,
      'categoryId[eq]': query.categoryId,
      q: query.q
    }
  });
  Object.assign(packages, res.data);

}, { immediate: true })

onMounted(()=>{
  filter.queries.page= 1; 
})

</script>

<template>
  <FilterP>
    <div class="w-full [border-left:1px_solid_rgb(217,_217,_217)]" v-if="packages.list.length > 0">
      <div class="flex flex-wrap gap-2 " >
        <template v-for="pack, index in packages.list" v-bind:key="index">
        <PackageItem :pack />
        </template>
      </div>
      <PaginationC name="packages" :meta="packages.meta" />
    </div>
  </FilterP>
</template>
