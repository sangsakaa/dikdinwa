<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @section('title', ' | Syn' )
            {{ __('Data Syn') }}
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" flex grid-cols-1 p-6 text-gray-900">
                    <form action="/Syn" method="get">
                        <button class=" bg-red-600 px-4 py-1 text-center text-white font-semibold">
                            Syn
                        </button>
                    </form>
                    @if (Session::has('error'))
                    <div class="alert alert-danger px-4 py-1 capitalize text-red-600 font-semibold">tidak ada jaringan !!!!</div>
                    @else(Session::get('error'))
                    <div class="alert alert-danger px-4 py-1 capitalize text-green-800 font-semibold">sudah di syncron !!!!</div>
                    @endif
                </div>
                @if (session('progressBar'))
                <div class=" p-6">
                    <div class="w-full bg-gray-200 rounded-full">
                        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-2 leading-none rounded-l-full"> {!! session('progressBar') !!} </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>