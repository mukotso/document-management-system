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


        <v-select
            v-model="form.department_id"
            :items="departments"
            :item-text="'name'"
            :item-value="'id'"
            label="Assign Department"
            required
        ></v-select>

        <v-select
            v-model="form.role_id"
            :items="userTypes"
            :item-text="'value'"
            :item-value="'text'"
            label=" Assign Role"
            required
        ></v-select>

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
            department_id: '',
            tel: '',
            role_id:0
        },
            userTypes: [
        {text:2, value:"Manager"},
        {text:3, value:"Analyst"},
        {text:4, value:"Below Analyst"},
    ],
        departments:"",


    }),

    beforeMount () {
        this.getDepartments()

    },

    methods: {
        addUser () {
            console.log(this.form.role_id);
            axios.post(baseUrl+'api/users/create', this.form)
                .then((response) => {
                    if(response.status==200)
                    this.$router.push('/users');
                    Swal.fire('SUCCESS', 'User Added and Verification Email Sent Successfully.', 'success')
                })
                .catch(function (error) {
                    Swal.fire({
                        title: 'Error!',
                        text: error.response.data.message,
                        icon: 'error',
                        confirmButtonText: 'TRY AGAIN'
                    })

                })
        },

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

