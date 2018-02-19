<!DOCTYPE HTML>
<?
$year = (int) date("Y") + 0 ;
$month = (int) date("n") + 0; 
if ($month > 4) { $year++; }
$cycle = (int) $year % 3;
$bcheck = ""; $gcheck = ""; $rcheck = "";
if ( $cycle == 0 ) {
	$bcheck = " checked=\"checked\"";
} elseif ( $cycle == 1 ) {
	$gcheck = " checked=\"checked\"";
} elseif ( $cycle == 2 ) {
	$rcheck = " checked=\"checked\"";
}?>

<html>
<head>
<meta name="viewport" content="width=device-width">

<title>Children's Bible Drill</title>
<link rel='stylesheet' type='text/css' href='drill.css' />
</head>
<body>
<h1>Children's Bible Drill<br />
Drill Generator</h1>


<div id="cbdform">
<form method='post' action='drill.php' style='border: 1px solid black;'>

<div class='radio-toolbar' id='c-select'>
	  Cycle: <br />
	  <input type="radio" name="cycle" id="rcycle" value="red"<?php echo $rcheck;?>><label for="rcycle">Red</label>
      <input type="radio" name="cycle" id="gcycle" value="green"<?php echo $gcheck;?>><label for="gcycle">Green</label>
      <input type="radio" name="cycle" id="bcycle" value="blue"<?php echo $bcheck;?>><label for="bcycle">Blue</label>
</div>
<div class='radio-toolbar' id='t-select'>
    Translation: <br />
    <input type="radio" name="trans" id="kjv" value="kjv"> <label for="kjv"><abbr title='King James Version'>KJV</abbr></label>
    <input type="radio" name="trans" id="niv" value="niv" checked="checked"> <label for="niv"><abbr title='New International Version'>NIV</abbr></label>
    <input type="radio" name="trans" id="hcs" value="hcs"> <label for="hcs"><abbr title='Holman Christian Standard Bible'>HCSB</abbr></label>
    <input type="radio" name="trans" id="esv" value="esv"> <label for="esv"><abbr title='English Standard Version'>ESV</abbr></label>
</div>
<div id="generatebutton">
  <input type='submit' name="generate" value="generate" />
</div>
<div class='options'>
    <input id='toggleoptions' type='checkbox'/>
	<label for='toggleoptions'>More options</label>
<div class='numberstuff' id='extradetails'>
    <p><label for='drillid'>Drill ID Number:</label><br />
    <input type='tel' name='drillid' id='drillid' value='' size='12' />
    </p>
    <p>Quotation Drill:<br />
    <input type='tel' name='qcount' id='qcount' value='6' size='5' min='0' max='25' /> <label for='qcount'>Questions</label>
    </p>
    <p>Completion Drill:<br />
    <input type='tel' name='ccount' id='ccount' value='6' size='5' min='0' max='25' /> <label for='ccount'>Questions</label>
    </p>
    <p>Book Drill:<br />
    <input type='tel' name='bcount' id='bcount' value='6' size='5' min='0' max='64' /> <label for='bcount'>Questions</label>
    </p>
    <p>Key Passage Drill:<br />
    <input type='tel' name='kcount' id='kcount' value='6' size='5' min='0' max='10' /> <label for='kcount'>Questions</label>
    </p>
	<div id="generatebutton">
  <input type='submit' name="generate" value="generate" />
</div>

</div>
</div>

</form>
</div>
</body>
</html>
