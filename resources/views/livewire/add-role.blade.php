<div>
    <form class="w-full" wire:submit.prevent="submitForm">
        @isset($message)
            {{$message}}
        @endisset
        <div class="md:flex flex-wrap md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="roleName">
                    Role Name
                </label>
            </div>
            <div class="w-full">
                <input
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('name') border-red-500 @enderror"
                    id="roleName" wire:model.lazy="name" type="text" name="roleName">
            </div>
            @error('name')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

        <div class="md:flex flex-wrap md:items-center mb-6">
            <div class="md:w-full">
                <label class="block text-gray-500 font-bold mb-1 pr-4" for="description">
                    Role Description
                </label>
                <p>Here you can set an optional description for your role, using markdown formatting.</p>
            </div>
            <div class="md:w-full" wire:ignore>
                <textarea
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="description" wire:model.lazy="description" name="roleDescription"></textarea>
            </div>
        </div>
        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                    Number of seats for this role
                </label>
            </div>
            <div>
                <input
                    class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 @error('seats') border-red-500 @enderror"
                    type="number" id="seats" name="seats" wire:model.lazy="seats">
            </div>
            @error('seats')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                    Open Voting:
                </label>
            </div>
            <div>
                <input type="text" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 dateTimePicker" name="votingOpen" wire:model.lazy="voting_open" id="votingOpen" >
            </div>
            @error('votingOpen')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>
        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                    Close Voting:
                </label>
            </div>
            <div>
                <input type="text" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 dateTimePicker" name="votingClose" wire:model.lazy="voting_close" id="votingClose" >
            </div>
            @error('votingClose')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

            @if($election->nominations)

        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="roleNominations">
                    Allow nominations for this role
                </label>
            </div>
            <div>
                <input class="mr-2 leading-tight" type="checkbox" id="roleNominations" name="roleNominations"
                       wire:model.lazy="nominations">
            </div>
        </div>

        @if($nominations)

            <div class="md:flex md:items-center mb-6">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                        Open Nominations:
                    </label>
                </div>
                <div>
                    <input type="text" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 dateTimePicker" name="nominationsOpen" wire:model.lazy="nominations_open" id="nomsOpen" >
                </div>
                @error('nominationsOpen')
                <div style="color: red"> {{$message}} </div> @enderror
            </div>
            <div class="md:flex md:items-center mb-6">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                        Close Nominations:
                    </label>
                </div>
                <div>
                    <input type="text" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500 dateTimePicker" name="nominationsClose" wire:model.lazy="nominations_close" id="nomsClose" >
                </div>
                @error('nominationsClose')
                <div style="color: red"> {{$message}} </div> @enderror
            </div>
            <div class="md:flex flex-wrap md:items-center mb-6">
                <div>
                    <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="seats">
                        You can ask candidates for specific information when nominating. Enter questions here, separated
                        by semi-colons.
                    </label>
                </div>
                <div class="w-full">
                    <input
                        class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                        type="text" id="information" name="information" wire:model.lazy="information">
                </div>
            </div>


        @endif
@endif
        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="roleRON">
                    Should re-open nominations appear on the ballot?
                </label>
            </div>
            <div>
                <input class="mr-2 leading-tight" type="checkbox" id="roleRON" name="roleRON" wire:model.lazy="ron">
            </div>
            @error('ron')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

        <div class="md:flex md:items-center mb-6">
            <div>
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="roleRanked">
                    Should voters rank candidates in preference order?
                </label>
            </div>
            <div>
                <input class="mr-2 leading-tight" type="checkbox" id="roleRanked" name="roleRanked"
                       wire:model.lazy="ranked">
            </div>
            @error('ranked')
            <div style="color: red"> {{$message}} </div> @enderror
        </div>

        <div class="md:flex md:items-center">
            <button
                class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="submit">
                Create Role
            </button>
        </div>
    </form>

    @push('scripts')
        @once
            <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
            <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        @endonce
        <script>
            var easymde = new EasyMDE({forceSync: true});
            easymde.codemirror.on('change', function () {
            @this.description = easymde.value()
            });
        </script>
        <script>
            flatpickr("#votingOpen", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
        <script>
            flatpickr("#votingClose", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
        <script>
            flatpickr("#nomsOpen", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
        <script>
            flatpickr("#nomsClose", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
    @endpush

    @if($nominations)
        <script>
            flatpickr("#nomsOpen", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
        <script>
            flatpickr("#nomsClose", {
                enableTime: true,
                dateFormat: "d-m-Y H:i"
            });
        </script>
        @endif

</div>
