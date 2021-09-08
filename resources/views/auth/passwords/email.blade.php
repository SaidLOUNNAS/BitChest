@extends('layouts.app')

@section('content')
{{-- reset pass --}}
 <section style="background-color:black;">
    <div class="container py-5 h-100">
        <div class="col-12 mb-4">
            <h1 class="text-center text-white">Discover the world of cryptos</h1>
        </div>
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-none d-md-block">
               <img src="https://i.guim.co.uk/img/media/11dc9ef75006f20cff02ffa52f58d3e2d62b2c55/0_0_3500_2100/master/3500.jpg?width=1200&height=1200&quality=85&auto=format&fit=crop&s=fe1797a2adf66d56aa683356a86234b1"
               alt="btc" class="img-fluid" style="border-radius: 1rem 0 0 1rem;max-width: 100% !important;
                height: 559px !important;" />
            </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                   <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                    <div class="d-flex align-items-center mb-3 pb-1">
                      <span class="h1 fw-bold mb-0">Welcome To Bitchest</span>
                    </div>
                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Reset Your Password</h5>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">{{ __('E-Mail Address') }}</label>
                      <input type="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="pt-1 mb-4">
                        <button type="submit" class="btn btn-dark btn-lg btn-block">
                            {{ __('Send Password Reset Link') }}
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
