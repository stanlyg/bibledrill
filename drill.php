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
Welcome to Children's Bible Drill for &mdash;. <br /> 
There are five people who will be involved in running the drill today. I am the caller. There is also a 
timekeeper, who will track the time. There are three judges who will track their scores independently, 
and then they will combine their scores to determine the qualifications.</p>

<p class="caller">
We have four different types of Drills: QUOTATION DRILL, COMPLETION DRILL, BOOK DRILL 
and KEY PASSAGE DRILL.</p>

<p class="caller">For each drill, the participant will have ten seconds to step forward, and if called upon, 
to provide the correct answer to the caller's prompt.</p>

<p class="caller">
Our first drill is the QUOTATION DRILL and there will be <?php echo $_POST['qcount']; ?> 
calls.  I will give the reference, such as Proverbs 31, verses 10 and 11. If the participant knows the 
verse, he or she should step forward after the command &ldquo;START&rdquo; is given, but before the 
timekeeper calls &ldquo;TIME.&rdquo; When called upon, the participant must quote the complete verse 
and give the reference. Any participant who is not called upon should wait patiently until the command 
&ldquo;ATTENTION&rdquo; is given.
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
<?php echo $ccount; ?> calls. I will quote the first part of the Scripture, such as 
&ldquo;A wife of noble character&rdquo;. If the participant can complete the verse, he or she 
should step forward after the command &ldquo;START&rdquo; is given, but before the timekeeper
class &ldquo;TIME.&rdquo; When called upon, the participant must quote the complete verse and 
give the reference. Any participant who is not called upon should wait patiently until the command
&ldquo;ATTENTION&rdquo; is given.</p>

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

<p class='caller page'>Our third drill is the BOOK DRILL. There will be a total of 
<?php echo $bcount; ?> calls.  I will name a book of the Bible. After the command &ldquo;START,&rdquo; 
each participant should look for the book in the Bible, and after you finding it, place his or her index 
finger on a page within that book of the Bible and step forward. The participant must step forward before
the timekeeper calls &ldquo;TIME.&rdquo; When called upon, the participant must 
give the name of the book preceding the one called, the book called, and the book following the one 
called.</p>

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
Our fourth and final drill will be the KEY PASSAGE DRILL. There will be a total of 
<?php echo $kcount; ?> calls. I will announce the reference by stating the subject or title given 
to the passage, such as &ldquo;The Wise Wife&rdquo;. After the command &ldquo;START,&rdquo; each 
participant should look for the key passage in the Bible, and after finding it, place his or her 
index finger on a portion of the text within the key passage and step forward. The participant 
must step forward before the timekeeper calls &ldquo;TIME.&rdquo; When called upon, the 
participant must give both the title of the Key Passage and the reference. After corrrectly 
stating the Key Passage and reference, I will ask the same participant to read aloud one or more 
verses from within that key passage.</p>

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
<p>Drillers, thank you for your participation. The judges will now confer to determine the 
final scores for each drill participant.</p>
<p class='copyrightnotice'>
<?php
  include("copyrights/".$trans.".txt");
?>
</p>
</body>
</html>
