<?php

namespace Waithuratun\LaraFrame;

use Illuminate\Console\Command;

class ProjectFrameCommand extends Command
{
    const C_DAO = "app/Contracts/Dao";
    const SERVICE = "app/Services";
    const C_SERVICE = "app/Contracts/Services";
    const DAO = "app/Dao";
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
        $bar = $this->output->createProgressBar(count($arguments));
        $bar->start();
        foreach($arguments as $value) {
            $this->makeFrame($value);
            $bar->advance();
        }
        $bar->finish();
        return 0;
    }

    public function makeFrame(string $name) {
        $this->makeDir();
    }

    public function makeDir() {
        mkdir(self::C_DAO);
        mkdir(self::C_SERVICE);
        mkdir(self::SERVICE);
        mkdir(self::DAO);
    }
}
