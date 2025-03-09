<x-layouts.app>
    {{--    card for the academix year--}}

    <x-card title="Academic Year" subtitle="created academic years" class="mt-5 bg-gray-200" separator progress-indicator>
        <livewire:general.academics.list_year />
    </x-card>

    <x-card title="Academic Term" subtitle="created academic terms" class="mt-5" separator progress-indicator>
        <livewire:general.academics.list_term />
    </x-card>
</x-layouts.app>
