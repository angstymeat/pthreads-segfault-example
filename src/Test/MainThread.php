<?php

namespace Test;

class MainThread extends BaseThread {

  public function run() {
    require_once $this->config['root'] . '/vendor/autoload.php';

    echo "Main Thread Start\n";

    $threads = [];
    $threads[] = new SubThread("SubThread", $this->config);
    $running = 0;
    foreach ($threads as $thread) {
      $thread->start(PTHREADS_INHERIT_NONE);
      $running++;
    }

    $this->testFunction();
    do {
      foreach ($threads as $thread) {
        if (!$thread->isRunning() && !$thread->isJoined()) {
          echo "{$thread->name} waiting to join\n";
          $thread->join();
          echo "{$thread->name} joined\n";
          $running--;
        }
      }
    }
    while ($running > 0);
    echo "Main Thread End\n";
  }

}