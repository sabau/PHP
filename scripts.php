<?php
require "DB.php";
require "exads.php";

$exads = new \interview\exads();

//QUESTION 1
$exads->fizzBuzz();

//QUESTION 2
//get the first 500 number in an array shuffled
$arr = $exads->generateRandomArray();

//get a random key from our array and unset it
$arr = $exads->removeItem($arr);
echo sprintf("Item missing: %d\n", $exads->getMissingNumber($arr));


//QUESTION 3
$DB = new \interview\DB();
if ($DB->hasError()) {
    //log errors somewhere
    echo $DB->getError();
}else{
    $dbh = $DB->getDbh();
    $sth = $dbh->prepare('SELECT name, age, job_title FROM exads_test');
    $sth->execute();
    $res = $sth->fetchAll();
    //Show them somehow

    $dbh->beginTransaction();
    try {
        $stmt = $dbh->prepare('INSERT INTO exads_test (name, age, job_title) VALUES (:name, :age, :job_title)');

        $name = 'Karoly';
        $age = 32;
        $job_title = 'Software Engineer';


        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':age', $age, PDO::PARAM_INT);
        $stmt->bindValue(':job_title', $job_title, PDO::PARAM_STR);
        $stmt->execute();

        // Short way, usually I prefer to avoid this one.
        // In my experience I found little risks about data types,
        // more on performances due to data type cast that MySQL have to perform
        //$stmt->execute( ['name' => $name, 'age' => $age, 'job_title' => $job_title] );
        $dbh->commit();
    }catch (PDOException $e){
        //log errors somewhere
        echo $e->getMessage();
        $dbh->rollBack();
    }
}

//QUESTION 4
$dates = $exads->getDrawDates();
var_dump($dates);
$date = new DateTime();
//extraction day, on
$date->setDate(2017, 3, 29);
$date->setTime(20, 30);
//we can make it if we are in Rome
$date->setTimezone(new DateTimeZone('Europe/Rome'));
$dates = $exads->getDrawDates($date);
var_dump($dates);

