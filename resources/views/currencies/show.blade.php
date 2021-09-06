@extends('layouts.layout')
@section('title', $title)
@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Markets {{ $currency->name }}</h1>
            <div class="card-body" style="float: right;">
                  <!-- button to buy -->
                  <div class="form-group">
                      <a href="{{ route('transactions.create', $currency->id) }}" class="btn btn-primary" style="border-radius: 0.35rem;" >To Buy</a>
                  </div>
              </div>
        </div>
    </div>
{{-- display chart plugin js--}}
<div class="row">
    <div class="col-12">
        <canvas id="marketsChart"></canvas>
    </div>
</div>
@endsection

@section('JS')
<script>
    new Chart($('#marketsChart'), {
        type: 'line',
        data: {
            labels: [
                @foreach ($days as $day)
                    @if ($loop->first || $loop->iteration % 5 === 0)
                        '{{ $day['date'] }}',
                    @else
                        '',
                    @endif
                @endforeach
            ],
            datasets: [{
                label: '{{ $currency->name }}',
                data: [
                    @foreach ($days as $day)
                        '{{ $day['rate'] }}',
                    @endforeach
                ],
                borderColor: '#4e73df',
                backgroundColor: '#b7eff357',
                lineTension: 0.1
            }]
        }
    });
</script>
@endsection
