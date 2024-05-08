<script setup>
import {ref, watch} from "vue";
import axios from "axios";
import AppLayout from '@/Layouts/AppLayout.vue';
import NewsCard from "@/Components/NewsCard.vue";
import Echo from 'laravel-echo';

const date = new Date()
const tenDaysBefore = date.setDate(date.getDate() - 15); //number  of days to add, e.x. 15 days
var dateFormated = date.toISOString().substr(0,10);
const newses = ref()
const props = defineProps({news: Array})
const data = ref()
const source = ref('New York Times')
const startDate = ref(dateFormated)
const endDate = ref(new Date().toISOString().substr(0,10))

const fetchArticles = () => {
    axios.get(import.meta.env.BASE_URL +
        'api/ny-times/index', {params:{
            paginate: 10,
            start_date: startDate.value,
            end_date: endDate.value,
            source: source.value
        }})
        .then(res => {
            data.value = res.data
        })
}

window.Echo.channel('news')
    .listen('GetNews', (event) => {
        console.log("listening On Channel News")
        newses.value = event.news
    });


const getArticles = () => {
    newses.value = data.value.data
}

watch([startDate, endDate, source], function(){
    fetchArticles()
})



</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <v-form >
                    <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-select
                                    v-model="source"
                                    :items="['New York Times' , 'News Api']"
                                    label="Item"
                                    required
                                ></v-select>

                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                            >
                                <v-text-field
                                    v-model="startDate"
                                    :counter="10"
                                    :rules="nameRules"
                                    label="Start Date"
                                    type="date"
                                    hide-details
                                ></v-text-field>
                            </v-col>

                            <v-col
                                cols="12"
                                md="4"
                            >

                                <v-text-field
                                    v-model="endDate"
                                    :counter="10"
                                    :rules="nameRules"
                                    label="Start Date"
                                    type="date"
                                    hide-details
                                ></v-text-field>

                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
                <div>
                    <v-icon
                        color="green-darken-2"
                        icon="mdi-refresh"
                        size="large"
                        @click="getArticles()"
                    ></v-icon>
                </div>
                <div class="p-4 bg-white overflow-hidden grid grid-cols-4 gap-4 shadow-xl sm:rounded-lg">
                    <div v-for="news in newses">

                        <NewsCard v-if="newses" :news="news" />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
