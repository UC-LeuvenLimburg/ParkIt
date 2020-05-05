<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteUnpayedLeases extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unpayedLeases:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes unpayed leases after 15 minutes';

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
     * @return mixed
     */
    public function handle()
    {
        return true;
    }
}
