<script setup>
import {ref, watchEffect} from "vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsCard from "@/Components/NewsCard.vue";
import axios from "axios";

const props = defineProps({id : String})

const news = ref()

watchEffect(function(){
    axios.get(import.meta.env.BASE_URL + 'api/ny-times/show/' + props.id)
        .then(res => {
            news.value = res.data;
        })
})
</script>
<template>
    <AppLayout title="News">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                News
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 bg-white overflow-hidden gap-4 shadow-xl sm:rounded-lg">
                    <div>
                        <NewsCard v-if="news" :news="news" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


