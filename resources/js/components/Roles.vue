<template>
    <v-container>
        <v-row justify="space-around">
            <v-card width="80%">

                <v-app-bar
                    flat
                    height="100px"
                    color="rgba(42, 58, 100, 0.5)"
                >
                    <v-toolbar-title class="text-h6 white--text pl-0">
                        MY ROLES AND PERMISSIONS
                    </v-toolbar-title>

                </v-app-bar>



                <v-card-text>
                    <div class="font-weight-bold profile">
                    <h1 v-if="user.role_id==1">SUPER ADMIN</h1>
                        <h1 v-if="user.role_id==2">MANAGER</h1>
                        <h1 v-if="user.role_id==3">ANALYST</h1>
                        <h1 v-if="user.role_id==4">BELOW ANALYST</h1>
                    <ol v-for="(userPermission ,index) in userDetails">
                        <h2>{{userPermission.permission}}</h2>
                    </ol>
                    </div>

                </v-card-text>
            </v-card>
        </v-row>
    </v-container>
</template>


<script>
import {mapGetters} from "vuex";
import baseUrl from "../baseUrl";

export default {
    data(){
        return{
            userDetails:'',
        }
    },

    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    beforeMount() {
        const roleId = this.user.role_id;
        axios.get(baseUrl+'api/users/roles/'+roleId)
            .then((response) => {
                console.log(response.data);
                this.userDetails = response.data;

            })
            .catch(function (error) {
                console.log(error.response.data);

            })
    },
}
</script>

<style scoped>
h2{
    font-size: 18px;
    line-height:25px;
}
</style>

