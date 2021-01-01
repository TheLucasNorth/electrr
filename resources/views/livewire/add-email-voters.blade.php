<div>
    <h2 class="text-2xl">Add email voters</h2>
    <div>
        <p>You can add email voters by providing a list of email addresses separated by semicolons. Alternatively, you
            can upload a csv file of email addresses.</p>
        @isset($message)
            <div class="border-2 border-green-500 p-2 mb-2 mt-2">
                {{$message}}
            </div>
        @endisset
        <textarea
            class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 mt-2"
            wire:model.lazy="input"></textarea>
        <div wire:loading wire:target="createInput">
            Adding Voters...
        </div>
        <button wire:loading.remove
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-2"
                type="button" wire:click="createInput">
            Create voters
        </button>
        <div class="mt-6" >
            <form wire:submit.prevent="createFile" enctype="multipart/form-data" wire:loading.remove wire:target="createFile">
                <input type="file" wire:model="file" id="upload{{$uploadCount}}">
                <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-2">Upload and Create</button>
                <br>@error('file') <span class="error">{{ $message }}</span> @enderror
            </form>
            <p wire:loading wire:target="createFile" class="mb-6">Adding voters...</p>
        </div>
            </div>
</div>
