<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Your status has been updated!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <p>Current status: {{ user.status }}</p>
        <hr>
        <form method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="status">New status:</label>
                <input class="form-control" id="status" type="text" placeholder="New status" v-model="fields.status">
                <div v-if="errors && errors.status" class="text-danger">{{ errors.status[0] }}</div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                error: ""
            }
        },
        methods: {
            submit() {
                this.errors = {};
                axios.post('/settings/status', this.fields).then(response => {
                    this.success = true;
                }).catch(error => {
                    if (error.response.status === 422 || error.response.status === 500) {
                        if (error.response.status === 422) {
                            console.log(error.response.data);
                            this.errors = error.response.data.errors || {};
                        } else {
                            this.error = error.response.data;
                        }

                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
