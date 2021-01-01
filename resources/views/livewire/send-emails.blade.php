<div>
    @if($sent)
        <p class="mr-2 py-2 px-4 rounded mt-2">Invitation emails sent to all voters. Please be patient while they send.</p>
        @else
    <div>
        <button type="button" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-2 mr-2" wire:click="sendEmails()">Send invite emails to all voters</button>
    </div>
        @endif
</div>
