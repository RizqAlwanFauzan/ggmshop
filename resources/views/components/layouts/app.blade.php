<x-layouts.adminlte.main :title="$title">
    <x-layouts.adminlte.partials.preloader />
    <x-layouts.adminlte.partials.flashdata />
    <x-layouts.adminlte.partials.navbar />
    <x-layouts.adminlte.partials.sidebar />
    <x-layouts.adminlte.partials.content :title="$title">
        {{ $slot }}
    </x-layouts.adminlte.partials.content>
    <x-layouts.adminlte.partials.footer />
</x-layouts.adminlte.main>
