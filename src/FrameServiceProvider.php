<?php
namespace Laravel\Frame;
use Illuminate\Support\ServiceProvider;
class FrameServiceProvider extends ServiceProvider{
  public function register() {

  }

  public function boot() {
    if($this->app->runningInConsole()) {
      $this->commands([

      ]);
    }
  }
}