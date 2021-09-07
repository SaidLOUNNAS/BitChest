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
              <th>Name</th>
              <th>Last prize</th>
              <th>Markets</th>
            </tr>
          </thead>
          @foreach ($currencies as $currency)
          <tr>
              <td>{{ $currency->name }} <span style="color: #707A8A;">
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
                          <i style="color: #58ee58" class="fas fa-arrow-up"></i>
                          @else
                          <i style="color: red" class="fas fa-arrow-down"></i>
                          @endif
                        {{-- customer only--}}
                      @elseif (Auth::user()->status == 'client')
                           <a href="{{ route('currencies.show', $currency->id) }}" role="button">
                        <img style="width: 30px; height:30px" src="https://i.ibb.co/74smnQW/15308-200.png" alt="15308-200" border="0" />
                    </a>
                        <td><a class="btn btn-sm btn-primary" href="{{ route('transactions.create', $currency->id) }}" role="button">To Buy</a></td>
                      @endif
                    </td>
                </tr>
      @endforeach
        </tbody>
      </table>
@endsection
