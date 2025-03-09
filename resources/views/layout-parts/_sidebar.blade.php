<x-menu-item title="Dashboard" icon="o-home" link="/" />
<x-menu-item title="Roles" icon="o-users" link="/roles" />
@can('viewAny', \App\Models\User::class)
    <x-menu-item title="Users" icon="o-users" link="/users" />
@endcan

<x-menu-sub title="General Settings" icon="o-cog-6-tooth">
    <x-menu-item title="Subjects" icon="o-wifi" link="/subjects" />
    <x-menu-item title="Classes" icon="o-archive-box" link="/classes" />
    @can('viewAny', \App\Models\General\AcademicYear::class)
        <x-menu-item title="Academic Settings" icon="o-cog" link="/academic-settings" />
    @endcan
</x-menu-sub>

<x-menu-sub title="Students" icon="o-users">
    <x-menu-item title="Guardians/Parent" icon="o-wifi" link="/subjects" />
    <x-menu-item title="Students" icon="o-archive-box" link="/classes" />
    @can('viewAny', \App\Models\General\AcademicYear::class)
        <x-menu-item title="Academic Settings" icon="o-cog" link="/academic-settings" />
    @endcan
</x-menu-sub>

