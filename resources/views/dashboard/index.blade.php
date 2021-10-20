@extends('layouts.app')

@section('content')
    <div class="row w-100 h-100 m-0" id="app">
        <div class="col-3 m-0 p-0">
            <div class="content-box">
                <div class="content-box-header">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#friendlist" aria-controls="1" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/people.svg') }}"/></a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="#add" aria-controls="2" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/person-plus.svg') }}"/></a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link requests-tab" href="#requests" aria-controls="3" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/person.svg')}}"/> <h6 class="requests">@{{ requests.length }}</h6></a></li>
                    </ul>
                </div>
                <div class="content-box-body p-2">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="friendlist" aria-labelledby="friendlist">
                            <h2 v-if="contacts.length == 0" class="text-center">No contacts</h2>

                            <table v-if="contacts.length > 0" id="contactsList" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(contact, index) in contacts">
                                    <td>
                                        <div class="font-18px contact-box">
                                            <div class="w-100 pe-auto" @click="loadChat(contact)">
                                                <h4 class="contact-box-title">@{{ contact.user[0].name }}</h4>
                                                <div class="form-text">@{{ contact.user[0].status_message }}</div>
                                            </div>
                                            <div class="contact-box-misc dropstart">
                                                <img class="tab-img" src="{{ asset('assets/img/three-dots-vertical.svg')}}" data-bs-toggle="dropdown" aria-expanded="false">
                                                <ul class="dropdown-menu" style="width: 50%;">
                                                    <li><a class="dropdown-item" @click="removeContact(index, contact.user[0].id)">Remove contact</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="add" aria-labelledby="add">
                            <input id="search" type="search" autocomplete="new-password" class="form-control font-18px" placeholder="Search for new contacts...">

                            <h2 v-if="searchResults.length == 0" class="text-center mt-2">No results</h2>

                            <table v-if="searchResults.length > 0" id="contactsList" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(searchResult, index) in searchResults">
                                    <td>
                                        <div class="font-18px contact-box">
                                            <div class="w-100">
                                                <h4 class="contact-box-title">@{{ searchResult.name }}</h4>
                                            </div>
                                                <div class="contact-box-misc">
                                                    <img @click="sendRequest(index, searchResult.id)" class="tab-img" src="{{ asset('assets/img/person-plus.svg') }}"/>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="requests" aria-labelledby="requests">
                            <h2 v-if="requests.length == 0" class="text-center">No new contact requests</h2>

                            <table v-if="requests.length > 0" id="requestList" class="display" style="width:100%">
                                <thead>
                                <tr>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(request, index) in requests">
                                    <td>
                                        <div class="font-18px contact-box">
                                            <div class="w-100 align-items-center d-flex">
                                                <h4 class="contact-box-title">@{{ request.user[0].name }}</h4>
                                            </div>
                                            <div class="contact-box-misc-request">
                                                <img @click="acceptRequest(index, request.sender)" class="tab-img p-1 mr-2 request-response" src="{{ asset('assets/img/check-circle.svg')}}">
                                                <img @click="denyRequest(index, request.id)" class="tab-img p-1 request-response" src="{{ asset('assets/img/x-circle.svg')}}">

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                </div>
                </div>
                <div class="content-box-footer align-bottom border-top">
                </div>
            </div>
        </div>

        <div class="col-9 m-0 p-0">
            <div class="content-box w-97">
                <div class="content-box-header p-2 border-bottom">
                    <h3 class="m-0">@{{ chat.user.user[0].name }}</h3>
                </div>
                <div class="content-box-body">
                    <div class="content-box-body-messages">
                        <p class="content-box-body-message" v-bind:class="messagePlacement(message.sender)" v-for="message in chat.messages">
                            @{{ message.message }}
                        </p>
                    </div>
                </div>
                <div class="content-box-footer align-bottom border-top">
                    <form class="row p-2">
                        <div class="col-10">
                            <input type="text" class="form-control font-18px" v-model="chat.message" placeholder="Type message...">
                        </div>
                        <div class="col-2 pl-0">
                            <input type="button" @click="sendMessage()" class="btn btn-danger font-18px w-100" value="Send">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{{--        <script src="{{ asset('js/app.js') }}"></script>--}}
{{--        <script>--}}
{{--            Echo.channel('home')--}}
{{--                .listen('NewMessage', (e) => {--}}
{{--                    console.log(e.message);--}}
{{--                })--}}
{{--        </script>--}}

@endsection

@section('scripts')
    <script>

        const app = new Vue({
                el: '#app',
            data: {
                chat: {
                    user: {
                        user: [{ name: 'No user selected', id: 0 }],
                    },
                    messages: {},
                    message: "",
                },

                contacts: {!! $request['contacts']->toJson() !!},
                requests: {!! $request['requests']->toJson() !!},
                searchResults: {},
                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
            },
            mounted() {
                this.listen();
            },
            methods: {
                sendRequest: function (index, id) {
                    $.ajax({
                        url: '/requests',
                        type: 'post',
                        data: {"id": id},
                        success: function(response) {
                            console.log(response);
                            app.searchResults.splice(index, 1);
                        }
                    });
                },
                denyRequest: function (index, request_id) {
                    this.requests.splice(index, 1);
                    $.ajax({
                        url: '/requests/'+request_id,
                        type: 'DELETE',
                        success: function(response) {
                            console.log(response);
                        }
                    });
                },
                acceptRequest: function (index, sender_id) {
                    this.requests.splice(index, 1);
                    $.ajax({
                        url: '/contacts',
                        type: 'POST',
                        data: { 'id': sender_id },
                        success: function(response) {
                            app.contacts.unshift(response[0]);
                            // console.log(response[0]);
                        }
                    });
                },
                removeContact(index, id){
                    $.ajax({
                        url: '/contacts/'+id,
                        type: 'DELETE',
                        success: function(response) {
                            app.contacts.splice(index, 1);
                            console.log(response);

                            if (id == app.chat.user.user[0].id){
                                app.chat.messages = {};
                                app.chat.user.user[0].name = 'No user selected';
                            }
                        }
                    });
                },
                loadChat: function (contact){
                    app.chat.user = contact;
                    console.log(contact);
                    $.ajax({
                        url: '/messages/' + contact.user[0].id,
                        type: 'GET',
                        success: function(response) {
                            app.chat.messages = response;
                        }
                    });
                },
                messagePlacement(sender){
                    if (sender == app.user.id){
                        return 'ml-a';
                    }
                },
                sendMessage(){
                    $.ajax({
                        url: '/messages',
                        type: 'post',
                        data: {text: app.chat.message,
                               receiver: app.chat.user.user[0].id,
                        },
                        success: function(response) {
                            app.chat.message = "";
                            app.chat.messages.unshift(response);
                        },
                    });
                },
                listen(){
                    Echo.channel('user.' + this.user.id)
                        .listen('NewMessage', (e) => {
                            app.chat.messages.push(e);
                        });
                    console.log("listening on " + 'user.' + this.user.id);
                }
            },
        });

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contactsList').DataTable({
                scrollY: '60vh',
                "scrollCollapse": true,
                "ordering": false,
                "paging": false,
                "info": false,
                "oLanguage": {
                    "sSearch": "",
                    "zeroRecords": " ",
                    "sSearchPlaceholder": "Search in your contactlist...",
                }
            });

            $('#requestList').DataTable({
                scrollY: '60vh',
                "scrollCollapse": true,
                "ordering": false,
                "paging": false,
                "info": false,
                "searching": false,
                "oLanguage": {
                    "zeroRecords": " ",
                }
            });

            $('#search').on('keyup', function () {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '/contacts/' + $value,
                    success: function (data) {
                        console.log(data);
                        app.searchResults = data;
                    }
                });

                $('div.dataTables_filter input').addClass('form-control font-18px');
            });

        });

    </script>
@endsection
