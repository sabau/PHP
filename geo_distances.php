<?php
fscanf(STDIN, "%s", $LON);
fscanf(STDIN, "%s", $LAT);
fscanf(STDIN, "%d", $N);
$LON = floatval(str_replace(',', '.', str_replace('.', '', $LON)));
$LAT = floatval(str_replace(',', '.', str_replace('.', '', $LAT)));
$name = '';
$min_d = -1;
for ($i = 0; $i < $N; $i++) {
    $DEFIB = explode(';', stream_get_line(STDIN, 256 + 1, "\n"));
    $DEFIB[4] = floatval(str_replace(',', '.', str_replace('.', '', $DEFIB[4])));
    $DEFIB[5] = floatval(str_replace(',', '.', str_replace('.', '', $DEFIB[5])));
    $x = ($LON - $DEFIB[4]) * cos(($LON + $DEFIB[4])/2);
    $y = $LAT - $DEFIB[5];
    $d = 6371.0 * sqrt($x*$x + $y * $y);
    if ($min_d < 0 || $d < $min_d) {
        $name = $DEFIB[1];
        $min_d = $d;
    }
}

echo("$name\n");
