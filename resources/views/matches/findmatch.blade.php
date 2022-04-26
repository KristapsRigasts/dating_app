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
                    <div class="grid grid-col-2 gap-6">

                        <div class="grid grid-rows-2 gap-6">

                            <!-- Name -->

                            <div class="mt-2 text-center">

                                <div class="ml-12">
                                    <div class="mx-auto d-block" style="width:500px; height: 500px"><img
                                            src="/storage/{{ $picture->picture }}" alt="Profile picture"></div>
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

                        <div class="grid grid-rows-2 gap-6">

                            <div class="mt-3 mb-5">

                            </div>

                            <div class="mt-3 text-center">
                                <span class="prev"><a href="/findmypartner/{{ $user->user_id }}/no"> <button
                                            class="btn btn-danger btn-lg" type="submit">No</button></a></span>
                                <span class="next"><a href="/findmypartner/{{ $user->user_id }}/yes"> <button
                                            class="btn btn-success btn-lg" type="submit">Yes </button></a></span>
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
<script>
    $(document).keydown(function (e) {
        if (e.keyCode == 37) {
            e.preventDefault();
            window.location.href = $(".prev > a").attr("href");
        } else if (e.keyCode == 39) {
            e.preventDefault();
            window.location.href = $(".next > a").attr("href");
        }
    });
</script>
