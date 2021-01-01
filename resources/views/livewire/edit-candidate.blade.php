<div>
    <form class="w-full" wire:submit.prevent="submitForm" enctype="multipart/form-data">
        @isset($message)
            {{$message}}
        @endisset

        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="candidateName">
                    Candidate Name
                </label>
            </div>
            <div class="w-full">
                <input
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('name') border-red-500 @enderror"
                    id="candidateName" wire:model.lazy="name" type="text" name="candidateName">
            </div>
            @error('name')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

        <div class="md:flex flex-wrap md:items-center mb-6">
            <div class="md:w-full">
                <label class="block text-gray-500 font-bold mb-1 pr-4" for="manifesto">
                    Candidate Manifesto
                </label>
                <p>Here you can provide the candidate's manifesto, using markdown formatting.</p>
            </div>
            <div class="md:w-full" wire:ignore>
                <textarea
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="manifesto" name="candidateDescription">{{$manifesto}}</textarea>
            </div>
        </div>

        <div class="md:flex flex-wrap md:items-center mb-6">
            <label class="w-full block text-gray-500 font-bold mb-1 pr-4" for="candidateImage{{$uploadCount}}">
                Candidate Image
            </label>
            @if($candidate->image != null)
                <div class="mt-2 mb-1 w-full"><img src="{{asset('images/'.$candidate->image)}}"></div>
                <p class="w-full mb-1">Upload a new image to replace the existing one, or tick to remove.</p>
                <div class="md:flex md:items-center mb-2 w-full">
                    <div>
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="removeImage">
                            Remove image?
                        </label>
                    </div>
                    <div>
                        <input class="mr-2 leading-tight" type="checkbox" id="removeImage" name="removeImage"
                               wire:model.lazy="removeImage">
                    </div>
                </div>
            @endif
            <input type="file" wire:model.lazy="image" id="candidateImage{{$uploadCount}}"
                   @error('image') class="border-red-500" @enderror>
            @error('image') <span style="color: red">{{ $message }}</span> @enderror
        </div>

            <div class="md:flex md:items-center mb-2 w-full">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="withdraw">
                        Withdraw candidate?
                    </label>
                </div>
                <div>
                    <input class="mr-2 leading-tight" type="checkbox" id="withdraw" name="withdraw" wire:model.lazy="withdraw" @if($candidate->withdrawn) checked @endif >
                </div>
            </div>

            @isset($contact)
                <div class="mt-2 mb-2">
                <p>The following information was provided with the nomination:</p>
            @foreach($contact as $question => $info)
                <p>{{$question}}: {{$info}}</p>
                @endforeach
                </div>
            @endisset
            @unless($candidate->approved)
            <div class="md:flex md:items-center mb-2 w-full">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="approve">
                        Approve nomination?
                    </label>
                </div>
                <div>
                    <input class="mr-2 leading-tight" type="checkbox" id="approve" name="approve" wire:model.lazy="approve" >
                </div>
            </div>
            @endunless

        <div class="md:flex md:items-center">
            <button
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="submit">
                Update Candidate
            </button>
        </div>
    </form>

    @push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
        <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
        <script>
            var easymde = new EasyMDE({forceSync: true});
            easymde.codemirror.on('change', function () {
            @this.manifesto = easymde.value()
            });
        </script>
    @endpush

</div>
