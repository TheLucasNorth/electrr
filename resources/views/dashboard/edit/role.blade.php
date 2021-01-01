<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('election.edit') }}" :active="false">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('role.edit') }}" :active="true">
            {{$role->name}}
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div>
                        <livewire:edit-role :election="$election" :role="$role"/>
                    </div>

                    <hr class="mt-5">

                    <div class="grid grid-cols-1 md:grid-cols-2 divide-x">
                        <div class="mt-6">
                            <div class="text-lg text-gray-600 leading-7 font-semibold">Candidates</div>
                            <p class="mt-2">To add a candidate to this role, <a href="{{route('candidate.create')}}" style="text-underline: #2d3748; text-decoration: underline">click here.</a></p>
                            @foreach($role->candidates as $candidate)
                               <p class="mb-3 mt-2"><a href="{{route('candidate.edit', ['candidate' => $candidate->id])}}" style="text-underline: #2d3748; text-decoration: underline"> {{$candidate->name}}</a>@if(!$candidate->approved) <span class="rounded-full py-1 px-2 bg-blue-300">Pending</span> @endif</p>
                            @endforeach
                        </div>
                        <div class="p-6">
                            <div class="text-lg text-gray-600 leading-7 font-semibold">Results</div>

                            @if($role->votes->count() === 0)
                                <p>There have been no votes cast for this role, and so it is not currently possible to generate results.</p>
                            @else
                            <p class="mt-2 mb-2">Please be aware that, for very large elections, there may be a slight delay. Please be patient and do not refresh the page.</p>
                            @if($role->ranked)
                                <p>You can select a counting method below and then click to generate results. Please note some counting methods, such as Cambridge STV, may not be shown unless conditions are met.</p>
                            @else
                                <p>Please click below to generate results.</p>
                            @endif
                            <div class="mt-3 mb-3">
                                <livewire:generate-results :role="$role" :election="$election" />
                            </div>
                            <p class="mt-2 mb-2"><a href="{{route('results.download')}}" style="text-underline: #2d3748; text-decoration: underline">Click here to download a .blt file of the ballots cast for this role.</a></p>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
