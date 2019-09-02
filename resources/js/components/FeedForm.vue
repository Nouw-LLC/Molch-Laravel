<template>
    <div class="container">
        <p v-if="errors.length">
            <div v-for="error in errors" class="alert alert-danger">
                    {{error}}
            </div>
        <div class="row">
            <div class="col">
                <textarea class="form-control" rows="3" type="text" name="message" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage"/>
            </div>
        </div>
        <hr>
        <div class="row text-center">
            <div class="col">
                <button class="btn btn-primary justify-content-center" type="button" id="btn-chat" data-dismiss="modal" @click="sendMessage">Send Post!</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: '',
                errors: []
            }
        },
        methods: {
            sendMessage(e) {
                this.errors = [];
                if (this.newMessage.length < 10) {
                    this.errors.push('Minimum post length is 10 characters!');
                } else {
                    this.$emit('messagesent', {
                        user: this.user,
                        message: this.newMessage,
                    });

                    this.newMessage = ''
                }

            }
        }
    }
</script>
