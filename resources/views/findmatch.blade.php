<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Find Your Match') }}
        </h2>
    </x-slot>


    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class ="grid grid-col-2 gap-6" >

                        <div class="grid grid-rows-2 gap-6">

                            <!-- Name -->

                            <div class="mt-2 text-center">

                                <div class="ml-12">
{{--                                    <a href="/storage/{{ $picture->picture }}" target="_blank">--}}
                                        {{--                                    style="width:600px; height: 400px"--}}
                                        <div class="" style="width:500px; height: 500px" > <img src="/storage/{{ $picture->picture }}"  alt="Profile picture"></div>
{{--                                    </a>--}}
                                </div>
                                <a href="/userprofile/{{ $user->user_id }}" target="_blank">
                                <div class="mt-2">
                                <h2>{{$user->name }} {{ $user->surname }} ({{ $user->age }}) </h2>
                                </div>
                                </a>
                                <div class="mt-1 ">
                                    ({{ $user->gender }})
                                </div>
                            </div>


                        </div>
                        <div class="grid grid-rows-2 gap-6">
                            <div class="mt-2 text-center">
                                <strong>Information:</strong>
                                {{ $user->information }}

                            </div>


                        </div>
                        <div class="mt-2 text-center">
                            <strong>Location:</strong>
                            {{ $user->location }}

                        </div>
{{--                        <div class="text-end">--}}
{{--                            <a href="/myprofile"> <button class="btn btn-primary btn-sm" type="submit" >Edit profile</button></a>--}}
{{--                        </div>--}}

                        <div class="grid grid-rows-2 gap-6">

                            <div class="mt-3 mb-5">
                                {{--                                <strong>Profile Picture</strong>--}}
                            </div>

                            <div class="mt-3 text-center">
                                <a href="/findmypartner/{{ $user->user_id }}/no"> <button class="btn btn-danger btn-lg" type="submit" >No</button></a>
                                <a href="/findmypartner/{{ $user->user_id }}/yes"> <button class="btn btn-success btn-lg" type="submit" >Yes </button></a>
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
