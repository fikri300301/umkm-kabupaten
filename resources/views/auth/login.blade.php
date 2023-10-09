<x-guest-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card-auth mx-auto my-5">
                    <div class="card-header">{{ __('Login') }}</div>
                    <h4 class="text-center">sistem informasi Data UMKM Kabupaten Kediri</h4>
                    <div class="card-body ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
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
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="*****" id="password" aria-describedby="basic-addon2"
                                            autocomplete="current-password" required>
                                        <div onclick="changeType('password')">
                                            <span class="input-group-text" id="basic-addon2"><i
                                                    class="bi bi-eye-fill"></i></span>
                                        </div>
                                        @error('password')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Lupa Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
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
