@extends('layouts.app')

@section('content')
    <div class="row w-100 h-100 m-0">
        <div class="col-3 m-0 p-0">
            <div class="content-box">
                <div class="content-box-header">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#friendlist" aria-controls="1" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/people.svg') }}"/></a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link" href="#add" aria-controls="2" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/person-plus.svg') }}"/></a></li>
                        <li role="presentation" class="nav-item"><a class="nav-link requests-tab" href="#requests" aria-controls="3" role="tab" data-toggle="tab"><img class="tab-img" src="{{ asset('assets/img/person.svg')}}"/> <h6 class="requests">0</h6></a></li>
                    </ul>
                </div>
                <div class="content-box-body p-2">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="friendlist" aria-labelledby="friendlist">
                            <input type="text" class="form-control font-18px" placeholder="Search in your contactlist...">
                            <ul id="app">
                                <li v-for="contact in contacts" :key="contact.id">
                                    @{{ contact.id }}
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="add" aria-labelledby="add">
                            <input type="text" class="form-control font-18px" placeholder="Search for new contacts...">
                        </div>
                        <div role="tabpanel" class="tab-pane" id="requests" aria-labelledby="requests">
                            <h2 class="text-center">No new contact requests</h2>
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
                    <h3 class="m-0">User_Name_Here</h3>
                </div>
                <div class="content-box-body"></div>
                <div class="content-box-footer align-bottom border-top">
                    <form class="row p-2">
                        <div class="col-10">
                            <input type="text" class="form-control font-18px" placeholder="Type message...">
                        </div>
                        <div class="col-2 pl-0">
                            <input type="button" class="btn btn-danger font-18px w-100" value="Send">
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
                contacts: {"id":1,"user_a":1,"user_b":2,"created_at":null,"updated_at":null},
                user: {!! Auth::check() ? Auth::user()->toJson() : 'null' !!},
            },
        })
    </script>

@endsection
