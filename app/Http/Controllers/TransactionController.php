<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\API;

class TransactionController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        if (Str::contains($request->path(), 'create')) {
            view()->composer('layouts.layout', function ($view) {
                $view->with('section', 'currencies');
            });
        } else {
            view()->composer('layouts.layout', function ($view) {
                $view->with('section', 'wallet');
            });
        }

        date_default_timezone_set('Europe/Paris');    }

    /**
     * Display the user's transactions (all of them or by currency).
     */
    public function index(Currency $currency = null)
    {  // If a currency is specified :
        $transactions = $currency
             // Get the uder's transactions corresponding to this currency
            ? Auth::user()->transactions()->where('currency_id', $currency->id)->get()
            // Else, get all of their transactions
            : Auth::user()->transactions;

        // Format a few fields of the transactions
        $transactions = $transactions->map(function ($transaction) {

            $transaction->quantity = round($transaction->quantity, 4);

            $transaction->purchase_price = round($transaction->purchase_price, 4);

            $transaction->selling_price = round($transaction->selling_price, 4);

            return $transaction;
        });

        return view('transactions.index', ['transactions' => $transactions, 'currency' => $currency]);
    }

    /**
     * Display the user's transactions corresponding to a currency in order to sell them.
     */
    public function sell(Currency $currency)
   { //    user logged
        $transactions = Auth::user()
            ->transactions()
            ->where([
                // filter
                'sold' => false,
                // Corresponding to the specified currency
                'currency_id' => $currency->id
            ])
            ->get();

        // Format a few fields of the transactions
        $transactions = $transactions->map(function ($transaction) {
            // Round figures to make them more readable
            $transaction->purchase_price = round($transaction->purchase_price, 4);
            return $transaction;
        });

        $title = 'Sales of ' . $currency->name;

        return view('transactions.sell', ['transactions' => $transactions, 'title' => $title]);
    }

    /**
     * Show the form for buying a currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Currency $currency)
    {
        $title = 'Buy ' . $currency->name;

        return view('transactions.create', ['title' => $title, 'currency' => $currency]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, API $api)
    {   // Get form inputs data
        $attributes = $request->all();
         // Get user's id to insert it
        $attributes['user_id'] = Auth::id();
        // Get current datetime
        $attributes['purchase_date'] = Carbon::now()->toDateTimeString();
        // Get current rate
        $attributes['purchase_price'] = $api->getPrice($attributes['currency_api_id']);

        // Calculate quantity or amount depending on which buying option the user chose
        if ($attributes['buying_option'] == 'amountBuyingInput') {
            $attributes['quantity'] = $attributes['amount'] / $attributes['purchase_price'];
        } elseif ($attributes['buying_option'] == 'quantityBuyingInput') {
            $attributes['amount'] = $attributes['quantity'] * $attributes['purchase_price'];
        }
        // Create transaction in Database
        $transaction = Transaction::create($attributes);

        return redirect()
            ->route('wallet')
            ->with('message', 'The transaction was successful. Your bought : ' . round($transaction->quantity, 6) . ' ' . $transaction->currency->name . ' for an amount of ' . $transaction->amount . ' ' . config('currency')['symbol'] . '.');
    }

    /**
     * Sell one specified transaction or all those of a currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Currency $currency, Transaction $transaction = null, Request $request, API $api)
    {
        if ($transaction) {
            $transaction->sold = 1;
            $transaction->selling_amount = round($request->selling_amount, 2);
            $transaction->selling_price = $request->selling_price;
            $transaction->selling_date = Carbon::now();

            $transaction->save();

            return redirect()
                ->route('wallet')
                ->with('message', 'The transaction was successful. Your sold : ' . floatval($transaction->quantity) . ' ' . $currency->name . ' for an amount of ' . round($request->selling_amount, 2) . ' ' . config('currency')['symbol'] . '.');
        } else {
            $quantity_total = 0;
            $selling_amount_total = 0;

            $transactions = Transaction::where([
                'currency_id' => $currency->id,
                'user_id' => Auth::id()
            ]);

            $transactions->update([
                'sold' => 1,
                'selling_price' => $api->getPrice($currency->api_id),
                'selling_date' => Carbon::now()
            ]);

            foreach ($transactions->get() as $transaction) {
                $transaction->selling_amount = $transaction->selling_price * $transaction->quantity;
                $transaction->save();

                $quantity_total += $transaction->quantity;
                $selling_amount_total += $transaction->selling_amount;
            }

            return redirect()
                ->route('wallet')
                ->with('message', 'The transaction was successful. Your sold : ' . floatval($quantity_total) . ' ' . $currency->name . ' for an amount of ' . round($selling_amount_total, 2) . ' ' . config('currency')['symbol'] . '.');
        }
    }
}
