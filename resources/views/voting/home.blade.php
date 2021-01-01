<x-election-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $election->name }}
        </h2>
    </x-slot>

    <div class="py-6">

        @isset($election->description)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="prose p-4">
                    @markdown
                    {{$election->description}}
                    @endmarkdown
                </div>
            </div>
        </div>
        @endisset

        @if($election->activeRoles() == null)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p class="p-4">There are no roles currently open for voting.</p>
                </div>
            </div>
        @endif

        @foreach($election->activeRoles() as $role)
            <livewire:role-details :role="$role"/>
        @endforeach
@unless($election->activeRoles() == null)
            @if($election->shuffle_candidates)
<livewire:disable-shuffle />
@endif
            @endunless

    </div>
</x-election-layout>
