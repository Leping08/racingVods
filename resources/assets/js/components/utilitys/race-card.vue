<template>
    <v-card ripple :hover="true" :to="/races/+race.id">
        <race-toolbar :race="race" :title="title"></race-toolbar>
        <v-img :src="race.videos[0].thumbnail" :aspect-ratio="1.77777"></v-img>
    </v-card>
</template>

<script>
    import RaceToolbar from './race-toolbar.vue'
    export default {
        name: "race-card",
        props: [
            'race',
            'title'
        ],
        components: {RaceToolbar}
    }
</script>

<style scoped>

</style>