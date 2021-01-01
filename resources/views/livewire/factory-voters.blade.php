<div>
    @isset($message)
        <div class="border-2 border-green-500 p-2 mb-2 mt-2">
            {{$message}}
        </div>
    @endisset
    <form wire:submit.prevent="submitForm">
        <input class="px-3 py-2 border-4 border-grey-200" type="number" wire:model.lazy="number">
        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-3 px-4 rounded" type="submit">
            Create Voters
        </button>
    </form>
</div>
