<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-2">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="mb-2 p-4">
                <div class="ml-2">
                    <a href="{{route('frontend.vote', ['role' => $role->id])}}" style="text-underline: #2d3748; text-decoration: underline"><p class="text-2xl">{{$role->name}}</p></a>
                    @isset($role->description)
                    <div class="mt-2 prose">
                        @markdown{{$role->description}}@endmarkdown
                    </div>
                    @endisset
                    @if($voted)
                        <p>You've already voted for this role.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
