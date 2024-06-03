<x-guest-layout>
    <section class="regisration-event">
        <div class="v181_3858"></div>
        <div class="container">
            <div class="col-12">
                <h2 class="text-center p-4">{{ $eventName }}</h2>
                <div class="card-body">
                    <div class="message-for-regis">
                        @if (!is_null($codeTim))
                            <div class="alert alert-info">
                                <h4 class="text-center">Code Uniq : <br> {{ @$codeTim }}</h4>
                                <h5>Status Tim : <b><i>{{ ucwords(@$status) }}</i></b> </h5>
                                <ul>
                                    <li>
                                        <p>Seluruh infomasi akan di infomarsikan memalui
                                            <b><i>{{ @$email }}</i></b>
                                        </p>
                                    </li>
                                    <li>
                                        Informasi untuk pembayaran <a href="/pembayaran">disini</a>
                                    </li>
                                </ul>
                            </div>
                            @if (!is_null($message_tim))
                                <div class="alert alert-warning">
                                    <h6>Pesan : {{ @$message_tim }}</h6>
                                </div>
                            @endif

                        @endif
                    </div>
                    <livewire:registration.individu.form-individu codeTim="{{ $codeTim }}"
                        maxParticipant="{{ $eventMaximalParticipant }}" eventId="{{ encrypt($eventId) }}" />
                    @if (!is_null($codeTim))
                        @if ($type == 'paid')
                            <livewire:registration.payment codeTim="{{ $codeTim }}" />
                        @endif
                        @if ($task && $status == 'pendaftaran berhasil')
                            <livewire:registration.submission codeTim="{{ $codeTim }}" />
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
