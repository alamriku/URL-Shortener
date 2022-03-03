<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md max-w-lg max-w-2xl mx-auto sm:px-6 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mt-10 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0 py-4">
                                <h3 class="text-lg text-center font-sans font-bold  leading-6 text-gray-900">Url shortener</h3>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{route('short-url.store')}}" method="POST">
                                @csrf
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="long_url" class="block text-sm font-medium text-gray-700">Long Url</label>
                                                <input type="text" name="long_url" id="long_url" autocomplete="Long url" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="attempt" class="block text-sm font-medium text-gray-700">Attempts</label>
                                                <input type="text" name="attempt" id="attempt" autocomplete="3 times" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="time_frame" class="block text-sm font-medium text-gray-700">Time Frame</label>
                                                <input type="text" name="time_frame" id="time_frame" autocomplete="1 minutes" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="block_duration" class="block text-sm font-medium text-gray-700">Block Duration</label>
                                                <input type="text" name="block_duration" id="block_duration" autocomplete="5 minutes" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            </div>
                                            <div class="col-span-6 sm:col-span-3">
                                                <label for="expire_at" class="block text-sm font-medium text-gray-700">Expire At</label>
                                                <input name="expire_at" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"  type="datetime-local" >
                                            </div>
                                            <div class="flex justify-center">
                                                {{--<div class="timepicker relative form-floating mb-3 xl:w-96" data-mdb-with-icon="false" id="expire_at">--}}
                                                {{--    <input name="expire_at" type="text"--}}
                                                {{--           class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"--}}
                                                {{--           placeholder="Select a date" data-mdb-toggle="input-toggle-timepicker" />--}}
                                                {{--    <label for="floatingInput" class="text-gray-700">Expire Time</label>--}}
                                                {{--</div>--}}

                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit" class="inline-flex text-blue-600/100 justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
