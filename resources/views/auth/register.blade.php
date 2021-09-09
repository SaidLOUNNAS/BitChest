@extends('layouts.app')
@section('content')
{{-- register --}}
<section class="" style="background-color:rgba(212, 212, 212, 0.507);">
    <div class="container">
    <div class="col-12 mb-4">
        <h1 class="text-center text-black" style="padding-top: 10px">Discover the world of cryptos</h1>
    </div>
      <div class="row d-flex justify-content-center align-items-center h-100" style="padding-bottom: 50px">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="https://i.guim.co.uk/img/media/11dc9ef75006f20cff02ffa52f58d3e2d62b2c55/0_0_3500_2100/master/3500.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=fe1797a2adf66d56aa683356a86234b1"
                alt="btc" class="img-fluid" style="border-radius: 1rem 0 0 1rem;max-width: 100% !important;
                 height: 774px !important;" />
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mt-0">Welcome To Bitchest</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register From Here To Access</h5>
                    <div class="form-outline mb-4">
                        <label for="first_name" class="form-label">{{ __('First Name') }}</label>
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label for="last_name" class="form-label">{{ __('Last Name') }}</label>
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        </div>

                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                        <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">{{ __('Password') }}</label>
                      <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"/>
                      @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-outline mb-4">
                        <label class="password-confirm" for="password">{{ __('Confirm Password') }}</label>
                      <input type="password" id="password-confirm" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password"/>
                      @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            {{ __('register') }}
                        </button>
                    </div>
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
