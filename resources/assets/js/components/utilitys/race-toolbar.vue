<template>
    <v-toolbar color="grey darken-4">
        <v-toolbar-title>
            <template v-if="title">{{title}}</template>
            <template v-else="title">{{race.name}}</template>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon
                v-if="race.new"
                color="primary"
                class="mr-2"
        >
            mdi-new-box
        </v-icon>
        <v-btn outlined rounded color="primary" :to="'/series/'+race.series.id">
            {{race.series.name}}
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: "race-toolbar",
        props: [
            'race',
            'title'
        ]
    }
</script>

<style scoped>

</style>