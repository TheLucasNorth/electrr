<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="mb-2 p-4">
                <div class="ml-2">
                    <div>
                        <form class="w-full" wire:submit.prevent="submitForm" enctype="multipart/form-data">
                            @isset($message)
                                {{$message}}
                            @endisset

                            <div class="md:flex flex-wrap md:items-center mb-6">
                                <div>
                                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="candidateName">
                                        Name
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
                                        Manifesto
                                    </label>
                                    <p>Here you can provide a manifesto, using markdown formatting.</p>
                                </div>
                                <div class="md:w-full" wire:ignore>
                <textarea
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="manifesto" name="candidateDescription"></textarea>
                                </div>
                            </div>

                            <div class="md:flex flex-wrap md:items-center mb-6">
                                <label class="w-full block text-gray-500 font-bold mb-1 pr-4" for="candidateImage{{$uploadCount}}">
                                    Image (optional)
                                </label>
                                <input type="file" wire:model="image" id="candidateImage{{$uploadCount}}"
                                       @error('image') class="border-red-500" @enderror>
                                @error('image') <span style="color: red">{{ $message }}</span> @enderror
                            </div>

                @foreach($contact as $contact)
                                    <div class="md:flex flex-wrap md:items-center mb-6">
                                        <div>
                                            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="contact{{$loop->index}}">
                                                {{$contact}}
                                            </label>
                                        </div>
                                        <div class="w-full">
                                            <input
                                                class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('information.'.$loop->index) border-red-500 @enderror "
                                                id="contact{{$loop->index}}" wire:model.lazy="information.{{$loop->index}}" type="text" name="contact[{{$loop->index}}]">
                                        </div>
                                        @error('information.'.$loop->index) <span style="color: red">{{ $message }}</span> @enderror
                                    </div>
                @endforeach
                            <div class="md:flex md:items-center">
                                <button
                                    class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                    type="submit">
                                    Submit Nomination
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

                </div>
            </div>
        </div>
    </div>
</div>
