<template>

    <div class="input-group">
        <div class="input-group-prepend"></div><input class="form-control" type="text" name="message" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage" />
        <div class="input-group-append"><button class="btn btn-primary" type="button" id="btn-chat" data-dismiss="modal" @click="sendMessage">Go!</button></div>
    </div>

</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    message: this.newMessage,
                });

                this.newMessage = ''
            }
        }
    }
</script>