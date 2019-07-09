<template>
    <v-toolbar>
        <v-toolbar-title>
            <template v-if="title">{{title}}</template>
            <template v-else="title">{{race.name}}</template>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon
                v-if="race.new"
                color="primary"
        >
            mdi-new-box
        </v-icon>
        <v-btn outline round color="teal" :to="'/series/'+race.series.id">
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