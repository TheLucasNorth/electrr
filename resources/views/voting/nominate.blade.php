<x-election-layout>
    @section('navigation')
        <x-jet-nav-link href="{{ route('frontend.nominations') }}" :active="false">
            Nominations Home
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $election->name }}: {{$role->name}}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="prose p-4">
                    @markdown
                    {{$role->description}}
                    @endmarkdown
                </div>
            </div>
        </div>

        <livewire:nomination-form :role="$role" />

    </div>
</x-election-layout>
