<div>
    <div class="v181_3858"></div>
    <section class="account-profile container">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-center">
                <div class="mx-auto d-flex align-items-stretch gap-3">
                    <div>
                        <div class="text-center">
                            <img src="https://ui-avatars.com/api/?name=l&color=7F9CF5&background=888c8f&color=fff&font-size=0.7&rounded=true&bold=true&size=130"
                                class="rounded" alt="{{ $data->name }}">
                        </div>
                    </div>
                    <div>
                        <h1>{{ $data->name }}</h1>
                        <h6>{{ $data->email }}</h6>
                        <button type="button" class="btn btn-primary" onclick="openModal('edit-modal')">Edit
                            Data</button>
                        <button type="button" class="btn btn-outline-primary"
                            onclick="openModal('password-modal')">Ubah Password</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="event-profile container">
        {{-- <h3 class="text-center">Event</h3>
        <hr /> --}}
        {{-- <livewire:partials.event-in-profile /> --}}
    </section>

    {{-- edit data --}}
    <div wire:ignore.self class="modal fade text-left" id="edit-modal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Edit Data</h4>
                    <button type="button" class="close" aria-label="Close" onclick="closeEditModal('edit-modal')">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name"
                                value="{{ $data->name }}" required autocomplete="name" autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                        <div class="col-md-6">
                            <input id="phone" type="tel" class="form-control" name="phone"
                                value="{{ $data->phone }}" required autofocus>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email"
                                value="{{ $data->email }}" required autocomplete="email">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" onclick="closeEditModal('edit-modal')">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1" onclick="sendEditModal('edit-modal')">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kirim</span>
                    </button>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit data --}}
    {{-- edit data --}}
    <div wire:ignore.self class="modal fade text-left" id="password-modal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel4">Edit Data</h4>
                    <button type="button" class="close" aria-label="Close" onclick="closeEditModal('password-modal')">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="current-password"
                            class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password"
                                    class="form-control @error('current-password') is-invalid @enderror"
                                    name="current-password" placeholder="*****" id="current-password"
                                    aria-describedby="basic-addon2" autocomplete="current-password" required>
                                <div onclick="changeType('current-password')">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-baru"
                            class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password"
                                    class="form-control @error('password-baru') is-invalid @enderror"
                                    name="password-baru" placeholder="*****" id="password-baru"
                                    aria-describedby="basic-addon2" autocomplete="password-baru" required>
                                <div onclick="changeType('password-baru')">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="konfimasi-password"
                            class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password Baru') }}</label>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input type="password"
                                    class="form-control @error('konfimasi-password') is-invalid @enderror"
                                    name="konfimasi-password" placeholder="*****" id="konfimasi-password"
                                    aria-describedby="basic-addon2" autocomplete="konfimasi-password" required>
                                <div onclick="changeType('konfimasi-password')">
                                    <span class="input-group-text" id="basic-addon2"><i
                                            class="bi bi-eye-fill"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        onclick="closeEditModal('password-modal')">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Tutup</span>
                    </button>
                    <button type="button" class="btn btn-primary ms-1"
                        onclick="sendPasswordModal('password-modal')">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kirim</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- end edit data --}}
    @push('scripts')
        <script>
             function changeType(id) {
                let type = $(`#${id}`).attr('type');
                if(type == 'text'){
                    $(`#${id}`).attr('type','password');
                }else{
                    $(`#${id}`).attr('type','text');
                }
            }
            function openModal(id) {
                const customEvent = new CustomEvent("openFormModal", {
                    detail: {
                        id: id,
                    }
                });
                window.dispatchEvent(customEvent);
            }

            function closeEditModal(id) {
                const customEvent = new CustomEvent("closeFormModal", {
                    detail: {
                        id: id,
                    }
                });
                window.dispatchEvent(customEvent);
            }

            function sendEditModal(id) {
                let name = $("#name").val();
                let email = $("#email").val();
                let phone = $("#phone").val();
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-profile-account') }}",
                    data: {
                        "name": name,
                        "email": email,
                        "phone": phone,
                        "_token": token,
                    },
                    success: function(response) {
                        const customEvent = new CustomEvent("messageSuccess", {
                            detail: {
                                message: response.message,
                            }
                        });
                        window.dispatchEvent(customEvent);
                        closeEditModal(id);
                    },
                    error: function(response) {
                        let data = 'ada kesahalan';
                        if (response.responseJSON.name !== undefined && response.responseJSON.name[0] !==
                            undefined) {
                            data = response.responseJSON.name[0]
                        }
                        if (response.responseJSON.email !== undefined && response.responseJSON.email[0] !==
                            undefined) {
                            data = response.responseJSON.email[0]
                        }
                        if (response.responseJSON.phone !== undefined && response.responseJSON.phone[0] !==
                            undefined) {
                            data = response.responseJSON.phone[0]
                        }
                        const customEvent = new CustomEvent("errorSuccess", {
                            detail: {
                                message: data,
                            }
                        });
                        window.dispatchEvent(customEvent);
                    }
                });
            }

            function sendPasswordModal(id) {
                let currentPassword = $("#current-password").val();
                let passwordBaru = $("#password-baru").val();
                let konfimasiPassword = $("#konfimasi-password").val();
                let token = $("meta[name='csrf-token']").attr("content");
                $.ajax({
                    type: "POST",
                    url: "{{ route('update-password-account') }}",
                    data: {
                        "currentPassword": currentPassword,
                        "passwordBaru": passwordBaru,
                        "konfimasiPassword": konfimasiPassword,
                        "_token": token,
                    },
                    success: function(response) {
                        const customEvent = new CustomEvent("messageSuccess", {
                            detail: {
                                message: response.message,
                            }
                        });
                        window.dispatchEvent(customEvent);
                        closeEditModal(id);
                    },
                    error: function(response) {
                        let data = 'ada kesahalan';
                        console.log(response.responseJSON);
                        if (response.responseJSON.currentPassword !== undefined && response.responseJSON
                            .currentPassword[0] !==
                            undefined) {
                            data = response.responseJSON.currentPassword[0]
                        }
                        if (response.responseJSON.passwordBaru !== undefined && response.responseJSON.passwordBaru[
                                0] !==
                            undefined) {
                            data = response.responseJSON.passwordBaru[0]
                        }
                        if (response.responseJSON.konfimasiPassword !== undefined && response.responseJSON
                            .konfimasiPassword[0] !==
                            undefined) {
                            data = response.responseJSON.konfimasiPassword[0]
                        }
                        const customEvent = new CustomEvent("errorSuccess", {
                            detail: {
                                message: data,
                            }
                        });
                        window.dispatchEvent(customEvent);
                    }
                });
            }
        </script>
    @endpush
</div>
