<template>

    <form  @submit.prevent="addDepartment">
        <h1>CREATE NEW DEPARTMENT</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
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
        }

    }),

    methods: {
        addDepartment () {
            axios.post(baseUrl+'api/departments/create', this.form)
                .then((response) => {
                    this.$router.push('/departments');
                    Swal.fire('SUCCESS', 'Department Added Successfully.', 'success')
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
