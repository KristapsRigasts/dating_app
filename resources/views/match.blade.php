<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Match') }}
        </h2>
    </x-slot>


    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class ="grid grid-col-2 gap-6">

                        <div class="grid grid-rows-2 gap-6">
                            <div class="mt-2  text-center">
                                <h1>You got a match!! </h1>

                                <div class="text-center ml-12">
                                    <a href="/storage/{{ $picture->picture }}" target="_blank">
                                        {{--                                    style="width:600px; height: 400px"--}}
                                        <div  class="text-center" style="width:500px; height: 500px" > <img src="/storage/{{ $picture->picture }}"  class="" alt="Profile picture"></div>
                                    </a></div>
                                <div class="mt-2">
                                    <h2>{{$user->name }} {{ $user->surname }} ({{ $user->age }}) </h2>
                                </div>
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
                        <div class="mt-5 text-center">
                            <a href="/findmypartner"> <button class="btn btn-info btn-lg" type="submit" >Find your next match</button></a>
                        </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




</x-app-layout>
