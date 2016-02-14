<!DOCTYPE HTML>
<html>
<head>
<title>Children's Bible Drill</title>
<style>
body {
  width: 7in;
  margin-left: auto;
  margin-right: auto;
}
.caller {
  color: blue;
}
.answer {
  color: green;
}
table {
  width: 100%;
}
td {
  border-bottom: 1px solid black;
}
td.noborder {
  border-bottom: none;
}
td.caller { 
  width: 30%;
}
td.answer {
  width: 70%;
}
br.page {
  page-break-before: always;
}
</style>
</head>
<body>
<h1>Children's Bible Drill</h1>

<p class="caller">
We have four different types of Drills: QUOTATION DRILL, COMPLETION DRILL
BOOK DRILL and KEY PASSAGE DRILL.</p>
<p class="caller">
Our first drill is the QUOTATION DRILL and there will be six calls. I will give the reference. If the
participant knows the verse, he steps forward on the command &ldquo;START.&rdquo; 
When called upon, the participant must quote the verse and give the reference.
</p>

<table>
<?php

$verses = array_map('str_getcsv', file('verses.csv'));

shuffle($verses);


for ($i = 1; $i <= 6; $i++) {
  $v = $verses[$i];
  echo "<tr><td class='caller'><p>$i. <b>ATTENTION</b><br />";
  echo "Please recite: <br />";
  echo "<b><u>$v[0]</u></b><br />";
  echo "<b>START</b></p>";
  echo "<p><br />Number: __________</p></td>";
  echo "<td class='answer'>";
  echo "<p>$v[2]<br />";
  echo "$v[0]</p>";
  echo "</td></tr>";
}
  echo "<tr><td class='caller'><b>ATTENTION</b><br />";
  echo "<b>PLEASE RELAX.</b></td>";
  echo "<td class='answer'>&nbsp;</td></tr>";

?>
</table>
<br class='page' />
<p>This is the COMPLETION DRILL. There will be a total of six calls. I will quote the first part of the
Scripture. If the participant can complete the verse, he steps forward on the command &ldquo;Start&rdquo;, prepared to
quote the entire verse and give the reference.<p>

<table>
<?php
for ($i = 7; $i <= 12; $i++) {
  $v = $verses[$i];
  echo "<tr><td class='caller'><p>$i. <b>ATTENTION</b><br />";
  echo "Please complete: <br />";
  echo "<b><u>$v[1]</u></b><br />";
  echo "<b>START</b></p>";
  echo "<p><br />Number: __________</p></td>";
  echo "<td class='answer'>";
  echo "<p>$v[0]<br />";
  echo "$v[2]<br />";
  echo "$v[0]</p>";
  echo "</td></tr>";
}
  echo "<tr><td class='caller'><b>ATTENTION</b><br />";
  echo "<b>PLEASE RELAX.</b></td>";
  echo "<td class='answer'>&nbsp;</td></tr>";
?>
</table>
<br class='page' />
<p>This is the BOOK DRILL. I will name a book of the Bible. On the command &ldquo;Start,&rdquo; you will look for the
book and when you find it, place your index finger on the page and step forward. If you are called upon, you
will give the name of the book preceding the one called, the book called, and the book following the one called.</p>

<table>
<?php
  $books = array_map('str_getcsv', file('books.csv'));

shuffle($books);

for ($i = 13; $i <= 18; $i++) {
  $v = $books[$i];
  echo "<tr><td class='caller'><p>$i. <b>ATTENTION</b><br />";
  echo "Present Bible <br />";
  echo "<b><u>$v[0]</u></b><br />";
  echo "<b>START</b></p>";
  echo "<p><br />Number: __________</p></td>";
  echo "<td class='answer'>";
  echo "<p>$v[1]</p>";
  echo "</td></tr>";
}
  echo "<tr><td class='caller'><b>ATTENTION</b><br />";
  echo "<b>PLEASE RELAX.</b></td>";
  echo "<td class='answer'>&nbsp;</td></tr>";
?>
</table>

<br class='page' />
<p>This is the KEY PASSAGE DRILL and there will be six calls. I will announce the reference by stating the
subject or title given to the passage and will give the command "Start." A participant must locate the chapter
containing the reference, place his finger on any portion of the passage and step forward. When called upon, I
will ask the participant to state the Key Passage and reference. After stating the Key Passage and reference, I
will ask the same participant to read aloud one or more verses.</p>

<table>
<?php
  $keys = array_map('str_getcsv', file('keys.csv'));
  $rawpassages = array_map('str_getcsv', file('passages.csv'));
  $passages = array();

  foreach ($rawpassages as $p) {
    $passages[$p[0]] = $p[1];
  }
  shuffle($keys);

  for ($i = 0; $i < 6; $i++) {
    $j = $i+19;
    $v = $keys[$i];
    $r = rand($v[3],$v[4]);
    $aref = $v[2] . $r;
    $averse = $passages[$aref];
    echo "<tr><td class='caller noborder'><p>$j. <b>ATTENTION</b><br />";
    echo "Present Bible <br />";
    echo "<b><u>$v[0]</u></b><br />";
    echo "<b>START</b></p>";
    echo "<p><br />Number: __________</p>";
    echo "<p>Recite the key passage and reference</p>";
    echo "</td>";
    echo "<td class='answer noborder'>";
    echo "<p>$v[1]</p>";
    echo "</td></tr>";

    echo "<tr><td class='caller'>";
    echo "<p>Number: __________ <br />";
    echo "Please read $aref</td>";
    echo "<td class='answer'>";
    echo "<p>$aref<br/>$averse</p>";
    echo "</td></tr>";
  }
  echo "<tr><td class='caller'><b>ATTENTION</b><br />";
  echo "<b>PLEASE RELAX.</b></td>";
  echo "<td class='answer'>&nbsp;</td></tr>";
?>
</table>
<p>Thank you for your participation. Please proceed to __________ and await your results.</p>
</body>
</html>
