<?php

namespace Waithuratun\LaraFrame;
use Illuminate\Support\ServiceProvider;
class ProjectFrameServiceProvider extends ServiceProvider {
  public function register() {

  }

  public function boot() {
    if($this->app->runningInConsole()) {
      $this->commands([
        ProjectFrameCommand::class
      ]);
    }
    $this->bindFile("Dao","Dao");
    $this->bindFile("Service","Services");
  }

  private function bindFile(string $type,string $container) {
    $interfacefiles = glob("app/".$container."/*".$type.".php");
    $files = glob("app/Contracts".$container."/*".$type.".php");
    if($interfacefiles && $files) {
      foreach($files as $key => $value) {
        $interfaceFile = "App\\Contracts\\" . $container . "\\".substr($value,0,-4);
        $classFile = "App\\".$container."\\".substr($interfaceFile[$key],0,-4);
        if(!$this->app->bound($interfaceFile)) {
          $this->app->bind($interfaceFile,$classFile);
        }
      }
    }
  }
}