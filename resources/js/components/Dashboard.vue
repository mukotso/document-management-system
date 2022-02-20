<template>
    <div>
        <div class="mx-auto container py-20 ">
            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">

                <div class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">TOTAL USERS</h1>
                        <div class="analytics">
                            <v-icon class="icon">mdi-account-group</v-icon>
                            <h1>14</h1>
                        </div>

                    </div>
                    <div>
                    </div>
                </div>
                <div class="w-full h-64 flex flex-col justify-between bg-pink-300 rounded-lg border border-pink-300 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">TOTAL CATEGORIES</h1>
                        <div class="analytics">
                            <v-icon class="icon">mdi-shape</v-icon>
                            <h1>14</h1>
                        </div>
                    </div>
                    <div>

                    </div>
                </div>
                <div class="w-full h-64 flex flex-col justify-between items-start bg-blue-300 rounded-lg border border-blue-300 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">TOTAL DEPARTMENTS</h1>
                        <div class="analytics">
                            <v-icon class="icon"> mdi-home-account</v-icon>
                            <h1>14</h1>
                        </div>
                    </div>

                </div>

                <div class="w-full h-64 flex flex-col justify-between items-start bg-green-300 rounded-lg border border-blue-300 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">MANAGERS</h1>
                        <div class="analytics">
                            <v-icon class="icon">mdi-account-group</v-icon>
                            <h1>14</h1>
                        </div>
                    </div>

                </div>

                <div class="w-full h-64 flex flex-col justify-between items-start bg-yellow-300 rounded-lg border border-blue-300 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">ANALYSTS</h1>
                        <div class="analytics">
                            <v-icon class="icon">mdi-account-group</v-icon>
                            <h1>14</h1>
                        </div>
                    </div>

                </div>


                <div class="w-full h-64 flex flex-col justify-between items-start bg-red-300 rounded-lg border border-blue-300 mb-6 py-5 px-4">
                    <div>
                        <h1 class="text-gray-800 dark:text-gray-100 font-bold mb-3">BELOW ANALYSTS</h1>
                        <div class="analytics">
                            <v-icon class="icon">mdi-account-group</v-icon>
                            <h1>14</h1>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Analytics",

    data() {
        return {
            departments: null,
        }
    },
    beforeMount() {
        axios.get('http://document-management-system.appp/api/documents')
            .then((response) => {
                console.log(response.data);
                this.departments = response.data;
            })
            .catch(function (error) {
                console.log(error);

            })
    },
}
</script>

<style scoped>
.analytics{
    font-size:40px;
    padding-left:40%;
}
.icon{
    font-size:200%;
}
</style>

