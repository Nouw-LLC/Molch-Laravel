<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Your password has been updated!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <form method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="newPassword">New password:</label>
                <input class="form-control" id="newPassword" type="password" placeholder="Password" v-model="fields.newPassword">
                <div v-if="errors && errors.newPassword" class="text-danger">{{ errors.newPassword[0] }}</div>
            </div>
            <div class="form-group">
                <label for="newPassword">Repeat new password:</label>
                <input class="form-control" id="newPassword2" type="password" placeholder="Password" v-model="fields.newPassword2">
                <div v-if="errors && errors.newPassword" class="text-danger">{{ errors.newPassword2[0] }}</div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input class="form-control" id="password" type="password" placeholder="Password" v-model="fields.password">
                <div v-if="errors && errors.password" class="text-danger">{{ errors.password[0] }}</div>
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
                axios.post('/settings/password', this.fields).then(response => {
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
