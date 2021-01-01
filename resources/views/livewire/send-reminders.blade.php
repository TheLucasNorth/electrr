<div>
    @if($sent)
        <p class="py-2 px-4 rounded mt-2">Reminder emails sent. Please be patient while they send.</p>
    @else
        <div>
            <button type="button" class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded mt-2" wire:click="sendEmails()">Send reminder emails</button>
        </div>
    @endif
</div>
