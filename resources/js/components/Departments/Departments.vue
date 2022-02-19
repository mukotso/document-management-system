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
        :items="departments"
        sort-by="name"
        class="elevation-1"
        :search="search"
    >
        <template v-slot:top>
            <v-toolbar
                flat
            >
                <v-toolbar-title>DEPARTMENTS</v-toolbar-title>
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
                            @click="addDepartment()"
                        >
                    NEW DEPARTMENT
                        </v-btn>
                    </template>

            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
                medium
                class="mr-2 editIcon"
                @click="editItem(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                medium
                @click="deleteDepartment(item)"
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
            { text: 'Status', value: 'status' },
            { text: 'Created At', value: 'created_at' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        departments: [],
        search: '',
    }),


    beforeMount () {
        this.getDepartments()

    },

    methods: {
        getDepartments () {
                axios.get(baseUrl+'/api/departments')
                    .then((response) => {
                        console.log(response.data);
                        this.departments = response.data;

                    })
                    .catch(function (error) {
                        console.log(error.response.data);

                    })

        },

        editItem (item) {
            this.$router.push('/departments/update/'+item.id);
        },

        deleteDepartment(department) {
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
                    axios.delete(baseUrl+'api/departments/delete/'+department.id).then((response) => {

                        if (response.status == 200) {
                            console.log(response);
                            this.departments = this.departments.filter(response => response.id !== department.id)
                            Swal.fire('Deleted!', 'Department has been deleted.', 'success')
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

        addDepartment () {

            this.$router.push('/departments/add');
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
