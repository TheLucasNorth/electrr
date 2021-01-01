<div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="mb-2 p-4">
                <div class="ml-2">
                    <p class="text-2xl">Vote</p>
                    @if($active)
                        <form wire:submit.prevent="submitForm">
                            @if(!$ranked)
                                <label for="method" class="mr-2">Please select your preferred candidate:</label>
                                <div class="relative inline-flex">
                                    <svg class="w-6 h-6 absolute right-0 top-1/3 pointer-events-none" fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                    <select
                                        class="mt-2 bg-white border-gray-900 py-2 pl-4 pr-6 rounded appearance-none shadow-lg"
                                        id="ballot" name="ballot" wire:model="ballot.1">
                                        <option value="">Please select...</option>
                                        @if($shuffle)
                                            @foreach($candidates->shuffle() as $candidate)
                                                <option value="{{$candidate->order}}">{{$candidate->name}}</option>
                                            @endforeach
                                        @else
                                            @foreach($candidates as $candidate)
                                                <option value="{{$candidate->order}}">{{$candidate->name}}</option>
                                            @endforeach
                                        @endif
                                        @if($ron)
                                            <option value="1">Re-Open Nominations</option>
                                        @endif
                                    </select>
                                </div>

                            @endif

                            @if($ranked)

                                <p>You can vote for candidates in preference order. You do not need to vote for
                                    all candidates, or use all preferences.</p>

                                @if($ron)
                                    @for($i=1; $i<=count($candidates)+1; $i++)
                                        <div>
                                            <label for="method">Preference {{$i}}:</label>
                                            <div class="relative inline-flex">
                                                <svg class="w-6 h-6 absolute right-0 top-1/3 pointer-events-none"
                                                     fill="none"
                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                                </svg>
                                                <select
                                                    class="mt-2 bg-white border-gray-900 py-2 pl-4 pr-6 rounded appearance-none shadow-lg ballot"
                                                    id="vote{{$i}}" name="vote[{{$i}}]"
                                                    wire:model.defer="ballot.{{$i}}">
                                                    <option value="">Please select...</option>
                                                    @if($shuffle)
                                                        @foreach($candidates->shuffle() as $candidate)
                                                            <option
                                                                value="{{$candidate->order}}">{{$candidate->name}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($candidates as $candidate)
                                                            <option
                                                                value="{{$candidate->order}}">{{$candidate->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    @if($ron)
                                                        <option value="1">Re-Open Nominations</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endfor
                                @else
                                    @for($i=1; $i<=count($candidates); $i++)
                                        <div>
                                            <label for="method">Preference {{$i}}:</label>
                                            <div class="relative inline-flex">
                                                <svg class="w-6 h-6 absolute right-0 top-1/3 pointer-events-none"
                                                     fill="none"
                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                                </svg>
                                                <select
                                                    class="mt-2 bg-white border-gray-900 py-2 pl-4 pr-6 rounded appearance-none shadow-lg ballot"
                                                    id="vote{{$i}}" name="vote[{{$i}}]"
                                                    wire:model.defer="ballot.{{$i}}">
                                                    <option value="">Please select...</option>
                                                    @if($shuffle)
                                                        @foreach($candidates->shuffle() as $candidate)
                                                            <option
                                                                value="{{$candidate->order}}">{{$candidate->name}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($candidates as $candidate)
                                                            <option
                                                                value="{{$candidate->order}}">{{$candidate->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    @if($ron)
                                                        <option value="1">Re-Open Nominations</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    @endfor
                                @endif

                            @endif

                            <div>
                                <button type="submit"
                                        class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-4">
                                    Cast Ballot
                                </button>
                            </div>

                        </form>
                    @endif
                    @if($verify)
                        <p class="mt-2">Your vote has been cast. Your verification code is {{$verify}}. Please make a
                            note of it, as it cannot be displayed again.</p>
                        <p>You will be able to use your verification code to ensure your vote was recorded and counted
                            properly.</p>
                        <p>You can vote again to update your vote.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".ballot").each(function () {
                    var $self = $(this);
                    $self.data("previous_value", $self.val());
                });

                $(".ballot").on("change", function () {
                    var $self = $(this);
                    var prev_value = $self.data("previous_value");
                    var cur_value = $self.val();

                    $(".ballot").not($self).find("option").filter(function () {
                        return $(this).val() == prev_value;
                    }).prop("disabled", false);

                    if (cur_value != "") {
                        $(".ballot").not($self).find("option").filter(function () {
                            return $(this).val() == cur_value;
                        }).prop("disabled", true);

                        $self.data("previous_value", cur_value);
                    }
                });
            });
        </script>
    @endpush
</div>


