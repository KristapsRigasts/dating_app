<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>
                <!-- Surname -->
                <div>
                    <x-label for="surname" :value="__('Surname')" />

                    <x-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname')" required autofocus />
                </div>

                <!-- Gender -->
                <div>
{{--                    <x-label for="gender" :value="__('Gender')" />--}}
                    <div>Gender</div>
{{--                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" :value="old('gender')" required autofocus />--}}
                    <label for="gender">Male</label>
                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" value="male" checked/>
                    <label for="gender">Female</label>
                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" value="femail" />

                </div>


                <!-- age -->
                <div>
                    <x-label for="age" :value="__('Age')" />

                    <x-input id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')" required autofocus />
                </div>

                <!-- Location -->
                <div>
                    <x-label for="location" :value="__('Location')" />

                    <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required autofocus />
                </div>
                <!-- information -->
                <div>
                    <x-label for="information" :value="__('Information')" />

                    <x-input id="information" class="block mt-1 w-full" type="text" name="information" :value="old('information')" required autofocus />
                </div>

                <!-- image -->
                <div>
                    <x-label for="image" :value="__('Image')" />

                    <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')" required autofocus />
                </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
