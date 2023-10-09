<x-guest-layout>
    <div class="container my-5">
        @foreach ($payment as $item)
        <div class="accordion my-3" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#{{ $loop->index }}" aria-expanded="true"
                        aria-controls="{{ $loop->index }}">
                        {{ $item->type_account }}
                    </button>
                </h2>
                <div id="{{ $loop->index }}" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        {{ $item->number_account }} ( {{ $item->name_account }} )

                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

</x-guest-layout>
