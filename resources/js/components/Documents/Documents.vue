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
            :items="documents"
            sort-by="name"
            class="elevation-1"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>DOCUMENTS</v-toolbar-title>
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
                            @click="addDocument()"
                        >
                            NEW DOCUMENT
                        </v-btn>
                    </template>

                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">

                <v-icon
                    large
                    @click="downloadDocument(item)"
                    class="downloadIcon"
                >
                    mdi-download
                </v-icon>

<!--                <v-icon-->
<!--                    medium-->
<!--                    class="mr-2 editIcon"-->
<!--                    @click="editDocument(item)"-->
<!--                >-->
<!--                    mdi-pencil-->
<!--                </v-icon>-->
                <v-icon
                    medium
                    @click="deleteDocument(item)"
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
import {mapGetters} from "vuex";
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
            { text: 'Category', value: 'category.name' },
            // { text: 'Access Level', value: 'access_level' },
            { text: 'created-at', value: 'created_at' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        documents: [],
        userId:0,
        search: '',
    }),

    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    beforeMount() {
        this.userId=this.user.id;
        this.getDocuments ();
    },



    methods: {
        getDocuments () {
            axios.get(baseUrl+'api/documents')
                .then((response) => {
                    this.documents = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },

        editDocument(item) {
            this.$router.push('/documents/update/'+item.id);
        },

        deleteDocument(document) {
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
                    axios.delete(baseUrl+'api/documents/delete/'+document.id).then((response) => {

                        if (response.status == 200) {
                            console.log(response);
                            this.documents = this.documents.filter(response => response.id !== document.id)
                            Swal.fire('Deleted!', 'Document has been deleted.', 'success')
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

        addDocument() {

            this.$router.push('/documents/add');
        },

        downloadDocument (item) {
            axios.get(baseUrl+'/api/documents-download/'+item.id ,{responseType: 'arraybuffer'})
                .then((response) => {
                    // alert('downloaded');
                    this.downloadFile(response, 'customFilename')
                    console.log(response.data)
                    // this.documents = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },
        downloadFile(response, filename) {
            // It is necessary to create a new blob object with mime-type explicitly set
            // otherwise only Chrome works like it should
            var newBlob = new Blob([response.body], {type: 'application/pdf'})

            // IE doesn't allow using a blob object directly as link href
            // instead it is necessary to use msSaveOrOpenBlob
            if (window.navigator && window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveOrOpenBlob(newBlob)
                return
            }

            // For other browsers:
            // Create a link pointing to the ObjectURL containing the blob.
            const data = window.URL.createObjectURL(newBlob)
            var link = document.createElement('a')
            link.href = data
            link.download = filename + '.pdf'
            link.click()
            setTimeout(function () {
                // For Firefox it is necessary to delay revoking the ObjectURL
                window.URL.revokeObjectURL(data)
            }, 100)
        },

    }
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
.downloadIcon:hover{
    color:green;
}
</style>


