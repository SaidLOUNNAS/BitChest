@extends('layouts.layout')

@section('title', $title)

@section('content')

{{-- create transaction --}}
<div class="container" style="margin-bottom: 10%;">
    <div class="row">
      <div class="col-sm-4"> </div>
  <div class="col-md-4">
  <h1 class="text-center">Buy {{ $currency->name }}</h1>
  <br/>
     <div class="alert alert-info" role="alert">
            Markets {{ $currency->name }} :
        <span class="font-weight-bold">
            <span id="currentRate"></span> {{ config('currency')['symbol'] }}
        </span>
        <button type="button" id="refreshRate" class="btn btn-info text-white ml-2" data-toggle="tooltip" data-placement="top" title="Refresh current Price">
            <i class="fas fa-sync"></i>
        </button>
  </div>
  <div class="col-sm-12">
    <div class="tab-content">
        <form id="buyingForm" action="{{ route('transactions.store') }}" method="POST">
            @csrf
      <div class="form-group">
        <label for="buying_option">Choose a purchase method :</label>
        <div class="form-check">
            <input class="form-check-input buying_options" type="radio" name="buying_option" id="buy_by_amount" value="amountBuyingInput" required>
            <label class="form-check-label" for="buy_by_amount">Invest</label>
        </div>
        <div class="form-check">
            <input class="form-check-input buying_options" type="radio" name="buying_option" id="buy_by_quantity" value="quantityBuyingInput" required>
            <label class="form-check-label" for="buy_by_quantity">To buy</label>
        </div>
    </div>
    <div class="form-group buying-inputs" id="amountBuyingInput">
        <label for="amount">Amount to invest</label>
        <input type="number" class="form-control" id="amount" name="amount" max="999999" aria-describedby="amountTotal">
        <small class="form-text text-muted">
            Total acquired :
            <span id="quantityTotal" class="font-weight-bold"></span>
        </small>
    </div>
    <div class="form-group buying-inputs" id="quantityBuyingInput">
        <label for="quantity">Quantity to buy</label>
        <input type="number" class="form-control" id="quantity" name="quantity" step="0.001" aria-describedby="quantityTotal">
        <small class="form-text text-muted">
            total :
            <span class="font-weight-bold">
                <span id="amountTotal"></span> {{ config('currency')['symbol'] }}
            </span>
        </small>
    </div>
     <input type="hidden" name="currency_id" value="{{ $currency->id }}">
     <input type="hidden" name="currency_api_id" value="{{ $currency->api_id }}">
     <button type="submit" class="btn btn-primary">submit</button>
  </form>
  <br/>
  <a href="{{ route('currencies.index') }}" class="pull-right btn btn-block btn-outline-secondary" >Cancel</a>
      </div>
</div>
</div>
</div>
</div>

@if (Auth::user()->status == 'client')
<style>#mainContainer #content {
    margin: 10rem;
}</style>
@endif
@endsection

@section('JS')
    <script>
        let currentRate;
        const refreshIcon = $('#refreshRate .fa-sync');
        function calcAndDisplayQuantity() {
            const quantityTotal = $('#amount').val() / currentRate;
            $('#quantityTotal').text(quantityTotal.toFixed(6));
        }

        function calcAndDisplayAmount() {
            const amountTotal = $('#quantity').val() * currentRate;
            $('#amountTotal').text(amountTotal.toFixed(2));
        }

        function getAndDisplayCurrentRate() {
            // Get current rate from the API
            $.get({
                url: '{{ route('api.get-price', $currency->api_id) }}',
                success: function(data) {
                    currentRate = data;

                    // Refresh payment infos
                    calcAndDisplayQuantity();
                    calcAndDisplayAmount();
                    // Refresh rate display
                    $('#currentRate').text(currentRate);

                    // Calculate max value for quantity input
                    const qtyMax = 999999 / currentRate;
                    $('#quantity').attr('max', qtyMax);

                }
            })
            .fail(function(error) {
                console.log(error);
            });
        }

        // On page load
        $(function() {
            getAndDisplayCurrentRate();

            // refresh button
            $('#refreshRate').click(function() {
                refreshIcon.addClass('fa-spin');
                getAndDisplayCurrentRate();
            });
         //  type in an input
           $('input[type="number"]').on('input', function() {
                if ($(this).is('#amount')) {
                    calcAndDisplayQuantity();
                } else if ($(this).is('#quantity')) {
                    calcAndDisplayAmount();
                }
            });
            // Display and hide inputs
            $('.buying_options').change(function() {
                const input = $(this).val();
                $(`.buying-inputs#${input}`).show();
                $(`.buying-inputs#${input} input[type="number"]`).attr('required', 'required');
                $(`.buying-inputs:not(#${input})`).hide();
                $(`.buying-inputs:not(#${input}) input[type="number"]`).removeAttr('required');
            });

              // confirm purchase
               $("#buyingForm").submit(function () {
                return confirm("confirm");
            });

        });
    </script>
@endsection
