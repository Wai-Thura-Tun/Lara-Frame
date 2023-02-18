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
  }

}