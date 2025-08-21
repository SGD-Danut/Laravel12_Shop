<div>
    @if ($section->active)
        <button wire:click="changeStatus('active')" class="btn btn-success">Enabled</button>
    @else
        <button wire:click="changeStatus('active')" class="btn btn-danger">Disabled</button>
    @endif

    @if ($section->promoted)
        <button wire:click="changeStatus('promoted')" class="btn btn-info">Promoted</button>
    @else
        <button wire:click="changeStatus('promoted')" class="btn btn-warning">Standard</button>
    @endif
</div>
