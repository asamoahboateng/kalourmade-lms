<x-menu-item title="Dashboard" icon="o-home" link="/" />
<x-menu-item title="Roles" icon="o-users" link="/roles" />
@can('viewAny', \App\Models\User::class)
    <x-menu-item title="Users" icon="o-users" link="/users" />
@endcan
<x-menu-sub title="Settings" icon="o-cog-6-tooth">
    <x-menu-item title="Wifi" icon="o-wifi" link="####" />
    <x-menu-item title="Archives" icon="o-archive-box" link="####" />
</x-menu-sub>
