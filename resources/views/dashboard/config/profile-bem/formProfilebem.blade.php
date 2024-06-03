<x-app-layout>
    <x-slot name="header">
        <h3>{{ ucWords($action) }} Profile Bem</h3>
        <p class="text-subtitle text-muted">This page for {{ $action }} Profile Bem.</p>
    </x-slot>

    <livewire:dashboard.config.form-profile-bem/>


</x-app-layout>
