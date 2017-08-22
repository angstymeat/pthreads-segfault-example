<?php

namespace Test;

class SubThread extends BaseThread {

  public function run() {
    require_once $this->config['root'] . '/vendor/autoload.php';

    echo "SubThread Start\n";

    $count = 0;
    $this->testFunction();
    do {
      $count++;
      usleep(5000);
    }
    while ($count < 1000);
    echo "SubThread End\n";
  }

}