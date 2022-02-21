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
<div v-if="isShowRejectRequestForm">
        <v-form class="requestForm" @submit.prevent="rejectRequestApproval">
            <v-spacer></v-spacer>


            <v-textarea
                autocomplete="description"
                v-model="rejectForm.decline_reason"
                label="Decline Reason"
                required
            ></v-textarea>

            <v-btn
                class="mr-4"
                color="primary"
                type="submit"
            >
                REJECT DOCUMENT ACCESS REQUEST
            </v-btn>
        </v-form>
</div>

        <div v-if="isShowApproveRequestForm">
            <v-form class="requestForm" @submit.prevent="approveAccessRequest">
                <v-spacer></v-spacer>

                <v-text-field
                    v-model="approveForm.days"
                    label="Enter Access Days"
                    required
                ></v-text-field>


                <v-select
                    v-model="approveForm.hours"
                    :items="hours"
                    :item-text="'value'"
                    :item-value="'value'"
                    label="Assign Access Hours"
                    required
                ></v-select>

                <v-select
                    v-model="approveForm.minutes"
                    :items="minutes"
                    :item-text="'value'"
                    :item-value="'value'"
                    label="Assign Access Minutes"
                    required
                ></v-select>

                <v-btn
                    class="mr-4"
                    color="primary"
                    type="submit"
                >
                    GRANT DOCUMENT ACCESS
                </v-btn>

            </v-form>
        </div>
        <v-data-table
            :headers="headers"
            :items="accessRequestsDocuments"
            sort-by="name"
            class="elevation-1"
            :search="search"
        >
            <template v-slot:top>
                <v-toolbar
                    flat
                >
                    <v-toolbar-title>DOCUMENT ACCESSS REQUESTS </v-toolbar-title>
                    <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                    <v-spacer></v-spacer>

                    <template>

                        <v-btn  v-if="user.role_id==3"
                            color="primary"
                            dark
                            class="mb-2"
                            @click="newDocumentAccessRequests()"
                        >
                            NEW DOCUMENT ACCESS REQUESTS
                        </v-btn>
                    </template>

                </v-toolbar>
            </template>
<!--            <template v-if="user.id==5" v-slot:item.names="{ item }">-->
<!--                <p>-->
<!--                    {{user.name}}-->
<!--                </p>-->
<!--            </template>-->

            <template v-slot:item.actions="{ item }">

<!--                <v-icon-->
<!--                    large-->
<!--                    @click="downloadDocument(item)"-->
<!--                    class="downloadIcon"-->
<!--                >-->
<!--                    mdi-download-->
<!--                </v-icon>-->

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

                <span v-if="user.role_id !=3 ">
                <v-btn
                    color="green"
                    elevation="2"
                    @click="toggleApproveRequestForm(item)"
                > APPROVE REQUEST</v-btn>


                <v-btn
                    @click="toggleRejectRequestForm(item)"
                    color="red"
                    elevation="2"
                >REJECT APPROVAL</v-btn>
                </span>
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
                value: 'description',
            },

            { text: 'Description', value: 'description' },
            { text: 'status', value: 'status' },
            { text: 'Decline reason', value: 'decline_reason' },
            { text: 'Created_at', value: 'created_at' },
            { text: 'Actions', value: 'actions', sortable: false },
        ],
        accessRequestsDocuments: [],
        search: '',
        isShowRejectRequestForm:false,
        isShowApproveRequestForm:false,
        approveForm:{
            hours:'',
            minutes:'',
            days:0,
            accessRequestId:0,
            userId:0,
        },
        rejectForm:{
            accessRequestId:0,
            userId:0,
            decline_reason:"",
        },
        minutes:[
            {text:1, value:"5"},
            {text:2, value:"10"},
            {text:3, value:"15"},
            {text:4, value:"20"},
            {text:5, value:"30"},
            {text:6, value:"40"},
            {text:7, value:"45"},
            {text:8, value:"50"},
            {text:9, value:"55"},
        ],
        hours:[
            {text:1, value:"1"},
            {text:2, value:"2"},
            {text:3, value:"3"},
            {text:4, value:"4"},
            {text:5, value:"5"},
            {text:6, value:"6"},
            {text:7, value:"7"},
            {text:8, value:"8"},
            {text:9, value:"9"},
            {text:10, value:"10"},
            {text:11, value:"11"},
            {text:12, value:"12"},
            {text:13, value:"13"},
            {text:14, value:"14"},
            {text:15, value:"15"},
            {text:16, value:"16"},
            {text:17, value:"17"},
            {text:18, value:"18"},
            {text:19, value:"19"},
            {text:20, value:"20"},
            {text:21, value:"21"},
            {text:22, value:"22"},
            {text:23, value:"23"},
            {text:24, value:"24"},
        ]
    }),
    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    beforeMount () {
        this.approveForm.userId = this.user.id;
        this.rejectForm.userId = this.user.id;
        this.getDocuments()

    },

    methods: {
        getDocuments () {
            axios.get(baseUrl+'/api/my-access-requests-documents/'+2)
                .then((response) => {
                    this.accessRequestsDocuments = response.data;

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        },
        toggleRejectRequestForm(accessRequest){
            this.rejectForm.accessRequestId=accessRequest.id;
            this.isShowRejectRequestForm= !this.isShowRejectRequestForm;
        },

        toggleApproveRequestForm(accessRequest){
            this.approveForm.accessRequestId=accessRequest.id;
            this.isShowApproveRequestForm= !this.isShowApproveRequestForm;
        },
        approveAccessRequest () {
            axios.post(baseUrl+'api/documents-access-request/approve/', this.approveForm

            )
                .then((response) => {
                    console.log(response.data);
                    this.$router.push('/my-temporary-documents');
                    Swal.fire('SUCCESS', 'Access Granted Successfully.', 'success')
                })
                .catch(function (error) {
                    console.log(error.response.data);

                })
        },

        rejectRequestApproval () {
            axios.post(baseUrl+'api/documents-access-request/reject-approval/', this.rejectForm

            )
                .then((response) => {
                    console.log(response.data);
                    Swal.fire('SUCCESS', 'Access Rejected Successfully.', 'success')
                })
                .catch(function (error) {
                    console.log(error.response.data);

                })
        },



        editDocument(item) {
            this.$router.push('/documents/update/'+item.id);
        },
        newDocumentAccessRequests(){
            this.$router.push('/new-document-access-request');
        },



        addDocument() {

            this.$router.push('/documents/add');
        },

        deleteDocument(accessRequest) {
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
                    axios.delete(baseUrl+'api/access-request-documents/delete/'+accessRequest.id).then((response) => {

                        if (response.status == 200) {
                            console.log(response);
                            this.accessRequestsDocuments = this.accessRequestsDocuments.filter(response => response.id !== accessRequest.id)
                            Swal.fire('Deleted!', 'Access Request has been deleted.', 'success')
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
.requestForm{
    margin-left:50%;
}
</style>




