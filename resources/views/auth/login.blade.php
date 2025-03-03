<x-layouts.auth>
    <div class="">
        <div class="mt-[25vh] mx-auto w-sm lg:w-1/3 border-2 shadow-md p-5 bg-white">
            <h2 class="text-center text-primary p-2 text-3xl font-semibold">{{ config('app.name') }}</h2>
            <x-form>
                <x-input label="Username" placeholder="Username or email" />
                <x-password label="Password" wire:model="password" password-icon="o-lock-closed" password-visible-icon="o-lock-open" clearable/>

                <x-slot:actions>
                    <x-button label="Cancel" />
                    <x-button label="Click me!" class="btn-primary"  type="submit" spinner="save2" />
                </x-slot:actions>


            </x-form>
        </div>
    </div>
</x-layouts.auth>
