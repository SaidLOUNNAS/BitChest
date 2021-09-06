<?php

namespace App\Models;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class API extends Model
{
    protected $client;
    protected $conversion_currency;

    /**
     * Instantiate a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Initialize Guzzle for API calls
        $this->client = new Client([
            'base_uri' => 'https://min-api.cryptocompare.com'
        ]);
       // Real currency used
        $this->conversion_currency = config('currency')['api_id'];
    }

    /**
     * Get a single cryptocurrency's current price.
     */
    public function getPrice($fsym)
    {
        $conversion_currency = $this->conversion_currency;

        $response = $this->client->get('data/price', [
            'query' => [
                // Cryptocurrency whose price we want
                'fsym' => $fsym,
                // Real currency to convert the price
                'tsyms' => $conversion_currency
            ]
        ]);
        // Get data
        $price = json_decode($response->getBody())->$conversion_currency;

        return $price;
    }

    /**
     * Get several cryptocurrencies' data: current price + change on the last 24h
     */
    public function getMultipleData($fsyms)
    {
        $conversion_currency = $this->conversion_currency;
        $filtered_data = [];

        $response = $this->client->get('data/pricemultifull', [
            'query' => [
                // Cryptocurrencies whose data we want
                'fsyms' => $fsyms,
                // Real currency to convert the price to
                'tsyms' => $this->conversion_currency
            ]
        ]);

        $data = json_decode($response->getBody())->RAW;

        // Filter API data
        foreach ($data as $api_id => $currency) {
            $filtered_data[$api_id] = [
                // Get current price
                'current_rate' => $currency->$conversion_currency->PRICE,
                // Get the evolution on the last 24h : positive or negative
                'change' => $currency->$conversion_currency->CHANGE24HOUR > 0 ? '+' : '-'
            ];
        }

        return $filtered_data;
    }

    /**
     * Get a single cryptocurrency's price history
     */
    public function getHistory($fsym, $limit = 29)
    {
        $filtered_data = [];

        $response = $this->client->get('data/v2/histoday', [
            'query' => [
                // Cryptocurrency whose data we want
                'fsym'  => $fsym,
                // Real currency to convert the price to
                'tsym'  => $this->conversion_currency,
                // Number of past days to retrieve
                'limit' => $limit
            ]
        ]);
        // Get data
        $data = json_decode($response->getBody())->Data->Data;

        // Filter API data to keep only relevent data
        foreach ($data as $index => $day) {
            $date = new Carbon($day->time);
             // Format date
            $filtered_data[$index]['date'] = $date->format('d/m');
            // Price at the date
            $filtered_data[$index]['rate'] = $day->open;
        }

        return $filtered_data;
    }
}
