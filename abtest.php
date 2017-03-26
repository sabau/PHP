<?php
require "DB.php";

$DB = new \interview\DB();
if ($DB->hasError()) {
    //log errors somewhere
    echo $DB->getError();
}else{
    $dbh = $DB->getDbh();
    $sth = $dbh->prepare('SELECT split_percent, design_url FROM exads_design');
    $sth->execute();
    $res = $sth->fetchAll();
    $total = 0;
    $keys = [];
    $redirect = [];
    foreach ($res as $design) {
        //let's say it's a weight instead of a percent, so we have more freedom of adding more rows in the future without modifying all the rows in the table
        $total += $design['split_percent'];
        $keys[] = $total;
        $redirect[$total] = $design['design_url'];
    }
    srand((double)microtime()*1000000);
    $nr = rand(1,$total);
    $idx = 0;
    for ($i = 0; $i < count($keys); $i++){
        if ($keys[$i] >= $nr) {
            $idx = $i;
            break;
        }
    }
    header("Location:".$redirect[$keys[$idx]]);
}


