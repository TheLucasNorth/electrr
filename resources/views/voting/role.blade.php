<x-election-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $election->name }}: {{$role->name}}
        </h2>
    </x-slot>

    <div class="py-6">

        @isset($role->description)
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="prose p-4">
                    @markdown{{$role->description}}@endmarkdown
                </div>
            </div>
        </div>
        @endisset

        @if($role->activeCandidates() == null && !$role->ron)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p class="p-4">There are no candidates for this role.</p>
                </div>
            </div>
        @endif

        @foreach($role->activeCandidates() as $candidate)
            <div class="mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="mb-2 p-4">
                            <div class="ml-2">
                                <p class="text-2xl">{{$candidate->name}}</p>
                                <div class="flex flex-wrap">
                                    <div class="mt-2 prose @if($candidate->image) w-2/3 @endif ">
                                        @markdown{{$candidate->manifesto}}@endmarkdown
                                    </div>
                                    @if($candidate->image)
                                        <div class="mt-2 w-1/3">
                                            <img src="{{asset('images/'.$candidate->image)}}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($role->ron)
            <div class="mb-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="mb-2 p-4">
                            <div class="ml-2">
                                <p class="text-2xl">Re-Open Nominations</p>
                                    <div class="mt-2 prose">
                                        <p>You may also vote to reopen nominations for this role.</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        @unless($role->activeCandidates() == null && !$role->ron)
            <livewire:vote :role="$role" />
        @endunless

    </div>
</x-election-layout>
