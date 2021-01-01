<div>
    <form class="w-full" wire:submit.prevent="submitForm">
        @isset($message)
            {{$message}}
        @endisset
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="electionName">
                    Election Name
                </label>
            </div>
            <div class="w-full">
                <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('name') border-red-500 @enderror" id="electionName" wire:model.lazy="name" type="text" name="electionName">
            </div>
            @error('name') <div style="color: red"> {{$message}} </div> @enderror
        </div>
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="electionSlug">
                    Election Slug
                </label>
            </div>
            <span>The slug identifies your election, and must be unique. Something short and descriptive is best. Can only contain letters, numbers, dashes, and underscores.</span>
            <div class="w-full">
                <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('slug') border-red-500 @enderror" id="electionSlug" wire:model.lazy="slug" type="text" name="electionSlug">
            </div>
            @error('slug') <div style="color: red"> {{$message}} </div> @enderror
        </div>
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div class="md:w-full">
                <label class="block text-gray-500 font-bold mb-1 pr-4" for="electionDescription">
                    Election Description
                </label>
                <p>Here you can set an optional description for your election, using markdown formatting.</p>
            </div>
            <div class="md:w-full" wire:ignore>
                <textarea class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="description" name="electionDescription"></textarea>
            </div>
        </div>
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="electionImprint">
                    Imprint
                </label>
            </div>
            <div class="w-full">
                <input class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="electionImprint" wire:model.lazy="imprint" type="text" name="electionImprint">
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="electionNominations">
                    Allow nominations for roles in this election
                </label>
            </div>
            <div>
                <input class="mr-2 leading-tight" type="checkbox" id="electionNominations" name="electionNominations" wire:model.lazy="nominations">
            </div>
        </div>
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="electionShuffle">
                    Shuffle candidates on the ballot
                </label>
            </div>
            <div>
                <input class="mr-2 leading-tight" type="checkbox" id="electionShuffle" name="electionShuffle" wire:model.lazy="shuffle_candidates" @unless(!$shuffle_candidates) checked @endunless >
            </div>
        </div>

        <div class="md:flex md:items-center">
                <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                    Create Election
                </button>
        </div>
    </form>
@push('scripts')
        <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
        <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
        <script>
            var easymde = new EasyMDE({forceSync: true});
            easymde.codemirror.on('change', function () {
                @this.description = easymde.value()
            });
        </script>
    @endpush

</div>
