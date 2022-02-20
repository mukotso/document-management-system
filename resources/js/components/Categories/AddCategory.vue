<template>

    <form  @submit.prevent="addCategory">
        <h1>CREATE NEW DOCUMENT CATEGORY</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
            required
        ></v-text-field>

        <v-textarea
            autocomplete="description"
            label="description"
            required
            v-model="form.description"
        ></v-textarea>

        <v-btn
            class="mr-4"
            color="primary"
            type="addCategory"
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
            description:'',
        }

    }),

    methods: {
        addCategory () {
            axios.post(baseUrl+'api/categories/create', this.form)
                .then((response) => {
                    this.$router.push('/categories');
                    Swal.fire('SUCCESS', 'Category Added Successfully.', 'success')
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
