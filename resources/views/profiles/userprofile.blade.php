<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __( 'User Profile') }}
        </h2>
    </x-slot>


    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class ="grid grid-col-2 gap-6">

                        <div class="grid grid-rows-2 gap-6">

                            <!-- Name -->

                            <div class="mt-5 mb-3 text-center">
                                <h2>{{$user->name }} {{ $user->surname }} </h2>
                            </div>
                            <div>
                                <strong>Age:</strong>  {{ $user->age }}
                            </div>

                        </div>
                        <div class="grid grid-rows-2 gap-6">
                            <div class="mt-3">
                                <strong>Information:</strong>
                                {{ $user->information }}

                            </div>
                            <!-- Location -->
                            <div class="mt-3 mb-4">
                                <strong>Location:</strong>
                                {{ $user->location }}

                            </div>

                        </div>
{{--                        <div class="text-end">--}}
{{--                            <a href="/myprofile"> <button class="btn btn-primary btn-sm" type="submit" >Edit profile</button></a>--}}
{{--                        </div>--}}

{{--                        <div class="grid grid-rows-2 gap-6">--}}

{{--                            --}}{{--                                <div class="mt-3 mb-5">--}}
{{--                            --}}{{--                                <strong>Profile Picture</strong>--}}
{{--                            --}}{{--                                </div>--}}
{{--                            <div class="text-center ml-12">--}}
{{--                                <a href="storage/{{ $picture->picture }}" target="_blank">--}}
{{--                                    --}}{{--                                    style="width:600px; height: 400px"--}}
{{--                                    <div class="" style="width:500px; height: 500px" >--}}
{{--                                        <img src="storage/{{ $picture->picture }}"  alt="Profile picture">--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="mt-3 text-end">--}}
{{--                                <a href="/mypictures"> <button class="btn btn-primary btn-sm" type="submit" >View all pictures</button></a>--}}
{{--                            </div>--}}


{{--                        </div>--}}
                        <div class="container">
                            <div class="row mt-4">
                                @foreach($pictures as $picture)

                                    <div class=" col-3  mt-3 mb-3 text-center" >
                                        <a href="/storage/{{ $picture->picture }}" target="_blank">
                                            {{--                                    style="width:600px; height: 400px"--}}
                                            <div class="" > <img src="/storage/{{ $picture->picture }}"  class="" alt="Profile picture"></div>
                                        </a>
{{--                                        <div class="mt-2 mb-2">--}}
{{--                                            @if($picture->picture != $profilePicture->picture)--}}
{{--                                                <form method="get" action="/mypictures/{{ $picture->id }}/profile">--}}
{{--                                                    <button class="btn btn-secondary btn-sm" type="submit" >Set as profile picture</button>--}}
{{--                                                </form>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}

                                        {{--                                <div class="text-center">--}}
                                        {{--                                    <form method="get" action="/mypictures/{{ $picture->id }}/delete">--}}
                                        {{--                                        <button class="btn btn-secondary btn-sm" type="submit" onclick="return confirm('Are you sure?');">Delete</button>--}}
                                        {{--                                    </form>--}}
                                        {{--                                </div>--}}

                                    </div>
                                @endforeach
                            </div>

                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
