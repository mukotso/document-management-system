<template>
    <div>
        <main class=" py-40 sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
            <div class="flex">
                <div class="w-full ">
                    <section class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                        <header class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                            <h1 class="text-green-600 text-bold">CYTONN | DMS <br></h1>

                        </header>

                        <form @submit.prevent="loginUser" class="w-full mt-10 px-6 space-y-6 sm:px-10 sm:space-y-8" method="POST">

                            <div class="flex flex-wrap">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Email Address
                                </label>

                                <input id="email" type="email"
                                       class="form-input w-full"
                                        required autocomplete="email" autofocus placeholder="email address" v-model="form.email">

                            </div>

                            <div class="flex flex-wrap">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4" >
                                    Password
                                </label>

                                <input id="password" type="password"
                                       class="form-input w-full"
                                       required placeholder="Password" v-model="form.password">

                            </div>



                            <div class="flex flex-wrap">
                                <button type="submit"
                                        class="w-full mb-10 select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                    LOGIN
                                </button>

                            </div>
                        </form>

                    </section>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form:{
                email: "",
                password: "",
            },
        };
    },

    methods:{
        loginUser() {
            console.log(this.form);
            axios.post('http://document-management-system.appp/api/login', this.form)
                .then((response) => {
                    this.$store.dispatch('auth/login', response.data);
                        this.$router.push('/dashboard');

                })
                .catch(function (error) {
                    console.log(error.response.data);

                })

        }
    },
};


</script>

<style scoped>
input,
select,
textarea {
//border: none;
    border: 1px solid gray;
    background-color: white;
    border-radius: 0.25rem;
    padding: 10px;
}
</style>
