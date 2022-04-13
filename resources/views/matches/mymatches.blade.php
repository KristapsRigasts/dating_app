<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Matches') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @foreach($users as $user)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200">
{{--                    <div class="container">--}}
{{--                        <div class="row text-center">--}}
{{--                            <div class=" col-3  mt-3 mb-3 text-center" >--}}
{{--                                <div class="row mt-4">--}}

                    <div style="">
{{--                        @foreach($user->pictures as $picture)--}}

                                <div class="mx-auto d-block" style="width:200px; height: 200px" >
                                    <img src="/storage/{{ $user->pictures[0]->picture }}"  alt="Profile picture">
                                </div>

{{--                        @endforeach--}}



{{--                            <div class="grid grid-rows-2 gap-6">--}}

                    <a href="/userprofile/{{ $user->user_id }}" style="text-decoration: none" >
{{--                                <div class=" col-3  mt-3 mb-3 " >--}}

                                        {{--                                    style="width:600px; height: 400px"--}}
                                        <div class="text-center" >
                                          <b> Name: {{ $user->name }} {{ $user->surname }} </b> <br>
                                           Age: {{ $user->age }} <br>
{{--                                           Information: {{ $user->information }} <br>--}}
{{--                                           Location: {{ $user->location }}--}}
                                        </div>

                                    </a>
{{--                            </div>--}}
{{--                    </div>--}}
{{--                            </div>--}}
{{--                            </div>--}}

                                    {{--                                <div class="text-center">--}}
                                    {{--                                    <form method="get" action="/mypictures/{{ $picture->id }}/delete">--}}
                                    {{--                                        <button class="btn btn-secondary btn-sm" type="submit" onclick="return confirm('Are you sure?');">Delete</button>--}}
                                    {{--                                    </form>--}}
                                    {{--                                </div>--}}

                                </div>
{{--                            --}}
                        </div>


{{--                </div>--}}
            </div>
        </div>
        @endforeach
    </div>



</x-app-layout>
