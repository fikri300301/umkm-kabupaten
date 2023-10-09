<x-app-layout>
    <x-slot name="header">
        <h3>{{ ucWords($action) }} Album</h3>
        <p class="text-subtitle text-muted">This page for {{ $action }} album.</p>
    </x-slot>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <form class="my-2" id="form" enctype="multipart/form-data" method="post"
                    action="/dashboard/{{ $action }}-album">
                    @csrf
                    <input type="hidden" name="uniqId" value="{{ @$uniqId }}">
                    <div class="mb-3">
                        <label for="status" class="form-label">
                            <h6>Status album</h6>
                        </label>
                        <div class="d-flex gap-2">
                            <div class="label-draft">
                                <p>Draft</p>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="status" value="publish"
                                    @if (!isset($status)) @checked(true)
                            @elseif ($status == 'publish') @checked(true) @endif />
                            </div>
                            <div class="label-publish">
                                <p>Publish</p>
                            </div>
                        </div>
                    </div>
                    <x-input name="name" label="Nama Album" value="{{ $name ?? old('name') }}"
                        placeholder="Pengabdian" required="1" />
                    <x-textarea-tiny name="description_album" label="Deskripsi Album">
                        {{ @$description_album ?? old('description_album') }}</x-textarea-tiny>
                    @if (!is_null($uniqId))
                        <livewire:dashboard.manage-album.image-album uniqId="{{ $uniqId }}"/>
                    @endif
                    <div class="d-inline gap-3">
                        <a href="{{ route('manage-album') }}" class="btn btn-warning">Cancel</a>
                        <button type="submit" class="btn btn-primary ms-1">
                            @if (is_null($uniqId))
                                Lanjutkan
                            @else
                                Submit
                            @endif
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </section>
</x-app-layout>
