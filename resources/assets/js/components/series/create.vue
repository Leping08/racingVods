<template>
    <v-container fluid grid-list-md>
        <v-layout row wrap>
            <v-flex lg8 offset-lg2 xs12>
                <v-card>
                    <v-toolbar>
                        <v-toolbar-title>Create Series</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-text-field
                                label="Abbreviation"
                                v-model="name"
                                prepend-icon="mdi-tag-text-outline"
                        ></v-text-field>
                        <v-text-field
                                label="Full Name"
                                v-model="fullName"
                                prepend-icon="mdi-rename-box"
                        ></v-text-field>
                        <!--<v-text-field-->
                                <!--label="Image"-->
                                <!--v-model="image"-->
                                <!--prepend-icon="mdi-image"-->
                                <!--type="number"-->
                        <!--&gt;</v-text-field>-->
                        <v-text-field
                                label="Website"
                                v-model="website"
                                prepend-icon="web"
                        ></v-text-field>
                        <img :src="imageUrl" height="150" class="ml-5" v-if="imageUrl"/>
                        <v-text-field
                                label="Series Image"
                                @click='pickFile'
                                v-model='imageName'
                                prepend-icon='attach_file'
                        ></v-text-field>
                        <input
                                type="file"
                                style="display: none"
                                ref="image"
                                accept="image/*"
                                @change="onFilePicked"
                        >
                        <v-text-field
                                label="Description"
                                v-model="description"
                                prepend-icon="mdi-note-text"
                                multi-line
                        ></v-text-field>
                    </v-card-text>
                    <v-divider></v-divider>
                    <v-card-text>
                        <v-btn
                                outline
                                color="primary"
                                @click="createSeries()"
                        ><v-icon left dark>mdi-library-plus</v-icon>Create</v-btn>
                        <v-btn
                                outline
                                color="info"
                                @click="clear()"
                        ><v-icon left dark>mdi-close-box-outline</v-icon>Clear</v-btn>
                    </v-card-text>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                fullName: null,
                image: null,
                description: null,
                website: null,
                loadingTracks: true,
                loadingSeries: true,
                loadingSeasons: true,
                selectedTrackID: null,
                numberOfCorners: null,
                newSeries: {},
                title: "Image Upload",
                dialog: false,
                imageName: '',
                imageUrl: '',
                imageFile: ''
            }
        },
        methods: {
            createSeries: function () {


                let data = new FormData();
                data.append('name', this.name);
                data.append('fullName', this.fullName);
                data.append('image', this.imageFile);
                data.append('description', this.description);
                data.append('website', this.website);


                this.$api.post('/api/series', data, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then((response) => {
                        this.newSeries = response.data;
                        window.flash(this.newSeries.name + ' added', 'green');
                        this.clear();
                    })
                    .catch((e) => {
                        window.flash('Error', 'red');
                        console.log(e);
                    });
            },
            clear: function () {
                this.name = null;
                this.fullName = null;
                this.image = null;
                this.description = null;
                this.website = null;
            },
            pickFile () {
                this.$refs.image.click ()
            },
            onFilePicked (e) {
                const files = e.target.files;
                if(files[0] !== undefined) {
                    this.imageName = files[0].name;
                    if(this.imageName.lastIndexOf('.') <= 0) {
                        return
                    }
                    const fr = new FileReader ();
                    fr.readAsDataURL(files[0]);
                    fr.addEventListener('load', () => {
                        this.imageUrl = fr.result;
                        this.imageFile = files[0] // this is an image file that can be sent to server...
                    })
                } else {
                    this.imageName = '';
                    this.imageFile = '';
                    this.imageUrl = '';
                }
            }
        }
    }
</script>