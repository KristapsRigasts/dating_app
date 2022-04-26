<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Profile') }}
        </h2>
    </x-slot>

    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors"/>

                    <form method="POST" action="{{ route('profileUpdate') }}">
                        @csrf
                        <div class="grid grid-col-2 gap-6">
                            <div class="grid grid-rows-2 gap-6">
                                <!-- Name -->
                                <div>
                                    <x-label for="name" :value="__('Name')"/>

                                    <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                                             value="{{ $user->name }}" required autofocus/>
                                </div>
                                <!-- Surname -->
                                <div>
                                    <x-label for="surname" :value="__('Surname')"/>

                                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname"
                                             value="{{ $user->surname }}" required autofocus/>
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <!-- Gender -->
                                <div>
                                    <x-label for="information" :value="__('Information')"/>

                                    <x-input id="information" class="block mt-1 w-full" type="text" name="information"
                                             value="{{ $user->information }}" required autofocus/>
                                </div>
                                <!-- age -->
                                <div>
                                    <x-label for="age" :value="__('Age')"/>

                                    <x-input id="age" class="block mt-1 w-full" type="text" name="age"
                                             value="{{ $user->age }}" required autofocus/>
                                </div>
                            </div>
                            <div class="grid grid-rows-2 gap-6">
                                <!-- Location -->
                                <div>
                                    <x-label for="location" :value="__('Location')"/>

                                    <x-input id="location" class="block mt-1 w-full" type="text" name="location"
                                             value="{{ $user->location }}" required autofocus/>
                                </div>
                                <div>
                                    <div class="text-center mt-2">Gender</div>
                                    <label for="gender">Male</label>
                                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender"
                                             value="male" checked/>
                                    <label for="gender">Female</label>
                                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender"
                                             value="female"/>
                                </div>
                            </div>
                            <div>

                                <x-button class="ml-4 mt-2 text-center">
                                    {{ __('Update') }}
                                </x-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
