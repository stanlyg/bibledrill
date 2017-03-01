<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width">

<title>Children's Bible Drill</title>
<link rel='stylesheet' type='text/css' href='drill.css' media='all'/>
</head>
<body>
<h1>Childrens Bible Drill</h1>

<?php
// Load data
function LoadData($file)
{
  // Read file lines
  $lines = file($file);
  $data = array();
  foreach($lines as $line)
    $data[] = explode(';',trim($line));
  return $data;
}

if ( !isset($_GET['drillid']) ) {
?>
<p>There was an error generating the form. 
<a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>">Please try again.</a>
</p>
<?php
} else {

  $drillid = $_GET['drillid'];
  $drilldata = LoadData('cache/'.$drillid);

  $qcount = $drilldata[0][0];
  $ccount = $drilldata[0][1];
  $bcount = $drilldata[0][2];
  $kcount = $drilldata[0][3];

?>
<p class="fineprint">
This drill has an ID number of <?php echo $drillid; ?>. 
</p>
<p class='noprint'>
<a href='score.php?drillid=<?php echo $drillid ?>'>Score card</a><br />
<a href='mini.php?drillid=<?php echo $drillid ?>'>Just the Q & A</a>
</p>

<?php
  $current = 1;

  for ($i = 0; $i < $qcount; $i++) {

    print <<< TEXT
      <p class='answer'>
        $current.
        <b>{$drilldata[$current][0]}</b><br/>
        {$drilldata[$current][1]}<br />
        {$drilldata[$current][0]}
      </p>

TEXT;

    $current++;
  }
  for ($i = 0; $i < $ccount; $i++) {

    print <<< TEXT
      <p class='answer'>
        $current. 
        <b>{$drilldata[$current][1]}</b><br />
        {$drilldata[$current][2]}<br />
        {$drilldata[$current][0]}
      </p>

TEXT;

    $current++;
  }
  for ($i = 0; $i < $bcount; $i++) {

    print <<< TEXT
      <p class='answer'>
        <b>{$drilldata[$current][0]}</b><br />
        {$drilldata[$current][1]}<br />
      </p>

TEXT;

    $current++;
  }
  for ($i = 0; $i < $kcount; $i++) {

    print <<< TEXT
      <p class='answer'>
        <b>{$drilldata[$current][0]}</b><br />
        {$drilldata[$current][1]}<br />
        {$drilldata[$current][2]}<br />
        {$drilldata[$current][3]}
      </p>

TEXT;

    $current++;
  }
}
?>
</body>
</html>
