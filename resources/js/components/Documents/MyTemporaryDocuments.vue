<!--<template>-->
<!--    <v-card class="table">-->
<!--        <v-card-title>-->
<!--            <v-spacer></v-spacer>-->

<!--            <v-text-field-->
<!--                v-model="search"-->
<!--                append-icon="mdi-magnify"-->
<!--                label="Search"-->
<!--                single-line-->
<!--                hide-details-->
<!--            ></v-text-field>-->
<!--        </v-card-title>-->
<!--        <v-data-table-->
<!--            :headers="headers"-->
<!--            :items="documents"-->
<!--            sort-by="name"-->
<!--            class="elevation-1"-->
<!--            :search="search"-->
<!--        >-->
<!--            <template v-slot:top>-->
<!--                <v-toolbar-->
<!--                    flat-->
<!--                >-->
<!--                    <v-toolbar-title>My Temporary Documents</v-toolbar-title>-->
<!--                    <v-divider-->
<!--                        class="mx-4"-->
<!--                        inset-->
<!--                        vertical-->
<!--                    ></v-divider>-->
<!--                    <v-spacer></v-spacer>-->

<!--                    <template>-->

<!--                        <v-btn-->
<!--                            color="primary"-->
<!--                            dark-->
<!--                            class="mb-2"-->
<!--                            @click="viewDocumentAccessRequests()">-->
<!--                            VIEW DOCUMENT ACCESS REQUESTS-->
<!--                        </v-btn>-->
<!--                    </template>-->

<!--                </v-toolbar>-->
<!--            </template>-->
<!--            <template v-slot:item.actions="{ item }">-->

<!--                <v-icon-->
<!--                    medium-->
<!--                    color="green"-->
<!--                    @click="downloadDocument(item)"-->
<!--                    class="downloadIcon"-->
<!--                >-->
<!--                    mdi-eye-->
<!--                </v-icon>-->


<!--            </template>-->

<!--        </v-data-table>-->
<!--    </v-card>-->
<!--</template>-->

<!--<script>-->
<!--import baseUrl from "../../baseUrl";-->
<!--import {mapGetters} from "vuex";-->
<!--const Swal = require('sweetalert2');-->
<!--export default {-->
<!--    data: () => ({-->
<!--        headers: [-->
<!--            {-->
<!--                text: 'Name',-->
<!--                align: 'start',-->
<!--                sortable: false,-->
<!--                value: 'name',-->
<!--            },-->
<!--            {text: 'Category', value: 'category.name'},-->
<!--            {text: 'Access Level', value: 'access_level'},-->
<!--            {text: 'created-at', value: 'created_at'},-->
<!--            {text: 'Actions', value: 'actions', sortable: false},-->
<!--        ],-->
<!--        documents: [],-->
<!--        search: '',-->
<!--    }),-->

<!--    computed: {-->
<!--        ...mapGetters('auth', {-->
<!--            authState: 'authState',-->
<!--            user: 'user'-->
<!--        })-->
<!--    },-->
<!--    beforeMount() {-->
<!--        this.getDocuments();-->

<!--    },-->

<!--    methods: {-->
<!--        getDocuments() {-->
<!--            axios.get(baseUrl+'/api/temporary-documents/'+this.user.id)-->
<!--                           .then((response) => {-->
<!--                               this.documents = response.data;-->

<!--                           })-->
<!--                           .catch(function (error) {-->
<!--                                console.log(error.response.data);-->

<!--                       })-->

<!--        },-->

<!--        editDocument(item) {-->
<!--            this.$router.push('/documents/update/' + item.id);-->
<!--        },-->



<!--        viewDocumentAccessRequests(){-->
<!--                   this.$router.push('/my-document-access-requests');-->
<!--               },-->

<!--        downloadDocument(item) {-->
<!--            axios.get(baseUrl + '/api/documents-download/' + item.id, {responseType: 'arraybuffer'})-->
<!--                .then((response) => {-->
<!--                    // alert('downloaded');-->
<!--                    this.downloadFile(response, 'customFilename')-->
<!--                    console.log(response.data)-->
<!--                    // this.documents = response.data;-->

<!--                })-->
<!--                .catch(function (error) {-->
<!--                    console.log(error.response.data);-->

<!--                })-->

<!--        },-->
<!--        downloadFile(response, filename) {-->
<!--            // It is necessary to create a new blob object with mime-type explicitly set-->
<!--            // otherwise only Chrome works like it should-->
<!--            var newBlob = new Blob([response.body], {type: 'application/pdf'})-->

<!--            // IE doesn't allow using a blob object directly as link href-->
<!--            // instead it is necessary to use msSaveOrOpenBlob-->
<!--            if (window.navigator && window.navigator.msSaveOrOpenBlob) {-->
<!--                window.navigator.msSaveOrOpenBlob(newBlob)-->
<!--                return-->
<!--            }-->

<!--            // For other browsers:-->
<!--            // Create a link pointing to the ObjectURL containing the blob.-->
<!--            const data = window.URL.createObjectURL(newBlob)-->
<!--            var link = document.createElement('a')-->
<!--            link.href = data-->
<!--            link.download = filename + '.pdf'-->
<!--            link.click()-->
<!--            setTimeout(function () {-->
<!--                // For Firefox it is necessary to delay revoking the ObjectURL-->
<!--                window.URL.revokeObjectURL(data)-->
<!--            }, 100)-->
<!--        },-->

<!--    }-->
<!--}-->
<!--</script>-->

<!--<style scoped>-->
<!--.deleteIcon {-->
<!--    color: red;-->
<!--}-->

<!--.editIcon {-->
<!--    color: blue;-->
<!--}-->

<!--.table {-->
<!--    margin: 2% 5%;-->
<!--}-->

<!--.downloadIcon:hover {-->
<!--    color: green;-->
<!--}-->
<!--</style>-->


<template>
    <v-card class="table">

        <v-data-table
            :headers="headers"
            :items="temporaryDocuments"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title> MY TEMPORARY DOCUMENTS</v-toolbar-title>
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
                            @click="viewDocumentAccessRequests()"
                        >
                            VIEW DOCUMENT ACCESS REQUESTS
                        </v-btn>
                    </template>

                </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">

                <v-btn
                    color="primary"
                >
                    VIEW DOCUMENT
                </v-btn>
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
                value: 'document.name',
            },
            { text: 'Access Granted At', value: 'granted_at' },
            { text: 'Access Days', value: 'days' },
            { text: 'Access Hours', value: 'hours' },
            { text: 'Access Minutes', value: 'minutes' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        temporaryDocuments:[],
    }),


    beforeMount () {
        this.getTemporaryDocuments();

    },
    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    methods: {
        getTemporaryDocuments () {
            axios.get(baseUrl+'/api/temporary-documents/'+2)
                .then((response) => {
                    this.temporaryDocuments = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },



        viewDocumentAccessRequests(){
            this.$router.push('/my-document-access-requests');
        },


    },
}
</script>

<style scoped>
.table{
    margin: 2% 5%;
}
</style>
