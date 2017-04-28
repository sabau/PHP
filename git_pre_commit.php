#!/usr/bin/env php

<?php
$project = basename(getcwd());

exec('vendor/bin/phpunit', $output, $returnCode);

if ($returnCode !== 0) {
  $summary = array_pop($output);
  printf("Tests %s failed: ", $project);
  printf("( %s ) %s%2\$s", $summary, PHP_EOL);
  printf("ABORT COMMIT!\n");
  exit(1);
}

exit(0);
