@extends('layouts.layout')
@section('title', 'Cryptocurrency')
@section('content')
{{-- title --}}
<div class="col-12">
    @if (Auth::user()->status == 'admin')
    <h1 class="text-center mb-4">The world of cryptos</h1>
    @elseif (Auth::user()->status == 'client')
    <h1 class="text-center mb-4">Discover the world of cryptos</h1>
    @endif
</div>
     <!-- show table of currency -->
     <table class="table card-body ml-4">
        <tbody>
          <thead>
            <tr>
              <th>Coin</th>
              <th>Last prize</th>
              <th>Markets</th>
              <th></th>
            </tr>
          </thead>
          @foreach ($currencies as $currency)
          <tr>
              <td><img src="{{ asset($currency->logo) }}" alt="Logo" class="mr-3">
                {{ $currency->name }} <span style="color: #707A8A;">
              {{ $currency->api_id }} </span></td>
              <td>
                  <span @if ($currency->change == '+') style="color: #58ee58;" @else style="color: #ff0f07;" @endif>
                    {{ str_replace('.', ',', $currency->current_rate) }} {{ config('currency')['symbol']}}
                </span>
                  </td>
                  <td>
                      {{-- only for admin --}}
                    @if (Auth::user()->status == 'admin')
                          @if ($currency->change == '+')
                          <img style="width: 90px;" src="https://images.cryptocompare.com/sparkchart/SOL/USD/latest.png?ts=1631085600" alt="15308-200" border="0" />
                          @else
                          <img style="width: 90px;" src="https://images.cryptocompare.com/sparkchart/BTC/USD/latest.png?ts=1631085600" alt="15308-200" border="0" />
                          @endif
                        {{-- customer only--}}
                      @elseif (Auth::user()->status == 'client')
                        <a href="{{ route('currencies.show', $currency->id) }}" >
                            @if ($currency->change == '+')
                          <img style="width: 90px;" src="https://images.cryptocompare.com/sparkchart/SOL/USD/latest.png?ts=1631085600" alt="15308-200" border="0" />
                          @else
                          <img style="width: 90px;" src="https://images.cryptocompare.com/sparkchart/BTC/USD/latest.png?ts=1631085600" alt="15308-200" border="0" />
                          @endif
                        </a>
                        <td><a class="btn btn-sm btn-primary" href="{{ route('transactions.create', $currency->id) }}" role="button">To Buy</a></td>
                      @endif
                    </td>
                </tr>
      @endforeach
        </tbody>
      </table>
@endsection
