<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('dashboard').'/elections/'.$election->slug }}" :active="false">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('dashboard').'/elections/'.$election->slug.'/roles/'.$role->id }}" :active="false">
            {{$role->name}}
        </x-jet-nav-link>
        <x-jet-nav-link :active="true">
            Results
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Election') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-8 text-2xl">
                        Welcome to electrr!
                    </div>

                    <div class="mt-8">

                        <div class="m-3">
                            <button class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"  width="24" height="24" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="ml-2"> Create Election</span>
                            </button>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
