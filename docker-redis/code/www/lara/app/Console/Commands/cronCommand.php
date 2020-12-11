<?php

namespace App\Console\Commands;

use App\Jobs\runImport;
use App\Models\User;
use Illuminate\Console\Command;
use App\Classes\StartImport;

class cronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cron:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for cron';

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
        //$StartImport=new StartImport();
        //$StartImport->start();
        $job = (new runImport());
        dispatch($job);
    }
}
