<?php

namespace App\Console\Commands;


use App\Jobs\ParserJob;
use Illuminate\Console\Command;

class Parse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse RSS';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ParserJob::dispatch();
    }
}
