<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Range') }}
        </h2>
    </x-slot>

    <div class=" py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('searchRangeUpdate') }}" >
                        @csrf
                        <div class ="grid grid-col-2 gap-6">

                            <div class="grid grid-rows-2 gap-6">

                                <!-- age from -->
                                <div>
                                    <x-label for="ageFrom" :value="__('Age from')" />

                                    <x-input id="ageFrom" class="block mt-1 w-full" type="text" name="ageFrom" value="{{ $search->age_from }}" required autofocus />
                                </div>
                                <!-- age till -->
                                <div>
                                    <x-label for="ageTill" :value="__('Age till')" />

                                    <x-input id="ageTill" class="block mt-1 w-full" type="text" name="ageTill" value="{{ $search->age_till }}" required autofocus />
                                </div>
                                <!-- Gender -->
                            </div>
                            <div class="grid grid-rows-2 gap-6">

                                <div>
                                    {{--                    <x-label for="gender" :value="__('Gender')" />--}}
                                    <div class="mt-2 text-center">Gender</div>
                                    {{--                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" :value="old('gender')" required autofocus />--}}
                                    <label for="gender">Male</label>
                                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" value="female" checked/>
                                    <label for="gender">Female</label>
                                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" value="male" />
                                    <label for="gender">Both gender</label>
                                    <x-input id="gender" class="block mt-1 w-full" type="radio" name="gender" value="both" />

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
