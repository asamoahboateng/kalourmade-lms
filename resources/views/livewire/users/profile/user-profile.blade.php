<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <x-card title="User Profile" subtitle="create a user profile" separator progress-indicator>

        <form wire:submit="create">
            {{ $this->form }}

            <x-button type="submit" class="btn-primary bg-white">
                Save Profile
            </x-button>
        </form>

    </x-card>



    <x-filament-actions::modals />
</div>
