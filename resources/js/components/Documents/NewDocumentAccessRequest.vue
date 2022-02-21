<template>

    <form  @submit.prevent="addDocumentAccessRequest">
        <h1>CREATE NEW DOCUMENT ACCESS REQUEST</h1>
        <v-select
            v-model="form.department_id"
            :items="departments"
            :item-text="'name'"
            :item-value="'id'"
            label="Select Department"
            @change="getDepartmentDocuments"
            required
        ></v-select>


        <v-select
            v-model="form.document_id"
            :items="departmentDocuments"
            :item-text="'name'"
            :item-value="'id'"
            label="Select Document"
            required
        ></v-select>

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
            SEND REQUEST
        </v-btn>

    </form>
</template>

<script>

import baseUrl from "../../baseUrl";
import Swal from "sweetalert2";
import {mapGetters} from "vuex";
export default {

    data: () => ({
        form: {
            name: '',
            department_id: '',
            document_id: '',
            description: '',
            user_id:'',
            username:'',
        },

        departments: "",
        departmentDocuments: "",


    }),

    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    mounted() {
        this.form.user_id = this.user.id;
        this.form.username = this.user.name;
    },


    methods: {
        addDocumentAccessRequest () {
            axios.post(baseUrl+'api/document-access-request/create', this.form)
                .then((response) => {
                    console.log(response.data)
                    this.$router.push('/my-document-access-requests');
                    Swal.fire('SUCCESS', 'Request Added Successfully.', 'success')
                })
                .catch(function (error) {
                    console.log(error.response.data);

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

        getDepartmentDocuments () {

            axios.get(baseUrl+'/api/department-documents/'+this.form.department_id)
                .then((response) => {
                    this.departmentDocuments = response.data[0].documents;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },


     },


    created() {
        this.getDepartments();
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


