<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-3">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <p class="py-2 px-4 text-xl">Accessibility</p>
            @if($disabled)
                <p class="py-2 px-4">You have disabled candidate shuffling.</p>
            @else
                <p class="py-2 px-4">Candidates will be shuffled on the ballot. If you would like to turn this off, <button style="text-underline: #2d3748; text-decoration: underline" wire:click="disableShuffle()">please click here.</button></p>
            @endif
        </div>
    </div>
</div>
