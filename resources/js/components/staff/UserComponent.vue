<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Action successfully executed!
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <table class="table dataTable my-0" id="dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Avatar</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Warnings</th>
                <th>Banned</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.id }}</td>
                    <td><img class="border rounded-circle img-profile" style="height: 2rem; width: 2rem" :src="'../storage/avatars/' + user.avatar_name"></td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.warning }}</td>
                    <td>{{ user.banned }}</td>
                    <td>
                        <a :href="'../profile/'+ user.id"><button class="btn btn-primary btn-sm" ><i class="fa fa-eye"></i> </button></a>
                        <a :href="'info/'+ user.id"><button class="btn btn-info btn-sm" ><i class="fa fa-info"></i> </button></a>
                        <button class="btn btn-warning btn-sm" @submit="fields.id = user.id" @click="modal = true, fields.id = user.id, action = 2" type="submit" data-toggle="modal" data-target="#aysModal"><i class="fa fa-exclamation-triangle"></i> </button>
                        <button class="btn btn-danger btn-sm" @submit="fields.id = user.id" @click="modal = true, fields.id = user.id, action = 1" type="submit" data-toggle="modal" data-target="#aysModal"><i class="fa fa-hammer"></i> </button>
                        <transition v-if="modal" name="modal">
                            <div class="modal-mask">
                                <div class="modal-wrapper">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Are you sure?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" @click="modal = false">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form v-if="action === 2" @submit.prevent="warn">
                                                    <div class="form-group">
                                                        <label for="reason">Reason:</label>
                                                        <textarea id="reason" class="form-control" v-model="fields.reason"></textarea>
                                                    </div>
                                                    <button class="btn btn-primary" @click="modal = false" type="submit" data-dismiss="modal">Are you sure?</button>
                                                </form>
                                                <form v-if="action === 1" @submit.prevent="ban">
                                                    <div class="form-group">
                                                        <label for="reason">Reason:</label>
                                                        <textarea id="reason" class="form-control" v-model="fields.reason"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="banned">Banned until:</label>
                                                        <v-date-picker id="banned" v-model="fields.date"></v-date-picker>
                                                    </div>
                                                    <hr>
                                                    <button class="btn btn-primary" @click="modal = false" type="submit" data-dismiss="modal">Are you sure?</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                fields: {},
                errors: {},
                success: false,
                error: "",
                users: [],
                action: 0,
                modal: false,
            }
        },

        created() {
            axios.get('/staff/user/fetch').then(response => {
                this.users = response.data;
            });
        },

        methods: {
            warn() {
                this.errors = {};
                console.log(this.fields);
                axios.post('/staff/user/warn', this.fields).then(response => {
                    this.success = true;
                    axios.get('/staff/reports/fetch').then(response => {
                        this.reports = response.data;
                    });
                }).catch(error => {
                    if (error.response.status === 422 || error.response.status === 500) {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        } else {
                            this.error = error.response.data;
                        }

                    }
                });
            },
            ban() {
                this.errors = {};
                console.log(this.fields);
                axios.post('/staff/user/ban', this.fields).then(response => {
                    this.success = true;
                    axios.get('/staff/user/fetch').then(response => {
                        this.reports = response.data;
                    });
                }).catch(error => {
                    if (error.response.status === 422 || error.response.status === 500) {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        } else {
                            this.error = error.response.data;
                        }

                    }
                });
            }
        },
    }
</script>

<style scoped>

</style>

