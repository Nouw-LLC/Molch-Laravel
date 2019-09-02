@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card" style="height: 75vh">
            <div v-if="showModal">
                <transition name="modal">
                    <div class="modal-mask">
                        <div class="modal-wrapper">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Post</h4>
                                        <button type="button" class="close" @click="showModal=false">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <feed-form
                                                v-on:messagesent="addMessage"
                                                :user="{{ Auth::user() }}"
                                        ></feed-form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </transition>
            </div>
            <div class="card-header"><span style="font-size: 20px;">The Feed</span><button class="btn btn-primary  border rounded float-right" id="show-modal" type="button" @click="showModal = true"><i class="fa fa-plus"></i></button></div>
            <div class="card-body card-body-overflow">
                <feed-messages :messages="messages"></feed-messages>
            </div>
        </div>
    </div>
@endsection
