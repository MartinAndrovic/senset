<?php

namespace App\Console\Commands;

use App\Http\Controllers\CustomersController;
use Illuminate\Console\Command;

class getCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new CustomersController();
        $controller->index();
    }
}
