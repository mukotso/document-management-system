<template>
    <div>
        <main class="sm:container sm:mx-auto sm:max-w-lg sm:mt-10">
            <div class="flex">
                <div class="w-full">
                    <section
                        class="flex flex-col break-words bg-white sm:border-1 sm:rounded-md sm:shadow-sm sm:shadow-lg">

                        <header
                            class="font-semibold bg-gray-200 text-gray-700 py-5 px-6 sm:py-6 sm:px-8 sm:rounded-t-md">
                            REGISTRATION FORM
                        </header>

                        <form class="w-full px-6 space-y-6 sm:px-10 sm:space-y-8"
                              @submit.prevent="register" enctype="multipart/form-data">


                            <div class="flex flex-wrap">
                                <label class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Name
                                </label>

                                <input type="text" class="form-input w-full"
                                       name="name" v-model="form.name" required autocomplete="name" autofocus>

                            </div>

                            <div class="flex flex-wrap">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Email Address
                                </label>

                                <input id="email" type="email"
                                       class="form-input w-full" v-model="form.email"
                                       required autocomplete="email">

                            </div>

                            <div class="flex flex-wrap">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Phone Number
                                </label>

                                <input type="number"
                                       class="form-input w-full" name="tel"
                                       required autocomplete="tel" v-model="form.tel">
                            </div>


                            <div class="flex flex-wrap">
                                <label for="email" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Department
                                </label>

                                <select v-model="form.department_id" id="genre"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option  v-for="department in departments"
                                            :key="department.id" :value="department.id">{{ department.name }}
                                    </option>
                                </select>

                            </div>

                            <div class="flex flex-wrap">
                                <label for="password" class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Password
                                </label>

                                <input id="password" type="password"
                                       class="form-input w-full" name="password"
                                       required autocomplete="new-password" v-model="form.password">

                            </div>

                            <div class="flex flex-wrap">
                                <label for="password-confirm"
                                       class="block text-gray-700 text-sm font-bold mb-2 sm:mb-4">
                                    Confirm Password
                                </label>

                                <input id="password-confirm" type="password" class="form-input w-full"
                                       v-model="form.password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="flex flex-wrap">
                                <button type="submit"
                                        class="w-full select-none font-bold whitespace-no-wrap p-3 rounded-lg text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700 sm:py-4">
                                    Register
                                </button>

                                <p class="w-full text-xs text-center text-gray-700 my-6 sm:text-sm sm:my-8">
                                    Already have an account ?
                                    <a class="text-blue-500 hover:text-blue-700 no-underline hover:underline">
                                        Login
                                    </a>
                                </p>
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
    name: "Register",

    data() {
        return {
            departments: null,
            isEdit: false,
            form: {
                name:'',
                email:'',
                department_id:'',
                tel:'',
                password:'',
                password_confirmation:'',
            }
        }

    },

    beforeMount() {
        axios.get('http://document-management-system.appp/api/departments')
            .then((response) => {
                this.departments = response.data;
            })
            .catch(function (error) {
                console.log(error);

            })
    },

    methods: {
        register() {
            axios.post('http://document-management-system.appp/api/register', this.form)
                .then((response) => {
                    // this.$router.push('/login');
                    console.log('logged In');
                })
                .catch(function (error) {
                    // console.log(error.response.data.message);
                    console.log(error.response.data);
                })


        }
    },

}
</script>

<style scoped>

</style>

