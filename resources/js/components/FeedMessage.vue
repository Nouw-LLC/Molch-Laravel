<template>
    <ul class="chat">
        <li class="clearfix" v-for="message in reverseMessages">
            <div class="card">
                <div class="card-body">
                    <div class="feed-wrapper">
                        <a v-bind:href="'profile/' + message.user.id">
                            <div class="feed-avatar-wrapper">
                                <img class="feed-avatar" v-bind:src="'storage/avatars/' + message.user.avatar_name">
                            </div>
                        </a>
                        <div class="feed-message">
                            <a class="feed-user" v-bind:href="'profile/' + message.user.id"><strong>{{message.user.name}}</strong></a><p> {{message.message}} </p>
                        </div>
                        <div class="feed-buttons">
                            <button class="btn report-button" :id="message.user.id" @click="modal = true, id = message.user.id, fields.message = message.message, fields.user = message.user_id" data-toggle="modal" data-target="#reportModal">
                                <i class="far fa-flag"></i>
                            </button>
                            <button class="btn like-button">
                                <i class="far fa-heart"></i> {{message.likes_count}}
                            </button>
                        </div>
                        <div class="modal fade" id="reportModal" tabindex="-1" role="dialog" aria-labelledby="reportModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Report post</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div v-if="success" class="alert alert-success">
                                            Your report has been send to the staff team!
                                        </div>
                                        <div v-if="error" class="alert alert-danger">
                                            {{ error }}
                                        </div>
                                        <form method="post" @submit.prevent="submit">
                                            <div class="form-group">
                                                <label for="reason">Reason:</label>
                                                <textarea class="form-control" id="reason" type="text" placeholder="Reason for reporting" v-model="fields.reason" minlength="20"></textarea>
                                            </div>
                                            <hr>
                                            <div class="row text-center">
                                                <div class="col">
                                                    <button class="btn btn-primary" @click="modal = false" type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>

</template>

<script>
    export default {
        props: ['messages'],
        data() {
            return {
                fields: {},
                modal: false,
                id: 0,
                errors: {},
                success: false,
                error: ""
            }
        },
        computed: {
            reverseMessages() {
                return this.messages.slice().reverse();
            }
        },
        methods: {
            submit() {
                this.errors = {};
                console.log(this.fields);
                axios.post('/post/report', this.fields).then(response => {
                    this.success = true
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
    };

</script>
