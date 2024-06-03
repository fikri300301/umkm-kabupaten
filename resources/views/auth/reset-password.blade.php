<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-auth mx-auto my-5">
                    <div class="card-header p-2">{{ __('Update Password') }}</div>
                    <form method="POST" action="{{ route('password.update') }}" class="my-3 p-2">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                                    placeholder="bemfmipa@bem.fmipa">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group has-validation mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        name="password" placeholder="*****" id="password"
                                        aria-describedby="basic-addon2" autocomplete="new-password" required>
                                    <div onclick="changeType('password')">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <input type="password"
                                        class="form-control has-validation @error('password-confirm') is-invalid @enderror"
                                        name="password_confirmation" placeholder="*****" id="password-confirm"
                                        aria-describedby="basic-addon2" autocomplete="new-password" required>
                                    <div onclick="changeType('password-confirm')">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="bi bi-eye-fill"></i></span>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function changeType(id) {
                let type = $(`#${id}`).attr('type');
                if (type == 'text') {
                    $(`#${id}`).attr('type', 'password');
                } else {
                    $(`#${id}`).attr('type', 'text');
                }
                // console.log();
            }
        </script>
    @endpush
</x-guest-layout>
