<div>
    <div wire:loading.remove>
        <div>
            To download a spreadhseet of all voters in this election, <button wire:click="downloadVoters()" style="text-underline: #2d3748; text-decoration: underline" wire:loading.attr="disabled">please click here.</button>
        </div>
    </div>
    <div wire:loading>
        <span>Downloading...</span>
    </div>
    <br><br>
</div>
