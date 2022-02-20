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
                        MY PROFILE
                    </v-toolbar-title>

                </v-app-bar>


                <v-card-text>
                    <div class="font-weight-bold profile">

                        <h1>Name</h1>
                        <h2>{{ userDetails[0].name }}</h2>
                        <h1>Email</h1>
                        <h2>{{ userDetails[0].email }}</h2>
                        <h1>Tel</h1>
                        <h2> {{ userDetails[0].tel }}</h2>

                        <h1>Status</h1>
                        <h2> {{ userDetails[0].status }}</h2>

                        <div v-if="userDetails[0].deparment_id ==1">
                        <h1>Department</h1>
                        <h2>{{ userDetails[0].department.name }}</h2>
                        </div>
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
    data() {
        return {
            userDetails: '',
        }
    },
    computed: {
        ...mapGetters('auth', {
            authState: 'authState',
            user: 'user'
        })
    },

    beforeMount() {
        const userId = this.user.id;
        axios.get(baseUrl + 'api/users/' + userId)
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
h1 {
    color: seagreen;
    margin-bottom: 5px;
    font-size: 18px;
}

h2 {
    color: gray;
    margin-bottom: 5px;
    font-size: 16px;
    font-weight: bold;
}

.profile {
    margin: 2% 5%;

}
</style>
