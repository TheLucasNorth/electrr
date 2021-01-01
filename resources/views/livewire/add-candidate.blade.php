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
                    id="manifesto" name="candidateDescription"></textarea>
            </div>
        </div>

        <div class="md:flex flex-wrap md:items-center mb-6">
            <label class="w-full block text-gray-500 font-bold mb-1 pr-4" for="candidateImage{{$uploadCount}}">
                Candidate Image
            </label>
            <input type="file" wire:model="image" id="candidateImage{{$uploadCount}}"
                   @error('image') class="border-red-500" @enderror>
            @error('image') <span style="color: red">{{ $message }}</span> @enderror
        </div>

        <div class="md:flex md:items-center">
            <button
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="submit">
                Create Candidate
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
