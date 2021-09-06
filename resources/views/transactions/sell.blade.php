@extends('layouts.layout')

@section('title', $title)

@section('content')
{{-- tab sell --}}
<div class="row">
    <div class="col-12">
        <h1 class="text-center">Wallet</h1>
    </div>
</div>
<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <form class="selling-form" action="{{ route('transactions.update', $transactions->first()->currency->id) }}" method="POST">
            @method('PATCH')
            @csrf
            <input class="btn btn-bloc btn-outline-secondary mb-1"  role="button" type="submit" value="Sell all">
      </div>
        </form>
    </li>
</ul>
    <div class="row">
        <div class="col-12">
            <table class="datatable custom">
                <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Purchase price</th>
                        <th>Total executed</th>
                        <th>Total of sell</th>
                        <th>executed</th>
                        <th>Date</th>
                        <th data-orderable="false"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="transaction">
                            <td class="quantity">{{ $transaction->quantity + 0 }}</td>
                            <td>{{ str_replace('.', ',', $transaction->purchase_price) }} {{ config('currency')['symbol'] }}</td>
                            <td class="amount">{{ str_replace('.', ',', $transaction->amount) }} {{ config('currency')['symbol'] }}</td>
                            <td><span class="selling-amount"></span> {{ config('currency')['symbol'] }}</td>
                            <td class="increase-col"><span class="increase"></span> {{ config('currency')['symbol'] }}</td>
                            <td>{{ $transaction->purchase_date }}</td>
                            <td>
                                <form class="selling-form" action="{{ route('transactions.update', [$transactions->first()->currency->id, $transaction->id]) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    <input type="hidden" name="selling_amount" value="">
                                    <input type="hidden" name="selling_price" value="">
                                    <input class="btn btn-sm btn-primary" role="button" type="submit" value="Sell">
                                        <button type="button" id="refreshRate" class="btn btn-info text-white ml-2" data-toggle="tooltip" data-placement="top" title="Refresh current Price">
                                            <i class="fas fa-sync"></i>
                                        </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('JS')
    <script>
        let currentRate;
        const refreshIcon = $('#refreshRate .fa-sync');
        const transactions = $('.transaction');

        function refreshTransactionInfo() {
            // Loop through transactions to make calculations for all of them
            $.each(transactions, function (i, transaction) {
                const sellingAmount = $(transaction).find('.quantity').text() * currentRate;
                const increase = sellingAmount - parseInt($(transaction).find('.amount').text());

                $(transaction).find('.selling-amount').text(sellingAmount.toFixed(2));
                $(transaction).find('.increase').text(increase.toFixed(2));

                if (increase > 0) {
                    $(transaction).find('.increase-col').addClass('text-success');
                } else {
                    $(transaction).find('.increase-col').addClass('text-danger');
                }

                // Set hidden inputs values for having these values when we sell
                $('input[name="selling_amount"]').val(sellingAmount);
                $('input[name="selling_price"]').val(currentRate);
            });
        }
        $(function() {
            $('.datatable.custom').DataTable({
                order: [[4, "desc"]]});

            getAndDisplayCurrentRate();

            // On click on refresh button
            $('#refreshRate').click(function() {
                refreshIcon.addClass('fa-spin');
                getAndDisplayCurrentRate();
            });

            // Confirm
            $(".selling-form").submit(function () {
                return confirm("Confim");
            });
        });

        function getAndDisplayCurrentRate() {
            // Get current rate from the API
            $.get({
                url: '{{ route('api.get-price', $transactions->first()->currency->api_id) }}',
                success: function(data) {
                    currentRate = data;
                     // Refresh payment infos
                    refreshTransactionInfo();
                    $('#currentRate').text(currentRate);
                    // Stop icon spinning
                    refreshIcon.removeClass('fa-spin');
                }
            })
            .fail(function(error) {
                console.log(error);
            });
        }


    </script>
@endsection
