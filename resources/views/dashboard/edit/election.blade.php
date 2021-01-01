<x-app-layout>

    @section('navigation')
        <x-jet-nav-link href="{{ route('election.edit') }}" :active="true">
            {{$election->name}}
        </x-jet-nav-link>
        <x-jet-nav-link href="{{ route('frontend.home') }}" :active="false">
            Voter View
        </x-jet-nav-link>
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $election->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-3">
                        <livewire:edit-election :election="$election"/>
                    </div>
                    <hr class="mt-3">

                    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 divide-x">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Voters</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm">
                                    To view all voters in this election, <a href="{{route('voters', ['election' => $election->slug])}}" style="text-underline: #2d3748; text-decoration: underline">please click here.</a><br>
                                    To view or add email voters in this election, <a href="{{route('emailVoters', ['election' => $election->slug])}}" style="text-underline: #2d3748; text-decoration: underline">please click here.</a><br>
                                    To download a spreadhseet of all voters in this election, please click here.<br><br>
                                    To add voters to this election, enter the number below and click create:<br>
                                    <livewire:factory-voters :election="$election"/>
                                </div>
                            </div>
                        </div>

                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">API Access</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm">
                                    Here you can manage the API keys for your election.<br><br>
                                    Your turnout token is: <strong>{{$election->token}}</strong>. You can use this to report on turnout, and this token does not grant any access to your election.<br>
                                    <a href="{{route('election.api', ['election' => $election->slug])}}">
                                        <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-3 px-4 rounded mt-4" type="button">
                                           Manage API keys
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="grid grid-cols-1 md:grid-cols-2 divide-x">
                        <div class="p-6">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Roles</div>
                            </div>

                            <div class="ml-12">
                                <div class="mt-2 text-sm">
                                    <p>To add a role to this election, <a href=" {{route('role.create', ['election' => $election->slug])}} " style="text-underline: #2d3748; text-decoration: underline">click here</a>.</p>
                                    @foreach($election->roles as $role)
                                        <p class="mt-2 mb-3"><a href="{{route('role.edit', ['election' => $election->slug, 'role' => $role->id])}}" style="text-underline: #2d3748; text-decoration: underline">{{$role->name}}</a> @if($role->candidates()->where('approved', false)->count() > 0) <span class="rounded-full py-1 px-2 bg-blue-300">{{$role->candidates()->where('approved', false)->count()}} Pending Nominations</span> @endif</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="divide-y">

                            <div class="p-6">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8 text-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Turnout</div>
                                </div>

                                <div class="ml-12">
                                    <div class="mt-2 text-sm">
                                        Your election has {{$election->turnout()['voters']}} voters. {{$election->turnout()['ballots']}} ballots have been cast by {{$election->turnout()['unique']}} voters.
                                    </div>
                                </div>
                            </div>


                            @if($election->user_id == \Illuminate\Support\Facades\Auth::guard('admin')->id())

                                <div class="p-6">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor" class="w-8 h-8 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                                                href="https://laravel.com/docs">Election Managers</a></div>
                                    </div>

                                    <div class="ml-12">
                                        <div class="mt-2 text-sm">
                                            Here you can invite other people to manage this election. Click the name of an existing manager to remove them from the election, or enter the email address of someone you want to invite.<br>
                                            <div>
                                                <livewire:election-managers :election="$election"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
