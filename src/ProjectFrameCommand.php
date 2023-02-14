<?php

namespace Waithuratun\LaraFrame;

use Illuminate\Console\Command;

class ProjectFrameCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:frame {name*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A frame for laravel project';

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
        $arguments = $this->arguments();
        $this->info("Love you");
        return 0;
    }
}
