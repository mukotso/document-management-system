<template>

    <form  @submit.prevent="addDocument">
        <h1>ADD NEW DOCUMENT</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
            required
        ></v-text-field>




        <v-select
            v-model="form.category_id"
            :items="categories"
            :item-text="'name'"
            :item-value="'id'"
            label="Assign Category"
            required
        ></v-select>

        <v-select
            v-model="form.access_level"
            :items="accessLevels"
            label=" Select Access Level"
            required

        ></v-select>

        <v-file-input
            label="Select Document"
            show-size
            truncate-length="50"
            @change="selectFile"
            required
            accept=".pdf,.docx,.doc"
            prepend-icon="mdi-file-upload"
        ></v-file-input>

        <v-btn
            class="mr-4"
            color="primary"
            type="submit"
        >
            UPLOAD
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
            category_id: '',
            access_level:'',
            document:''
        },
        currentFile: undefined,
        progress: 0,
        accessLevels: [
            'Managers',
            'Analyst',
            'Below Analyst',
            'Cytonn Team',
        ],
        categories:"",


    }),

    mounted () {
        this.getCategories()

    },

    methods: {

        selectFile(file) {
            this.form.document = file;
        },
          addDocument: function () {

                let formData = new FormData();
                formData.append('name', this.form.name);
                formData.append('category_id', this.form.category_id);
                formData.append('access_level', this.form.access_level);
                formData.append('document', this.form.document);
                // console.log(formData)

              axios({
                  method: 'post',
                  url: baseUrl+'api/documents/create',
                  data: formData,
                  headers: {
                      Authorization: 'Bearer ' + window.localStorage.getItem('token')
                  }
              }).then((response) => {
                        console.log(response.data);
                        this.$router.push('/documents');
                        Swal.fire('SUCCESS', 'Document Added Successfully.', 'success');
                    })
                    .catch(function (error) {
                        console.log(error.response.data);

                    })


        },


        // addDocument () {
        //     axios.post(baseUrl+'api/documents/create', this.form,
        //     {
        //         headers: {
        //             'Content-Type': 'multipart/form-data'
        //         }
        //     }
        //     )
        //         .then((response) => {
        //             this.$router.push('/documents');
        //             Swal.fire('SUCCESS', 'Document Added Successfully.', 'success')
        //         })
        //         .catch(function (error) {
        //             console.log(error.response.data);
        //
        //         })
        // },

        getCategories () {
            console.log(window.localStorage.getItem('token'))

            axios({
                method: 'get',
                'Content-Type' : 'application/json',
                'Accept' : 'application/json',
                url:baseUrl+'api/categories',
                headers: {
                    Authorization: 'Bearer' + window.localStorage.getItem('token')
                }
            })
                .then((response) => {
                    console.log(window.localStorage.getItem('token'))
                    console.log(response.data);
                    this.categories = response.data;


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

