<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('election.edit') }}" :active="false">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link :active="true">
            Manage Voters
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Voters') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-8">

                        <livewire:voters :election="$election"/>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
