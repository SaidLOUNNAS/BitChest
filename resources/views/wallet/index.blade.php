@extends('layouts.layout')

@section('title', 'Wallet')
{{-- wallet --}}
@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Wallet</h1>
        </div>
    </div>
    <!-- show table of wallet -->
    <div class="row">
        <div class="col-12">
            @if ($currencies->isNotEmpty())
                <table class="datatable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Current price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($currencies as $currency)
                            <tr>
                                <td>{{ $currency['currency']->name }} <span style="color: #707A8A;">
                                    {{ $currency['currency']->api_id }} </span>
                                </td>
                                <td>{{ str_replace('.', ',', $currency['total_quantity']) }}</td>
                                <td class="d-flex align-items-center">
                                <span @if ($currency['change'] == '+') style="color: #58ee58;" @else style="color: #ff0f07;" @endif>
                                        {{ str_replace('.', ',', $currency['current_rate']) }} {{ config('currency')['symbol'] }}
                                  </span>
                                    </td>
                                @if ($currency['increase'] > 0)
                                    <td class="text-success">
                                @else
                                    <td class="text-danger">
                                @endif
                                    {{ str_replace('.', ',', $currency['increase']) }} {{ config('currency')['symbol'] }}</td>
                                <td><a class="btn btn-sm btn-primary" href="{{ route('transactions.sell', $currency['currency']->id) }}" role="button">Sell</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            <div class="col-12">
                <h1 class="text-center mb-4">You don't have cryptocurrency <i class="far fa-frown"></i></h1>
            </div>
                <div class="text-center">
                    Discover the world of cryptos
                    <a href="{{ route('currencies.index') }}"> <i class="fas fa-external-link-alt"></i></a>
                </div>
            @endif
        </div>
    </div>
@endsection
