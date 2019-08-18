<style>

</style>

<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in reverseMessages">
            <div class="card">
                <div class="card-body">
                    <!--                    <div class="settings-info">-->
                    <!--                        <img class="settings-upload-avatar" v-bind:src="'storage/avatars/' + message.user.avatar">-->

                    <!--                        <p class="upload-info"> <strong>{{message.user.name}}</strong><br> {{message.message}}<br>-->
                    <!--                            </p>-->

                    <!--                    </div>-->
                    <!--                    <div class="container-fluid">-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-2 col-sm-2 feed-avatar-wrapper">-->
                    <!--                                <img class="feed-avatar" v-bind:src="'storage/avatars/' + message.user.avatar">-->
                    <!--                            </div>-->

                    <!--                            <div class="col col-sm">-->
                    <!--                                <p>{{ message.message}}</p>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <div class="feed-wrapper">
                        <div class="feed-avatar-wrapper">
                            <img class="feed-avatar" v-bind:src="'avatars/' + message.user.avatar">
                        </div>
                        <div class="feed-message">
                            <a class="feed-user" v-bind:href="'user/' + message.user.id"><strong>{{message.user.name}}</strong></a><p> {{message.message}} </p>
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
    <!--                    <div class="chat-body clearfix">-->
    <!--                        <div class="row">-->
    <!--                            <div class="col feed-image">-->
    <!--                                <a class="feed-user" v-bind:href="'user/' + message.user.id"><img class="feed-avatar" alt="profile-image" v-bind:src="'storage/avatars/' + message.user.avatar"></a>-->
    <!--                            </div>-->
    <!--                            <div class="col">-->
    <!--                                <div class="header">-->
    <!--                                    <a class="feed-user" v-bind:href="'user/' + message.user.id">-->
    <!--                                        <strong class="primary-font">-->
    <!--                                            {{ message.user.name }}-->
    <!--                                        </strong>-->
    <!--                                    </a>-->
    <!--                                </div>-->
    <!--                                <p>-->
    <!--                                    {{ message.message }}-->
    <!--                                </p>-->
    <!--                            </div>-->
    <!--                            <div class="feed-date">-->

    <!--                            </div>-->

    <!--                            <div class="col feed-like">-->

    <!--                                <p class="text-right">-->
    <!--                                    <strong>-->
    <!--                                    </strong>-->
    <!--                                </p>-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                    </div>-->

    <!--                </div>-->
    <!--            </div>-->
    <!--        </li>-->
    <!--    </ul>-->

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