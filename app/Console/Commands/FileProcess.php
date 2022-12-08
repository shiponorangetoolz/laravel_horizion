<?php

namespace App\Console\Commands;

use App\Http\Controllers\FileController;
use Illuminate\Console\Command;

class FileProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'file:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        FileController::index();
//        FileController::create();
        return Command::SUCCESS;
    }
}
