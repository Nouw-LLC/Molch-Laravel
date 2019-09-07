<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Your email has been updated!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <form method="post" @submit.prevent="submit">
            <div class="form-group">
                <label for="oldemail">Old Email:</label>
                <input class="form-control" id="oldemail" type="email" placeholder="New Email" v-model="fields.oldemail">
                <div v-if="errors && errors.oldemail" class="text-danger">{{ errors.oldEmail[0] }}</div>
            </div>
            <div class="form-group">
                <label for="email">New Email:</label>
                <input class="form-control" id="email" type="email" placeholder="New Email" v-model="fields.email">
                <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
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
                axios.post('/settings/email', this.fields).then(response => {
                    this.success = true;
                }).catch(error => {
                    if (error.response.status === 422 || error.response.status === 500) {
                        if (error.response.status === 422) {
                            console.log(error.response.data.errors);
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
