


<template>
    <div v-if="authState.loggedIn">
    <v-app id="inspire">


            <v-navigation-drawer
                v-model="drawer"
                app>

                <v-list>
                    <v-list-item >
                        <v-icon class="profile"> mdi-account-circle</v-icon>
                    </v-list-item>

                    <v-list-item link>
                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                               {{user.name}}
                            </v-list-item-title>
                            <v-list-item-subtitle>{{user.email}}</v-list-item-subtitle>
                        </v-list-item-content>

                    </v-list-item>
                </v-list>
                <v-divider></v-divider>

                                <v-list
                                    dense
                                    nav
                                >
                                    <v-list-item
                                        v-for="item in items"
                                        :key="item.title"
                                        :to="item.to"
                                        link
                                    >
                                        <v-list-item-icon>
                                            <v-icon>{{ item.icon }}</v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-content>
                                            <v-list-item-title>{{ item.title }}</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>

                                    <v-list-item
                                    >
                                        <v-list-item-icon>
                                            <v-icon>mdi-logout</v-icon>
                                        </v-list-item-icon>

                                        <v-list-item-content>
                                            <v-list-item-title @click="logOutUser()">Logout</v-list-item-title>
                                        </v-list-item-content>
                                    </v-list-item>
                                </v-list>
                            </v-navigation-drawer>



                        <v-app-bar app>
                            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

                            <v-toolbar-title>CYTONN  DMS</v-toolbar-title>

                        </v-app-bar>

                        <v-main>
                            <router-view></router-view>
                        </v-main>
                    </v-app>
    </div>
    <div v-else>
        <router-view></router-view>
    </div>

                </template>

                <script>
                import {mapGetters} from "vuex";
                import baseUrl from "../baseUrl";
                export default {
                    data: () => ({
                        drawer: null
                    ,
                        items: [
                            { title: 'Dashboard', icon: 'mdi-home',to:"/dashboard" },
                            { title: 'Users', icon: 'mdi-account-group',to:"/users" },
                            { title: 'Departments', icon: 'mdi-home-account', to:"/departments"},
                            { title: 'Documents', icon: 'mdi-file-document-multiple', to:"/register"},
                            { title: 'Categories', icon: 'mdi-shape', to:"/categories"},
                            { title: 'Roles and Permissions', icon: 'mdi-account-wrench', to:"/my-roles-and-permissions"},
                            { title: 'Profile', icon: 'mdi-account', to:"/profile"},
                            ],
                    }),
                    computed: {
                        ...mapGetters('auth', {
                            authState: 'authState',
                            user: 'user'
                        })
                    },

                    methods:{
                        logOutUser(){
                            // axios.post(baseUrl+'api/logout')
                            //     .then((response) => {
                                    // console.log(response.data)
                                    // return
                                    this.$store.dispatch('auth/logout');
                                    this.$router.push('/');
                                // })
                                // .catch(function (error) {
                                //     console.log(error.response.data);
                                // })

                        }
                     },
                }
                </script>
<style scoped>
.profile{
    font-size: 500%;
}

</style>
