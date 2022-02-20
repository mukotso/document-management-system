<template>
    <v-card class="table">
        <v-card-title >
            <v-spacer></v-spacer>

            <v-text-field
                v-model="search"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                hide-details
            ></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="documents"
            sort-by="name"
            class="elevation-1"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>DOCUMENTS HISTORY</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>

                    <template>


                    </template>

                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">


            </template>

        </v-data-table>
    </v-card>
</template>

<script>
import baseUrl from "../../baseUrl";
const Swal = require('sweetalert2');
export default {
    data: () => ({
        headers: [
            {
                text: 'Name',
                align: 'start',
                sortable: false,
                value: 'name',
            },
            { text: 'Category', value: 'category.name' },
            { text: 'User', value: 'user.name' },
            { text: 'Deleted-at', value: 'deleted_at' },
        ],
        documents: [],
        search: '',
    }),


    beforeMount () {
        this.getDocumentsHistory()

    },

    methods: {
        getDocumentsHistory () {
            axios.get(baseUrl+'/api/documents-history')
                .then((response) => {
                    console.log(response.data);
                    this.documents = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },







    },
}
</script>

<style scoped>

</style>



