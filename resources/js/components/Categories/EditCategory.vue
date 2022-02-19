<template>

    <form  @submit.prevent="editCategory">
        <h1> EDIT DOCUMENT CATEGORY</h1>
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
            type="submit"
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
            description:''
        }

    }),
    beforeMount() {
        const categoryId = this.$route.params.id;
        axios.get(baseUrl+'api/categories/'+categoryId)
            .then((response) => {
                console.log(response.data);
                this.form = response.data;

            })
            .catch(function (error) {
                console.log(error.response.data);

            })
    },
    methods: {
        editCategory () {
            const categoryId = this.$route.params.id;
            axios.put(baseUrl+'api/categories/update/'+categoryId, this.form)
                .then((response) => {
                    this.$router.push('/categories');
                    Swal.fire('SUCCESS', 'Categories Updated Successfully.', 'success')
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
