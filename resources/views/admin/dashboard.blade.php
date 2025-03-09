<x-layouts.app>

    <div>
        <div class="flex" class="p-0 m-0">
            <x-stat title="Messages" value="44" icon="o-envelope" tooltip="Hello" class="mx-1" />

            <x-stat
                title="Sales"
                description="This month"
                value="22.124"
                icon="o-arrow-trending-up"
                tooltip-bottom="There" class="mx-1"/>

            <x-stat
                title="Lost"
                description="This month"
                value="34"
                icon="o-arrow-trending-down"
                tooltip-left="Ops!" class="mx-1"/>

{{--            <x-stat--}}
{{--                title="Sales"--}}
{{--                description="This month"--}}
{{--                value="22.124"--}}
{{--                icon="o-arrow-trending-down"--}}
{{--                class="text-orange-500"--}}
{{--                color="text-pink-500"--}}
{{--                tooltip-right="Gosh!" class="mx-1"/>--}}
        </div>
    </div>
</x-layouts.app>
