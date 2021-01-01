<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('dashboard').'/elections/'.$election->slug }}" :active="false">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link :active="true">
            Add Role
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div>
                        <livewire:add-role :election="$election"/>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
