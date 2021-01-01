<x-election-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $election->name }}
        </h2>
    </x-slot>

    <div class="py-6">

        @if(session('success'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-green-400">
                    <div class="p-2">
                        {{session()->pull('success')}}
                    </div>
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="prose p-4">
                    @markdown
                    {{$election->description}}
                    @endmarkdown
                </div>
            </div>
        </div>

        @if($roles == null)
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <p class="p-4">There are no roles currently open for nominations.</p>
                </div>
            </div>
        @endif

        @foreach($roles as $role)
            <div>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        <div class="mb-2 p-4">
                            <div class="ml-2">
                                <a href="{{route('frontend.nominate', ['role' => $role->id])}}" style="text-underline: #2d3748; text-decoration: underline"><p class="text-2xl">{{$role->name}}</p></a>
                                <div class="mt-2 prose">
                                    @markdown
                                    {{$role->description}}
                                    @endmarkdown
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
</x-election-layout>
