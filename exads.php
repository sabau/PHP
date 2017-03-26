<?php
namespace interview;


class exads
{
    /**
     * @param int $i
     */
    function fizzBuzz(int $i = 100){
        for ($j = 1; $j < $i; $j++) {
            $print = $j;
            if ($j % 3 == 0){
                $print = 'Fizz';
            }
            if ($j % 5 == 0){
                $print = ($print == $j ? '' : $print ) . 'Buzz';
            }
            echo $print . PHP_EOL;
        }
    }

    /**
     * @param int $length
     * @return array
     */
    function generateRandomArray(int $length = 500): array {
        $arr = [];
        for ($i = 1; $i <= $length; $i ++){
            $arr[] = $i;
        }
        shuffle($arr);
        return $arr;
    }

    /**
     * @param array $array
     * @return array
     */
    function removeItem(array $array): array {
        $key = array_rand($array, 1);
        unset($array[$key]);
        return $array;
    }

    /**
     * This method find the missing element from an array of integers
     * where all elements goes from 1 to N and only 1 item is missing
     * @param array $a
     * @return int
     */
    function getMissingNumber(array $a = []): int{
        $sum = 0;
        //we sum all the elemnt in this array
        foreach ($a as $v) {
            $sum += $v;
        }
        $n = count($a) + 1;
        //we know that the sum from 1 to N is N * (N+1) / 2
        $expected_sum = $n * ($n + 1) / 2;
        //so the missing item will be the difference between the real sum and the expected sum
        return $expected_sum - $sum;
    }

    /**
     * @param \DateTime|null $date
     * @return array
     */
    function getDrawDates(\DateTime $date = null): array {
        $dates = [$this->drawDate(new \DateTime('now'))];
        if (isset($date))
            $dates[] = $this->drawDate($date);
        return $dates;
    }

    /**
     * @param \DateTime $date
     * @return \DateTime
     */
    private function drawDate(\DateTime $date): \DateTime {
        $date->setTimezone(new \DateTimeZone('Europe/Dublin'));
        $dow = $date->format('w');
        if (($dow == 3 || $dow == 6)) {
            if ((int)$date->format('H') < 20) {
                $date->setTime(20, 0, 0);
                return $date;
            }else{
                //wednesday or saturday from 20.00.00 to 23.59.59 case,
                // we have to skip to the next day
                $date->add(new \DateInterval(sprintf("P%sD",1)));
                $dow = $date->format('w');
            }
        }

        if ($dow < 3) {
            $days = 3 - $dow;
            $date->add(new \DateInterval(sprintf("P%sD",$days)));
            $date->setTime(20, 0, 0);
            return $date;
        }

        $days = 6 - $dow;
        $date->add(new \DateInterval(sprintf("P%sD",$days)));
        $date->setTime(20, 0, 0);
        return $date;
    }



}
