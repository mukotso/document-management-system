<template>

    <form  @submit.prevent="addUser">
        <h1>CREATE NEW USER</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.email"
            label="Email Address"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.tel"
            label="Phone Number"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.department"
            label="Department"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.userType"
            label="User Type"
            required
        ></v-text-field>

        <v-btn
            class="mr-4"
            color="primary"
            type="submit"
        >
            SAVE
        </v-btn>

    </form>
</template>

<script>

import baseUrl from "../../baseUrl";
import Swal from "sweetalert2";

export default {

    data: () => ({
        form:{
            name: '',
            email: '',
            department: '',
            tel: '',
            userType:''
        }

    }),

    methods: {
        addUser () {
            axios.post(baseUrl+'api/users/create', this.form)
                .then((response) => {
                    this.$router.push('/users');
                    Swal.fire('SUCCESS', 'User Added Successfully.', 'success')
                })
                .catch(function (error) {
                    console.log(error.response.data);

                })
        },



    },
}
</script>

<style scoped>
form{
    margin-left: 10%;
    margin-right: 10%;
    margin-top: 5%;
}
</style>

