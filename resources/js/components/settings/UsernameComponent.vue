<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Your username has been updated!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <form method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="username">New Username:</label>
                <input class="form-control" id="username" type="text" placeholder="New Username" v-model="fields.username">
                <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" id="password" type="password" placeholder="Password" v-model="fields.password">
                <div v-if="errors && errors.message" class="text-danger">{{ errors.message[0] }}</div>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
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
                axios.post('/settings/username', this.fields).then(response => {
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
