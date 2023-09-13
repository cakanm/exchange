<?php


namespace App\Http\Api;


use App\Models\Currency;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CurrencylayerApi
{
    private $apiUrl;
    private $apiKey;
    private $sourceCurrency = 'USD'; // TODO: move to config?

    public function __construct()
    {
        $this->apiUrl = config('services.currencylayer.api_url');
        $this->apiKey = config('services.currencylayer.api_key');
    }

    public function fetchExchangeRates()
    {
        $currencies = Currency::where('is_active', '=', true)->get()->toArray();

        $cur = array_column($currencies, 'code');
        $cur = Arr::flatten($cur);

        $url = $this->apiUrl . '?access_key=' . $this->apiKey . '&source=' . $this->sourceCurrency . '&format=1';
        $url .= '&currencies=' . implode(',', $cur);

        $data = Http::get($url)->throw()->json();

        foreach ($currencies as $currency) {
            if (isset($data['quotes'][$this->sourceCurrency . $currency['code']])) {
                Currency::where('id', '=', $currency['id'])
                    ->update([
                        'rate' => $data['quotes'][$this->sourceCurrency . $currency['code']],
                    ]);
            }
        }
    }
}
