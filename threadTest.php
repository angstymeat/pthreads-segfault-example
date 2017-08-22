#!/usr/bin/env zts-php
<?php
$script_path = __DIR__;
require_once $script_path . '/vendor/autoload.php';

$config = [
  'root' => $script_path,
];

$threads = [];
$threads[] = new Test\MainThread("Main", $config);

$running = 0;
foreach ($threads as $thread) {
  $thread->start(PTHREADS_INHERIT_NONE);
  $running++;
}

do {
  foreach ($threads as $thread) {
    if (!$thread->isRunning() && !$thread->isJoined()) {
      $thread->join();
      $running--;
    }
  }
}
while ($running > 0);

