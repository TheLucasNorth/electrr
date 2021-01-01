<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('dashboard').'/elections/'.$election->slug }}" :active="false">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link :active="true">
            Manage API Tokens
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('API Tokens') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <livewire:election-api-token-manager :election="$election" />
        </div>
    </div>
</x-app-layout>
