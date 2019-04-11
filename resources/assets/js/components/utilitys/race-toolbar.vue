<template>
    <v-toolbar>
        <v-toolbar-title>{{race.name}}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-icon
                v-if="race.new"
                color="primary"
        >
            mdi-new-box
        </v-icon>
        <v-btn outline round color="teal" :href="'/series/'+race.series.id">
            {{race.series.name}}
        </v-btn>
    </v-toolbar>
</template>

<script>
    export default {
        name: "race-toolbar",
        props: [
            'race'
        ]
    }
</script>

<style scoped>

</style>