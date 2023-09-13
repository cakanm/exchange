<?php

namespace App\Console\Commands;

use App\Http\Api\CurrencylayerApi;
use Illuminate\Console\Command;

class ImportExchangeRates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exchange:import-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import exchange rates from Currencylayer API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currencylayerApi = new CurrencylayerApi();
        $currencylayerApi->fetchExchangeRates();

        return 0;
    }
}
