<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="w-100 border rounded-1 p-4 my-5">
        <h3 class="text-center mb-3">Member Tim</h3>
        @php
            $memberCount = $member->count();
        @endphp
        @for ($i = 1; $i <= $total; $i++)
            @if ($i <= $memberCount)
                <livewire:registration.tim.form-detail-member-tim :wire:key="'item-'.$i" index="{{ $i }}"
                    member="{{ json_encode($member[$i - 1]) }}" timId="{{ $timId }}" eventId="{{ $eventId }}" status="{{ $status }}"/>
            @else
                <livewire:registration.tim.form-detail-member-tim :wire:key="'item-'.$i" index="{{ $i }}"
                    :member="null" timId="{{ $timId }}" eventId="{{ $eventId }}" status="{{ $status }}"/>
            @endif
        @endfor
    </div>
</div>
