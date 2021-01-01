<div>


    @if(count($voters)>0)
        @isset($message)
            <div class="border-2 border-green-500 p-2 mb-2 mt-2">
                {{$message}}
            </div>
        @endisset
        <div>
            <label for="search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                              clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input id="search" wire:model="search"
                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm transition duration-150 ease-in-out"
                       placeholder="Search" type="search">
            </div>
            <p class="text-left font-medium text-gray-500 mt-2 mb-2">You can search by email address or voting code.<br>Removing a voter will stop them from being able to log in, but will not remove any ballots already cast.</p>
        </div>
        <div class="flex flex-col mt-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200" id="voters-table">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    email address
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    voting code
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    security code
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    remove
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($voters as $voter)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$voter->email}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$voter->username}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$voter->password_plain}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap"><input type="checkbox" wire:model="selected.{{$voter->id}}"></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mt-8 ml-4 mr-4 mb-4">
                            @if(count($remove)>0)
                                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                    <div>
                                    </div>
                                    <div class="relative z-0 inline-flex shadow-sm">
                                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button" wire:click="removeSelected">
                                            Remove selected
                                        </button>
                                    </div>
                                </div>
                            @else
                                {{ $voters->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You have not added any voters to this election.</p>
    @endif

    <div class="mt-6">
        <p class="mb-2">To create voters, entered the desired number below and click Create Voters.</p>
        <livewire:factory-voters :election="$election"/>
    </div>


</div>
