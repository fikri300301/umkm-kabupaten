<x-app-layout>
    <x-slot name="header">
        {{-- <h3>This Page manage peserta Pelatihan</h3> --}}
        <p class="text-subtitle text-muted"> </p>
    </x-slot>
    <livewire:dashboard.penerima-perizinan.penerima-perizinan  perizinanId="{{ $perizinan }}" /> 
</x-app-layout>