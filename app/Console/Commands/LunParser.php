<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LunParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:lun';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parser Lun.ua';

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
        //
    }
}
