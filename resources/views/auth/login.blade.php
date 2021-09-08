@extends('layouts.app')

@section('content')
{{-- login --}}
   <section class="" style="background-color:black;">
    <div class="container ">
    <div class="col-12 mb-4">
        <h1 class="text-center text-white" style="padding-top: 10px">Discover the world of cryptos</h1>
    </div>
      <div class="row d-flex justify-content-center align-items-center h-100" style="padding-bottom: 50px">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://i.guim.co.uk/img/media/11dc9ef75006f20cff02ffa52f58d3e2d62b2c55/0_0_3500_2100/master/3500.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=fe1797a2adf66d56aa683356a86234b1"
                alt="btc" class="img-fluid" style="border-radius: 1rem 0 0 1rem;max-width: 100% !important;
                 height: 635px !important;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="d-flex align-items-center mb-3 pb-1">
                      <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                      <span class="h1 fw-bold mt-0">Welcome To Bitchest</span>
                    </div>

                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Login From Here To Access</h5>

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
                    @if (Route::has('password.request'))
                    <a class="small text-muted" href="{{ route('password.request') }}"> {{ __('Forgot Your Password?') }}?</a>
                    @endif
                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{ route('register') }}" style="color: #393f81;">{{ __('Register here') }}</a></p>
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
