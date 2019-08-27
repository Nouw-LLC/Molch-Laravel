<style>

</style>

<template>
    <ul class="chat">
        <li class="clearfix" v-for="message in reverseMessages">
            <div class="card">
                <div class="card-body">

                    <div class="feed-wrapper">
                        <div class="feed-avatar-wrapper">
                            <img class="feed-avatar" v-bind:src="'avatars/' + message.user.avatar">
                        </div>
                        <div class="feed-message">
                            <a class="feed-user" v-bind:href="'profile/' + message.user.id"><strong>{{message.user.name}}</strong></a><p> {{message.message}} </p>
                        </div>
                        <div class="feed-buttons">
                            <button class="btn report-button">
                                <i class="far fa-flag"></i>
                            </button>
                            <button class="btn like-button">
                                <i class="far fa-heart"></i> {{message.likes_count}}
                            </button>
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

        computed: {
            reverseMessages() {
                return this.messages.slice().reverse();
            }
        }
    };

</script>
