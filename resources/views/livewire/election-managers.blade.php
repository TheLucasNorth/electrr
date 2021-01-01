<div>
    <div>
        @isset($message)
            <div class="border-2 border-green-500 p-2 mb-2 mt-2">
                {{$message}}
            </div>
        @endisset
        <form wire:submit.prevent="submitForm" class="mt-2 mb-2">
            <input class="px-10 py-2 border-4 border-grey-200" type="email" wire:model.lazy="email">
            <button
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-3 px-4 rounded"
                type="submit">
                Invite to manage
            </button>
        </form>
    </div>
    <div wire:model="managers">
        @isset($managers)
                @foreach($managers as $manager)
                    <div wire:model="managers.{{$manager->id}}"><a wire:click="remove({{$manager->id}})" class="active underline"
                            style="color: #1a202c">{{$manager->name}} ({{$manager->email}})</a></div>
                @endforeach
        @endisset
    </div>


</div>
