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
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="long_url" class="block text-sm font-medium text-gray-700">Short URL</label>
                                            <p class="text-2xl font-semibold leading-normal text-gray-800 dark:text-white">{{$short_url}}</p>
                                        </div>
                                        <label for="long_url" class="block text-sm font-medium text-gray-700">Generated QR Code</label>
                                        <div class="col-span-6 rounded-lg shadow-lg bg-white p-6 w-72 group hover:shadow-2xl">
                                            {!! QrCode::size(300)->generate($short_url); !!}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
