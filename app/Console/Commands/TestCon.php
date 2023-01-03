<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCon extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Command:testcon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        \DB::table('admin_config')->where('id',17)->update(['value'=>'just do it!'.rand(1,10)]);
    }
}
