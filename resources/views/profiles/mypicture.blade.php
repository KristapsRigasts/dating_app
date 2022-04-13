<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Pictures') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row mt-4">
                            @foreach($pictures as $picture)

                            <div class=" col-3  mt-3 mb-3 text-center" >
                                <a href="storage/{{ $picture->picture }}" target="_blank">
{{--                                    style="width:600px; height: 400px"--}}
                                    <div class="" > <img src="storage/{{ $picture->picture }}"  class="" alt="Profile picture"></div>
                                </a>
                                <div class="mt-2 mb-2">
                                    @if($picture->picture != $profilePicture->picture)
                                    <form method="get" action="/mypictures/{{ $picture->id }}/profile">
                                            <button class="btn btn-secondary btn-sm" type="submit" >Set as profile picture</button>
                                    </form>
                                    @endif
                                </div>

{{--                                <div class="text-center">--}}
{{--                                    <form method="get" action="/mypictures/{{ $picture->id }}/delete">--}}
{{--                                        <button class="btn btn-secondary btn-sm" type="submit" onclick="return confirm('Are you sure?');">Delete</button>--}}
{{--                                    </form>--}}
{{--                                </div>--}}

                            </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="container">
                        <div class="row mt-4">
                            <!-- Validation Errors -->
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                            <form method="POST" action="{{ route('uploadPicture') }}" enctype="multipart/form-data">
                            @csrf

                            <!-- image -->
                                <div>
                                    <x-label for="image" :value="__('Add picture')" />

                                    <x-input id="image" class="block mt-1 w-full" type="file" name="image[]" :value="old('image')" required autofocus multiple/>
                                </div>

                                <x-button class="mt-2 ">
                                    {{ __('Upload') }}
                                </x-button>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
