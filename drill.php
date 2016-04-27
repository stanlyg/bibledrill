<!DOCTYPE HTML>
<html>
<head>
<title>Children's Bible Drill</title>
<link rel='stylesheet' type='text/css' href='drill.css' />
</head>
<body>
<h1>Bible Drill</h1>

<?php
if ( !isset($_POST['generate']) ) {
?>
<p>There was an error generating the form. 
<a href="<?php echo dirname($_SERVER['PHP_SELF']); ?>">Please try again.</a>
</p>
<?php
} else {

  $cycle = $_POST['cycle'];
  $trans = $_POST['trans'];

?>

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

$verses = array_map('str_getcsv', file($cycle . '/' . $trans . '/' . 'verses.csv'));

shuffle($verses);

for ($i = 0; $i < $_POST['qcount']; $i++) {
  $v = $verses[$i];
?>
  <p class='caller'><?php echo $current; ?>. <b>ATTENTION</b><br />
  Please recite: <br />
  <b><u><?php echo $v[0]; ?></u></b><br />
  <b>START</b></p>

  <p class='caller'>Number: __________</p>
  <p class='answer'><?php echo $v[2]; ?><br />
  <?php echo $v[0]; ?></p>

  <?php
  $current++;
}
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></p>

<p class='caller page'>Our second drill is the COMPLETION DRILL. There will be a total of 
<?php echo $_POST['ccount']; ?> calls. I will quote the first part of the Scripture. If 
the participant can complete the verse, he steps forward on the command 
&ldquo;Start&rdquo;, prepared to quote the entire verse and give the reference.<p>

<?php
for ($i = $_POST['qcount']; $i < ($_POST['qcount'] + $_POST['ccount']); $i++) {
  $v = $verses[$i];
?>
  <p class='caller'><?php echo $current; ?>. <b>ATTENTION</b><br />
  Please complete: <br />
  <b><u><?php echo $v[1]; ?></u></b><br />
  <b>START</b></p>

  <p class='caller'>Number: __________</p></td>
  <p class='answer'><?php echo $v[0]; ?><br />
  <?php echo $v[2]; ?><br />
  <?php echo $v[0]; ?></p>
<?php
  $current++;
}
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></td>

<p class='caller page'>This is the BOOK DRILL. There will be <?php echo $_POST['bcount']; ?> calls.  I will 
name a book of the Bible. On the command &ldquo;Start,&rdquo; you will look for the 
book and when you find it, place your index finger on the page and step forward. If 
you are called upon, you will give the name of the book preceding the one called, the 
book called, and the book following the one called.</p>

<table>
<?php
$books = array_map('str_getcsv', file('books.csv'));

shuffle($books);

for ($i = 0; $i < $_POST['bcount']; $i++) {
  $v = $books[$i];
?>
  <p class='caller'><?php echo $current; ?>. <b>ATTENTION</b><br />
  Present Bible <br />
  <b><u><?php echo $v[0]; ?></u></b><br />
  <b>START</b></p>

  <p class='caller'><br />Number: __________</p>
  <p class='answer'><?php echo $v[1]; ?></p>
  <?php
  $current++;
}
?>

<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></td>

<p class='caller page'>
The final drill will be the KEY PASSAGE DRILL. There will be 
<?php echo $_POST['kcount']; ?> calls. I will announce the reference by stating the 
subject or title given to the passage and will give the command "Start." A participant 
must locate the chapter containing the reference, place his finger on any portion of 
the passage and step forward. When called upon, I will ask the participant to state the 
Key Passage and reference. After stating the Key Passage and reference, I will ask the 
same participant to read aloud one or more verses.</p>

<?php
$keys = array_map('str_getcsv', file($cycle . '/' . 'keys.csv'));
$rawpassages = array_map('str_getcsv', file($cycle . '/' . $trans . '/' . 'passages.csv'));
$passages = array();

foreach ($rawpassages as $p) {
  $passages[$p[0]] = $p[1];
}
shuffle($keys);

for ($i = 0; $i < $_POST['kcount']; $i++) {
  $v = $keys[$i];
  $r = rand($v[3],$v[4]);
  $aref = $v[2] . $r;
  $averse = $passages[$aref];
?>
  <p class='caller'><?php echo $current; ?>. <b>ATTENTION</b><br />
  Present Bible <br />
  <b><u><?php echo $v[0]; ?></u></b><br />
  <b>START</b></p>
  <p class='caller'>Number: __________</p>
  <p class='caller'>Recite the key passage and reference</p>
  <p class='answer'><?php echo $v[0]; ?><br />
  <?php echo $v[1]; ?></p>

  <p class='caller'>Number: __________ <br />
  Please read <?php echo $aref; ?></p>
  <p class='answer'><?php echo $aref; ?><br />
  <?php echo $averse; ?></p>
<?php
  $current++;
}
?>
<p class='caller'><b>ATTENTION</b><br />
<b>PLEASE RELAX.</b></p>
<p>Thank you for your participation.</p>
<?php
}
?>
</body>
</html>
