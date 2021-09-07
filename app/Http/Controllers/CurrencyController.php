<?php

namespace App\Http\Controllers;
use App\Models\Currency;
use App\Models\API;

class CurrencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        view()->composer('layouts.layout', function ($view) {
            $view->with('section', 'currencies');
        });
    }

    /**
     * Display the currencies list
     */
    public function index(API $api)
    {
        // Get cryptocurrencies
        $currencies = Currency::all();
        // Get data
        $data = $api->getMultipleData($currencies->pluck('api_id')->implode(','));
        // Loop through all cryptocurrencies
        foreach ($currencies as $currency) {
            $currency_data = $data[$currency->api_id];
            $currency->current_rate = $currency_data['current_rate'];
            $currency->change = $currency_data['change'];
        }

        return view('currencies.index', ['currencies' => $currencies]);
    }

    /**
     * Display a currency's.
     */
    public function show(Currency $currency, API $api)
    {
        $days = $api->getHistory($currency->api_id);
        return view('currencies.show', [
            'currency' => $currency,
            'days' => $days
        ]);
    }
}
