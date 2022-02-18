<template>

    <form>
        <h1>EDIT USER DETAILS</h1>
        <v-text-field
            v-model="form.name"
            label="Name"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.email"
            label="Email Address"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.tel"
            label="Phone Number"
            required
        ></v-text-field>

        <v-text-field
            v-model="form.department"
            label="Department"
            required
        ></v-text-field>

        <v-btn
            class="mr-4"
            color="primary"
            @click="submit"
        >
            UPDATE DETAILS
        </v-btn>

    </form>
</template>

<script>

export default {

    data: () => ({
        form:{
            name: '',
            email: '',
            department: '',
            tel: '',
        }
    }),

    methods: {
        submit () {
            alert('HEY');
        },
        clear () {
            this.name = ''
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


