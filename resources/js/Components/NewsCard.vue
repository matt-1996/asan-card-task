<template>
    <v-card
        class="mx-auto"
        max-width="1024"
    >
        <v-img
            height="200px"
            :src="props.news.image_url ?? '/images/noImage.avif'"
            cover
        ></v-img>

        <v-card-title>
            {{props.news.title}}
        </v-card-title>

        <v-card-subtitle>
            {{props.news.description}}
        </v-card-subtitle>

        <v-card-actions>
            <Link :href="route('news.single' , props.news.id)">
                <v-btn
                    color="orange-lighten-2"
                    text="More"
                    @click="getNews(props.news.id)"
                ></v-btn>
            </Link>

            <a :href="props.news.url">
                <v-btn
                    color="orange-lighten-2"
                    text="Go to Article"
                    @click="getNews(props.news.id)"
                ></v-btn>
            </a>


            <v-spacer></v-spacer>

            <v-btn


            ></v-btn>
        </v-card-actions>
    </v-card>
</template>

<script setup>

const props = defineProps({news : Array})
import { Link } from '@inertiajs/vue3'

</script>
