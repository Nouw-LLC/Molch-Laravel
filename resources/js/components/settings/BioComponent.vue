<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Your bio has been updated!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <p>Current bio: {{ user.bio }}</p>
        <hr>
        <form method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="bio">New bio:</label>
                <textarea class="form-control" id="bio" placeholder="New bio" v-model="fields.bio" rows="5">
                </textarea>
                <div v-if="errors && errors.bio" class="text-danger">{{ errors.bio[0] }}</div>
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
                axios.post('/settings/bio', this.fields).then(response => {
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

