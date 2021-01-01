<div>
    <form class="w-full" wire:submit.prevent="submitForm">
            @if($ranked)
        <div>
            <label for="method">Please choose a counting method to calculate
                results:</label>
            <div class="relative inline-flex">
                <svg class="w-6 h-6 absolute right-0 top-1/3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path></svg>
                <select class="mt-2  bg-white border-gray-900 py-2 pl-4 pr-6 rounded appearance-none shadow-lg" id="method" name="electionMethod" wire:model="method">
                <option value="Approval">Approval</option>
                <option value="Borda">Borda</option>
                <option value="Bucklin">Bucklin</option>
                @unless($role->votes->count() < 50)
                    <option value="CambridgeSTV">CambridgeSTV</option>
                @endunless
                <option value="Coombs">Coombs</option>
                <option value="ERS97STV">ERS97STV</option>
                <option value="FTSTV">FTSTV</option>
                <option value="GPCA2000STV">GPCA2000STV</option>
                <option value="IRV">IRV</option>
                <option value="MeekNZSTV">MeekNZSTV</option>
                <option value="MeekQXSTV">MeekQXSTV</option>
                <option value="MeekSTV">MeekSTV</option>
                <option value="MinneapolisSTV">MinneapolisSTV</option>
                <option value="NIrelandSTV">NIrelandSTV</option>
                <option value="QPQ">QPQ</option>
                <option value="RTSTV">RTSTV</option>
                <option value="SNTV">SNTV</option>
                <option value="SanFranciscoRCV">SanFranciscoRCV</option>
                <option value="ScottishSTV" selected>ScottishSTV</option>
                <option value="SuppVote">SuppVote</option>
                <option value="WarrenQXSTV ">WarrenQXSTV</option>
                <option value="WarrenSTV">WarrenSTV</option>
            </select>
            </div>
        </div>
        @endif
            <div>
                <button type="submit" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-2">Generate results</button>
            </div>
    </form>
</div>
