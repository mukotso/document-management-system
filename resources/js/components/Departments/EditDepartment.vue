<template>

    <form>
        <h1>EDIT DEPARTMENT DETAILS</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
            required
        ></v-text-field>

        <v-btn
            class="mr-4"
            color="primary"
            @click="updateDepartment"
        >
            UPDATE DETAILS
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
    beforeMount() {
        const departmentId = this.$route.params.id;
        axios.get(baseUrl+'api/departments/'+departmentId)
            .then((response) => {
                console.log(response.data);
                 this.form.name = response.data.name;

            })
            .catch(function (error) {
                 console.log(error.response.data);

            })
    },

    methods: {
        updateDepartment() {
            const departmentId = this.$route.params.id;
            axios.put(baseUrl+'api/departments/update/'+departmentId ,this.form)
                .then((response) => {
                    console.log(response.data);
                    this.form.name = '';
                    this.$router.push('/departments');
                    Swal.fire('SUCCESS', 'Department  Details Updated Successfully.', 'success')

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })
        }

    },
}
</script>

<style scoped>
form {
    margin-left: 10%;
    margin-right: 10%;
    margin-top: 5%;
}
</style>

