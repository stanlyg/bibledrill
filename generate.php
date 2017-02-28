<?php
// This file should not produce any output to stdout.


function generate_data_file ($seed, $cycle, $trans, $qcount, $ccount, $bcount, $kcount) {


  srand($seed);
  $drillid = $cycle[0] . $trans[0] . $seed;

  if ( ($qcount != 6) or ($ccount != 6) or ($bcount != 6) or ($kcount != 6) ) {
    $drillid .= '-'.$qcount.'-'.$ccount.'-'.$bcount.'-'.$kcount;
  }
  // Use $drillid as filename, and put in cache folder. 
  $scoredata = fopen("cache/".$drillid,"w");

  //first line has count values
  fwrite($scoredata, $qcount.";".$ccount.";".$bcount.";".$kcount."\n");

  $current = 1;

  $verses = array_map('str_getcsv', file($cycle . '/' . $trans . '/' . 'verses.csv'));

  shuffle($verses);

  for ($i = 0; $i < $qcount; $i++) {
    $v = $verses[$i];

    fwrite($scoredata,$v[0].";".$v[2]."\n");
    $current++;
  }

  for ($i = $qcount; $i < ($qcount + $ccount); $i++) {
    $v = $verses[$i];
    
    fwrite($scoredata,$v[0].";".$v[1].";".$v[2]."\n");
    $current++;
  }
  
  
  $books = array_map('str_getcsv', file('books.csv'));

  shuffle($books);

  for ($i = 0; $i < $bcount; $i++) {
    $v = $books[$i];
    
    fwrite($scoredata,$v[0].";".$v[1]."\n");
    $current++;
  }
  
  $keys = array_map('str_getcsv', file($cycle . '/' . 'keys.csv'));
  $rawpassages = array_map('str_getcsv', file($cycle . '/' . $trans . '/' . 'passages.csv'));
  $passages = array();

  foreach ($rawpassages as $p) {
    $passages[$p[0]] = array($p[1],$p[2]);
  }
  shuffle($keys);

  for ($i = 0; $i < $kcount; $i++) {
    $v = $keys[$i];
    $r = rand(1,$v[3]);
    $aref = $v[2] . $r;
    $selectedverse = $passages[$aref];

    fwrite($scoredata,$v[0].";".$v[1].";".$selectedverse[0].";".$selectedverse[1]."\n");
    $current++;
  }
  fclose($scoredata);

  return $drillid;
}

?>
