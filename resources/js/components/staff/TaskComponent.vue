<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="text-primary font-weight-bold m-0" style="font-size: 20px">Todo List</span>
            <button class="btn btn-primary  border rounded float-right" type="button" @click="modal = true" data-toggle="modal" data-target="#taskModal"><i class="fa fa-plus"></i></button>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item" v-for="task in reverseTasks">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <h5 class="mb-0"><strong>{{ task.name }}</strong></h5>
                        <h6 class="mb-0 text-gray-800">{{ task.description }}</h6>
                        <br>
                        <span class="text-xs text-gray-600">{{ task.created_at}}</span>
                    </div>
                    <div class="col-auto">
                        <div class="custom-control custom-checkbox">
                            <form method="post" @submit.prevent="update">
<!--                                <input class="custom-control-input" type="checkbox" id="formCheck-1" v-model="fields.taskId = task.id"/>-->
<!--                                <label class="custom-control-label" for="formCheck-1"></label>-->
                                <button class="btn btn-primary" id="task" v-model="fields.taskId = task.id" type="submit"><i class="fa fa-trash"></i> </button>
                            </form>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="taskModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Create task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div v-if="success" class="alert alert-success">
                            Task has been created
                        </div>
                        <div v-if="error" class="alert alert-danger">
                            {{ error }}
                        </div>
                        <form method="post" @submit.prevent="submit">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input class="form-control" id="name" type="text" placeholder="Task name" v-model="fields.name">
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" type="text" placeholder="Task description" v-model="fields.description"></textarea>
                            </div>
                            <hr>
                            <div class="row text-center">
                                <div class="col">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
                tasks: []
            }
        },

        created() {
            axios.get('/staff/task/fetch').then(response => {
                this.tasks = response.data;
            });
        },

        computed: {
            reverseTasks() {
                return this.tasks.slice().reverse();
            }
        },

        methods: {
            submit() {
                this.errors = {};
                axios.post('/staff/task', this.fields).then(response => {
                    this.success = true;
                    axios.get('/staff/task/fetch').then(response => {
                        this.tasks = response.data;
                    });
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
            },
            update() {
                this.errors = {};
                axios.post('/staff/task/delete', this.fields).then(response => {
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
