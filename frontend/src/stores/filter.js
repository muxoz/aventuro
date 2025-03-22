import client from "@/utils/client";
import { defineStore } from "pinia";
import { reactive, ref } from "vue";
import { useRoute, useRouter } from "vue-router";


export const useFilterStore = defineStore('filter', ()=>{

    const router = useRouter()
    const route = useRoute()
    const categories = ref([]);
    const queries = reactive({
        page: 1,
        q: '',
        categoryId: ''
    })

    async function getCategories(){
        if(sessionStorage.getItem('categories')){
            categories.value = JSON.parse(sessionStorage.getItem('categories'));
            return 
        }
        const res = await client.get('/api/v1/categories')

        categories.value = res.data;
        sessionStorage.setItem('categories', JSON.stringify(res.data))
    }

    function navigate(){
        if(route.name === 'bookings'){
            router.push({name: route.name, query: {page: queries.page}})
            return
        }
        router.push({name: route.name, query: queries})
    }



    return {getCategories, navigate, categories, queries}

})