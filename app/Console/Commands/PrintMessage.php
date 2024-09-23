<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PrintMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'print:message';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Print a message';

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
        $this->info('This is a message printed every minute.');
        $this->info('hii shilpi, good morning');
        return 0;
    }
}
