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

{{--                            <div class="grid grid-rows-2 gap-6">--}}

                                <!-- age from -->
{{--                                <div>--}}
{{--                                    <x-label for="ageFrom" :value="__('Age from')" />--}}

{{--                                    <x-input id="ageFrom" class="block mt-1 w-full" type="text" name="ageFrom" value="{{ $search->age_from }}" required autofocus />--}}
{{--                                </div>--}}
{{--                                <!-- age till -->--}}
{{--                                <div>--}}
{{--                                    <x-label for="ageTill" :value="__('Age till')" />--}}

{{--                                    <x-input id="ageTill" class="block mt-1 w-full" type="text" name="ageTill" value="{{ $search->age_till }}" required autofocus />--}}
{{--                                </div>--}}
{{--                                <!-- Gender -->--}}
{{--                            </div>--}}
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
                            <div class="mt-4 text-center">
                                Age from - till
                            </div>


                            <div class="wrapper mt-1 text-center">
                                <div class="values">
                                    <span id="range1">
                                        0
                                     </span>
                                    <span> &dash; </span>
                                    <span id="range2">
                                        100
                                    </span>
                                </div>
                                <div class="container ">
                                    <div class="slider-track"></div>
                                    <input type="range" min="18" max="100" value="{{ $search->age_from }}" id="slider-1" name="slider1" oninput="slideOne()">
                                    <input type="range" min="18" max="100" value="{{ $search->age_till }}" id="slider-2" name="slider2" oninput="slideTwo()">
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

<script>
    window.onload = function () {
        slideOne();
        slideTwo();
    };

    let sliderOne = document.getElementById("slider-1");
    let sliderTwo = document.getElementById("slider-2");
    let displayValOne = document.getElementById("range1");
    let displayValTwo = document.getElementById("range2");
    let minGap = 0;
    let sliderTrack = document.querySelector(".slider-track");
    let sliderMaxValue = document.getElementById("slider-1").max;

    function slideOne() {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderOne.value = parseInt(sliderTwo.value) - minGap;
        }
        displayValOne.textContent = sliderOne.value;
        fillColor();
    }
    function slideTwo() {
        if (parseInt(sliderTwo.value) - parseInt(sliderOne.value) <= minGap) {
            sliderTwo.value = parseInt(sliderOne.value) + minGap;
        }
        displayValTwo.textContent = sliderTwo.value;
        fillColor();
    }
    function fillColor() {
        percent1 = (sliderOne.value / sliderMaxValue) * 100;
        percent2 = (sliderTwo.value / sliderMaxValue) * 100;
        sliderTrack.style.background = `linear-gradient(to right, #dadae5 ${percent1}% , #3264fe ${percent1}% , #3264fe ${percent2}%, #dadae5 ${percent2}%)`;
    }
</script>
