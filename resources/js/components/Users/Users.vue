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
            :items="users"
            sort-by="name"
            class="elevation-1"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>USERS</v-toolbar-title>
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
                            @click="addUser()"
                        >
                            NEW USER
                        </v-btn>
                    </template>

                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon
                    medium
                    class="mr-2 editIcon"
                    @click="editUser(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    medium
                    @click="deleteUser(item)"
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
            { text: 'Email', value: 'email' },
            { text: 'Phone Number', value: 'tel' },
            { text: 'User Type', value: 'type' },
            { text: 'Status', value: 'status' },
            { text: 'created-at', value: 'created_at' },
            { text: 'Department', value: 'department.name' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        users: [],
        search: '',
    }),


    beforeMount () {
        this.getUsers()

    },

    methods: {
        getUsers () {
            axios.get(baseUrl+'/api/users')
                .then((response) => {
                    this.users = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },

        editUser (item) {
            this.$router.push('/users/update/'+item.id);
        },

        deleteUser(user) {
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
                    axios.delete(baseUrl+'api/users/delete/'+user.id).then((response) => {

                        if (response.status == 200) {
                            console.log(response);
                             this.users = this.users.filter(response => response.id !== user.id)
                            Swal.fire('Deleted!', 'User has been deleted.', 'success')
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

        addUser() {

            this.$router.push('/users/add');
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

