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
            :items="categories"
            sort-by="name"
            class="elevation-1"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>DOCUMENT CATEGORIES</v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>

                    <template>

                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            @click="addCategory()"
                        >
                            NEW CATEGORY
                        </v-btn>
                    </template>

                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    medium
                    class="mr-2 editIcon"
                    @click="editCategory(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    medium
                    @click="deleteCategory(item)"
                    class="deleteIcon"
                >
                    mdi-delete
                </v-icon>
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
            { text: 'Description', value: 'description' },
            { text: 'Status', value: 'status' },
            { text: 'Created At', value: 'created_at' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        categories: [],
        search: '',
    }),


    beforeMount () {
        this.getCategories()

    },

    methods: {
        getCategories () {
            axios.get(baseUrl+'/api/categories')
                .then((response) => {
                    this.categories = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },

        editCategory (item) {
            this.$router.push('/categories/update/'+item.id);
        },

        deleteCategory(category) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(baseUrl+'api/categories/delete/'+category.id).then((response) => {

                        if (response.status == 200) {
                            console.log(response);
                            this.categories = this.categories.filter(response => response.id !== category.id)
                            Swal.fire('Deleted!', 'Category has been deleted.', 'success')
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }

                    }).catch((error) => {
                        console.log(error.response.data);
                    })
                }
            })

        },

        addCategory () {

            this.$router.push('/categories/add');
        },

    },
}
</script>

<style scoped>
.deleteIcon{
    color:red;
}
.editIcon{
    color:blue;
}
.table{
    margin: 2% 5%;
}
</style>

