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
if ( !isset($_POST['generate']) ) {
?>
<p>There was an error generating the form. 
<a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>">Please try again.</a>
</p>
<?php
} else {

  if ( !isset($_POST['drillid']) ) {
    $seed = time();
  } else {
    $seed = $_POST['drillid'];
  }

  $cycle = $_POST['cycle'];
  $trans = $_POST['trans'];
  $qcount = $_POST['qcount'];
  $ccount = $_POST['ccount'];
  $bcount = $_POST['bcount'];
  $kcount = $_POST['kcount'];

  include_once("generate.php");
  $drillid = generate_data_file($seed, $cycle, $trans, $qcount, $ccount, $bcount, $kcount);

  $drilldata = LoadData('cache/'.$drillid);


?>
<p class="fineprint">
This Children's Bible Drill is for the <?php echo strtoupper($cycle); ?> cycle and the 
<?php echo strtoupper($trans); ?> translation. This drill has an ID number of <?php echo $drillid; ?>. 
</p>
<p class='noprint'>
<a href='score.php?drillid=<?php echo $drillid ?>'>Score card</a> | 
<a href='mini.php?drillid=<?php echo $drillid ?>'>Just the Q & A</a> |
<a href='minipdf.php?drillid=<?php echo $drillid ?>'>Drill Call Guide</a>
</p>

<p class="caller">
We have four different types of Drills: QUOTATION DRILL, COMPLETION DRILL
BOOK DRILL and KEY PASSAGE DRILL.</p>

<p class="caller">
Our first drill is the QUOTATION DRILL and there will be <?php echo $_POST['qcount']; ?> 
calls.  I will give the reference. If the participant knows the verse, he steps forward 
on the command &ldquo;START.&rdquo; When called upon, the participant must quote the 
verse and give the reference.
</p>

<?php
  $current = 1;

  for ($i = 0; $i < $qcount; $i++) {

    print <<< TEXT
      <p class='caller'>
        $current: <b>ATTENTION</b><br />
        Please recite: <br />
        <b><u>{$drilldata[$current][0]}</u></b><br />
        <b>START</b>
      </p>

      <p class='caller'>
        Number: __________
      </p>
      <p class='answer'>
        {$drilldata[$current][1]}<br />
        {$drilldata[$current][0]}
      </p>

TEXT;

    $current++;
  }
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></p>

<p class='caller page'>Our second drill is the COMPLETION DRILL. There will be a total of 
<?php echo $ccount; ?> calls. I will quote the first part of the Scripture. If 
the participant can complete the verse, he steps forward on the command 
&ldquo;Start&rdquo;, prepared to quote the entire verse and give the reference.<p>

<?php
  for ($i = 0; $i < $ccount; $i++) {

    print <<< TEXT
      <p class='caller'>
        $current: <b>ATTENTION</b><br />
        Please complete: <br />
        <b><u>{$drilldata[$current][1]}</u></b><br />
        <b>START</b>
      </p>

      <p class='caller'>
        Number: __________
      </p>
      <p class='answer'>
        {$drilldata[$current][2]}<br />
        {$drilldata[$current][0]}
      </p>

TEXT;

    $current++;
  }
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></td>

<p class='caller page'>This is the BOOK DRILL. There will be <?php echo $bcount; ?> calls.  I will 
name a book of the Bible. On the command &ldquo;Start,&rdquo; you will look for the 
book and when you find it, place your index finger on the page and step forward. If 
you are called upon, you will give the name of the book preceding the one called, the 
book called, and the book following the one called.</p>

<?php
  for ($i = 0; $i < $bcount; $i++) {

    print <<< TEXT
      <p class='caller'>
        $current: <b>ATTENTION.</b><br />
        PRESENT BIBLE.<br />
        <b><u>{$drilldata[$current][0]}</u></b><br />
        <b>START</b>
      </p>

      <p class='caller'>
        Number: __________
      </p>
      <p class='answer'>
        {$drilldata[$current][1]}<br />
      </p>

TEXT;

    $current++;
  }
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></td>

<p class='caller page'>
The final drill will be the KEY PASSAGE DRILL. There will be 
<?php echo $kcount; ?> calls. I will announce the reference by stating the 
subject or title given to the passage and will give the command "Start." A participant 
must locate the chapter containing the reference, place his finger on any portion of 
the passage and step forward. When called upon, I will ask the participant to state the 
Key Passage and reference. After stating the Key Passage and reference, I will ask the 
same participant to read aloud one or more verses.</p>

<?php
  for ($i = 0; $i < $kcount; $i++) {

    print <<< TEXT
      <p class='caller'>
        $current: <b>ATTENTION</b><br />
        PRESENT BIBLE.<br />
        Recite the key passage and reference: <br />
        <b><u>{$drilldata[$current][0]}</u></b><br />
        <b>START</b>
      </p>

      <p class='caller'>
        Number: __________
      </p>
      <p class='answer'>
        {$drilldata[$current][0]}<br />
        {$drilldata[$current][1]}
      </p>
      <p class='caller'>
        Please read {$drilldata[$current][2]}
      </p>
      <p class='answer'>
        {$drilldata[$current][3]}<br />
        {$drilldata[$current][2]}
      </p>

TEXT;

    $current++;
  }
}
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></p>
<p>Thank you for your participation.</p>
<p>
<?php
  include("copyrights/".$trans.".txt");
?>
</p>
</body>
</html>
