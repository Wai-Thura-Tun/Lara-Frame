<?php

namespace Waithuratun\LaraFrame;

use Illuminate\Console\Command;

class ProjectFrameCommand extends Command
{
    private $dirArray = [
        "app/Contracts/Dao",
        "app/Contracts/Services",
        "app/Dao",
        "app/Services",
    ];

    const CS = "ServiceInterface.php";
    const CD = "DaoInterface.php";
    const S = "Service.php";
    const D = "Dao.php";
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:frame {name*}';

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
        $arguments = $this->argument('name');
        $bar = $this->output->createProgressBar(count($arguments));
        $bar->start();
        foreach($arguments as $value) {
            $this->makeFrame(ucfirst($value));
            $bar->advance();
        }
        $bar->finish();
        return 0;
    }

    public function makeFrame(string $name) {
        $this->makeDir();
        $this->makeInterfaceFile($name);
        $this->makeFrameFile($name);
    }

    public function makeDir() {
        foreach($this->dirArray as $value) {
            if(!is_dir($value)) {
                mkdir($value,0777,true);
            }
        }
    }

    public function makeFrameFile(string $name) {
        $daoClass = $name . self::D;
        $serviceClass = $name . self::S;
        $daoPath = $this->dirArray[2] . "/" . $daoClass;
        $servicePath = $this->dirArray[3] . "/" . $serviceClass;
        $daoContent = $this->createContent($daoPath, $daoClass, "class");
        $serviceContent = $this->createContent($servicePath,$serviceClass,"class");
        $this->createFile($daoPath,$daoContent);
        $this->createFile($servicePath, $serviceContent);
    }

    public function makeInterfaceFile(string $name) {
        $daoClass = $name . self::CD;
        $serviceClass = $name . self::CS;
        $daoPath = $this->dirArray[0]."/".$daoClass;
        $servicePath = $this->dirArray[1]."/".$serviceClass;
        $daoContent = $this->createContent($daoPath,$daoClass,"interface");
        $serviceContent = $this->createContent($servicePath,$serviceClass,"interface");
        $this->createFile($daoPath,$daoContent);
        $this->createFile($servicePath, $serviceContent);
    }

    public function createFile(string $path, string $content) {
        if(!file_exists($path)) {
            $newFile = fopen($path,'w');
            fwrite($newFile,$content);
            fclose($newFile);
            $this->info($path." has been created");
        }
    }
    public function createContent(string $namespace,string $class,string $type) {
        $filterNS = str_replace("/","\\",ucfirst(substr($namespace,0,-4)));
        $this->info($filterNS);
        $filterClass = ucfirst(substr($class,0,-4));
        return "<?php\n\tnamespace ".$filterNS.";\n\t".$type." ".$filterClass." {\n\n\t}";
    }
}
