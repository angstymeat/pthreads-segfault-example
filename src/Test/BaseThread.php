<?php

namespace Test;

class BaseThread extends \Thread {

  protected $name;
  protected $config;

  public function __construct(string $name, $config) {
    $this->name = $name;
    $this->config = $config;

    return $this;
  }

  public function testFunction() {
    $this->synchronized(function () {
      echo "{$this->name}: Sync\n";
    });
  }

}