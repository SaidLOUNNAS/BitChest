@extends('layouts.layout')
@section('title', 'Transactions')
@section('JS')
    <script>
        $(function() {
            $('.datatable.custom').DataTable({
                order: [[5, "desc"]],});
        });
    </script>
@endsection
@section('content')
{{-- title --}}
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Transactions</h1>
            <div class="d-flex justify-content-center my-4">
                @if ($currency)
                    <a class="btn btn-sm btn-primary ml-3" href="{{ route('transactions.sell', $currency->id) }}" role="button">Sell</a>
                @endif
            </div>
        </div>
    </div>
    {{-- show all transactions --}}
    <div class="row">
        <div class="col-12">
           <div class="tab-content mt-4">
                <div class="tab-pane active" id="all" role="tabpanel" aria-labelledby="all-tab">
                    <table class="datatable custom">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Pair</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th data-orderable="false">Statut</th>
                                <th>sold</th>
                                <th>Sale amount</th>
                                <th>Executed</th>
                                <th>date of sale</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->purchase_date }}</td>
                                    <td>{{ $transaction->currency->api_id }}/{{ config('currency')['symbol'] }}</td>
                                    <td>{{ $transaction->quantity }}</td>
                                    <td>{{ str_replace('.', ',', $transaction->purchase_price) }}{{ config('currency')['symbol'] }}</td>
                                    <td>{{ str_replace('.', ',', $transaction->amount) }}{{ config('currency')['symbol'] }}</td>
                                    @if ($transaction->sold)
                                        <td><span class="badge badge-success">sold</span></td>
                                        <td>{{ str_replace('.', ',', $transaction->selling_price) }} {{ config('currency')['symbol'] }}</td>
                                        <td>{{ str_replace('.', ',', $transaction->selling_amount) }} {{ config('currency')['symbol'] }}</td>
                                        @if ($transaction->selling_amount - $transaction->amount >= 0)
                                            <td class="text-success">
                                                {{ str_replace('.', ',', $transaction->selling_amount - $transaction->amount) }} {{ config('currency')['symbol'] }}
                                            </td>
                                        @else
                                            <td class="text-danger">
                                                {{ str_replace('.', ',', $transaction->selling_amount - $transaction->amount) }} {{ config('currency')['symbol'] }}
                                            </td>
                                        @endif
                                        <td>{{ $transaction->selling_date }}</td>
                                    @else
                                        <td><span class="badge badge-danger">Not sold</span></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
@endsection


