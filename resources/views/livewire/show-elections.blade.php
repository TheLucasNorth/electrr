<div>
    <div class="w-full flex flex-wrap">
        <div class="m-3">
            <a href="dashboard/elections">
                <button
                    class="bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="24" height="24" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span class="ml-2"> Create Election</span>
                </button>
            </a>
        </div>

        @isset($elections['owns'])
            @foreach($elections['owns'] as $election)
                <div class="m-3">
                    <a href="dashboard/elections/{{$election->slug}}">
                        <button
                            class="bg-white text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            <span class="ml-2">{{$election->name}}</span>
                        </button>
                    </a>
                </div>
            @endforeach
        @endisset
        @isset($elections['manages'])
            @foreach($elections['manages'] as $election)
                <div class="m-3">
                    <a href="dashboard/elections/{{$election->slug}}">
                        <button
                            class="bg-white text-gray-800 font-bold rounded border-b-2 border-purple-500 hover:border-purple-600 hover:bg-purple-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                            </svg>
                            <span class="ml-2">{{$election->name}}</span>
                        </button>
                    </a>
                </div>
            @endforeach
        @endisset
    </div>
</div>
