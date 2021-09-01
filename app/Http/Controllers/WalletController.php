<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\API;

class WalletController extends Controller
{
    protected $data;
    protected $api_ids;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->composer('layouts.layout', function ($view) {
            $view->with('section', 'wallet');
        });
        $this->api_ids = [];
    }

    /**
     * Display the user's wallet.
     */
    public function index(API $api)
    {    // Get users transaction
        $currencies = Auth::user()
            ->transactions
            ->where('sold', 0)
            ->groupBy('currency_id')
            ->map(function ($row) {
                   // Fill API IDs array for API call
                    $this->api_ids[] = $row->first()->currency->api_id;
                    return [
                        'currency'  => $row->first()->currency,
                        // Calculate the total of this currency
                        'total_quantity'  => $row->sum('quantity'),
                        // Calculate the amount
                        'total_amount'   => $row->sum('amount')
                    ];
                });

        if ($currencies->isNotEmpty()) {
            // Get data
            $this->data = $api->getMultipleData(implode(',', $this->api_ids));

            // Loop through currencies
            $currencies = $currencies->map(function ($currency) {
                $api_id = $currency['currency']->api_id;

                $currency['current_rate'] = $this->data[$api_id]['current_rate'];
                $currency['change'] = $this->data[$api_id]['change'];
                $currency['increase'] = round($currency['current_rate'] * $currency['total_quantity'] - $currency['total_amount'], 2);

                return $currency;
            });
        }

        return view('wallet.index', ['currencies' => $currencies]);
    }
}
