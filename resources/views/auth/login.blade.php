@extends('layouts.app')

@section('content')
{{-- login --}}
 <section style="background-color: #2a4561;">
    <div class="container py-5 h-100">
        <div class="col-12 mb-4">
            <h1 style="color: #ffffff;" class="text-center">Discover the world of cryptos</h1>
        </div>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
               <img src="https://i.ibb.co/wJqPKhw/btc.jpg" alt="btc" class="img-fluid" style="border-radius: 1rem 0 0 1rem;max-width: 100% !important;
                height: 559px !important;" />
            </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mb-0"><h2>Login Page</h2></span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login from here to access.</h5>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                      <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                      <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
                      @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="form-label mb-2">
                        <div class="form-label">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-dark btn-lg btn-block">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <a class="small text-muted">@if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif</a>
                    <a href="#" class="small text-muted">Terms of use.</a>
                    <a href="#" class="small text-muted">Privacy policy</a>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
