<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Models\API;
use Closure;
use Illuminate\Http\Request;

class CalculateBalance
{

    protected $api_ids;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { // Init
        $this->api_ids = [];
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->status == 'client') {
            $api = new API;

            $currencies = Auth::user()
                ->transactions
                ->where('sold', 0)
                ->groupBy('currency_id')
                ->map(function ($row) {
                        $this->api_ids[] = $row->first()->currency->api_id;
                        return [
                            'currency' => $row->first()->currency,
                            // Calculate the total of this currency
                            'quantity' => $row->sum('quantity')
                        ];
                    });

            if ($currencies->isNotEmpty()) {
                // Get data
                $this->data = $api->getMultipleData(implode(',', $this->api_ids));
            }

            // Loop through currencies to add data from API
            $currencies = $currencies->map(function ($currency) {
                $api_id = $currency['currency']->api_id;
                $currency['current_rate'] = $this->data[$api_id]['current_rate'];
                return $currency;
            });

            $balance = 0;

            foreach ($currencies as $currency) {
                $balance += $currency['quantity'] * $currency['current_rate'];
            }

            session(['balance' => round($balance, 2)]);
        }

        return $next($request);
    }
}
