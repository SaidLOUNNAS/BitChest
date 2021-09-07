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
