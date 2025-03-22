<script setup>
import { useFilterStore } from '@/stores/filter';


const { meta } = defineProps(['meta', 'name'])


const filter = useFilterStore()

const go = (value) => {
    filter.queries.page = filter.queries.page + value;
    filter.navigate()
}

const back = () => {
    filter.queries.page--;
    filter.navigate()
}

</script>
<template>
    <div class="flex items-center my-3">
        <button class="w-full p-4 text-base text-gray-600 bg-white border rounded-l-xl hover:bg-gray-100"
            @click="back()" v-if="meta.current_page >1" >
            <svg width=" 9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
            xmlns="http://www.w3.org/2000/svg">
            <path
                d="M1427 301l-531 531 531 531q19 19 19 45t-19 45l-166 166q-19 19-45 19t-45-19l-742-742q-19-19-19-45t19-45l742-742q19-19 45-19t45 19l166 166q19 19 19 45t-19 45z">
            </path>
            </svg>
        </button>
        <button class="w-full px-4 py-2 text-base text-indigo-500 bg-white border-t border-b hover:bg-gray-100">
            {{ meta.current_page }}
        </button>

        <button v-if="meta.current_page < meta.last_page"
        class="w-full px-4 py-2 text-base text-gray-600 bg-white border hover:bg-gray-100" @click="go(1)">
            {{ meta.current_page + 1 }}
        </button>
        <button  v-if="meta.current_page < meta.last_page-1"
        class="w-full px-4 py-2 text-base text-gray-600 bg-white border hover:bg-gray-100" @click="go(2)">
            {{ meta.current_page + 2 }}
        </button>



        <button @click="go(1)" v-if="meta.current_page < meta.last_page"
            class="flex justify-end w-full p-4 text-gray-600 bg-white border-t border-b border-r text-end rounded-r-xl hover:bg-gray-100">
            <svg width="9" fill="currentColor" height="8" class="" viewBox="0 0 1792 1792"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z">
                </path>
            </svg>
        </button>
    </div>
</template>
