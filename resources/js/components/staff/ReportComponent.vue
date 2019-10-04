<!--
  - Copyright (c) 2019.
  -
  - @Author Fabio Dijkshoorn nouw@nouw.xyz
  -->

<template>
    <div class="container">
        <div v-if="success" class="alert alert-success">
            Report has been processed
        </div>
        <div v-if="error" class="alert alert-danger">
            {{ error }}
        </div>
        <table class="table dataTable my-0" id="dataTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Reported</th>
                <th>Reason</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="report in reports">
                <td>{{ report.id }}</td>
                <td>{{ report.user.name }}</td>
                <td>{{ report.reason }}</td>
                <td v-if="report.typeOfReport = 1">Message</td>
                <td>
                    <button class="btn btn-danger btn-sm" @submit="fields.id = report.id" @click="modal = true, fields.id = report.id, action = 1" type="submit" data-toggle="modal" data-target="#aysModal"><i class="fa fa-hammer"></i> </button>
                    <button class="btn btn-warning btn-sm" @submit="fields.id = report.id" @click="modal = true, fields.id = report.id, action = 2" type="submit" data-toggle="modal" data-target="#aysModal"><i class="fa fa-exclamation-triangle"></i> </button>
                    <button class="btn btn-success btn-sm" @submit="fields.id = report.id" @click="modal = true, fields.id = report.id, action = 3" type="submit" data-toggle="modal" data-target="#aysModal"><i class="fa fa-check"></i></button>
                </td>
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
                                        <form v-if="action === 3" @submit.prevent="approve">
                                            <button class="btn btn-primary" @click="modal = false" type="submit" data-dismiss="modal">Are you sure?</button>
                                        </form>
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
                                                <v-date-picker id="banned" v-model="fields.date" :attributes='attrs'></v-date-picker>
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
            </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                fields: {
                    date: new Date()
                },
                errors: {},
                success: false,
                error: "",
                reports: [],
                action: 0,
                modal: false,
                attrs: [
                    {
                        key: 'today',
                        highlight: true,
                        dates: new Date(),
                    },
                ],
            }
        },

        created() {
            axios.get('/staff/reports/fetch').then(response => {
                this.reports = response.data;
            });
        },

        computed: {
            reverseTasks() {
                return this.reports.slice().reverse();
            }
        },

        methods: {
          approve() {
              this.errors = {};
              axios.post('/staff/report/approve', this.fields).then(response => {
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
            warn() {
                this.errors = {};
                console.log(this.fields);
                axios.post('/staff/report/warn', this.fields).then(response => {
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
                axios.post('/staff/report/ban', this.fields).then(response => {
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
            }
        },
    }
</script>

<style scoped>

</style>

