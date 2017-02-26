<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width">

<title>Children's Bible Drill</title>
<link rel='stylesheet' type='text/css' href='drill.css' />
</head>
<body>
<h1>Children's Bible Drill</h1>

<form method='post' action='drill.php' style='border: 1px solid black;'>

<table>
  <tr>
    <td>Cycle</td>
    <td>
      <input type="radio" name="cycle" id="rcycle" value="red">   <label for="rcycle">Red</label>
      <input type="radio" name="cycle" id="gcycle" value="green" checked="checked"> <label for="gcycle">Green</label>
      <input type="radio" name="cycle" id="bcycle" value="blue">  <label for="bcycle">Blue</label>
    </td>
  </tr>
  <tr>
    <td>Translation</td>
    <td>
      <input type="radio" name="trans" id="kjv" value="kjv"> <label for="kjv">King James Version</label> <br />
      <input type="radio" name="trans" id="niv" value="niv" checked="checked"> <label for="niv">New International Version (2011)</label><br />
      <input type="radio" name="trans" id="hcs" value="hcs"> <label for="hcs">Holman Christian Standard</label><br />
      <input type="radio" name="trans" id="esv" value="esv"> <label for="esv">English Standard Version</label>
    </td>
  </tr>
  <tr>
    <td>Quotation Drill</td>
    <td>
      <input type='number' name='qcount' id='qcount' value='6' size='5' min='0' max='25' /> <label for='qcount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Completion Drill</td>
    <td>
      <input type='number' name='ccount' id='ccount' value='6' size='5' min='0' max='25' /> <label for='ccount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Book Drill</td>
    <td>
      <input type='number' name='bcount' id='bcount' value='6' size='5' min='0' max='66' /> <label for='bcount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Key Passage Drill</td>
    <td>
      <input type='number' name='kcount' id='kcount' value='6' size='5' min='0' max='10' /> <label for='kcount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Drill ID Number</td>
    <td>
      <input type'number' name='drillid' id='drillid' value='<?php echo time(); ?>' size='12' /> <label for='drillid'>(optional)</label>
    </td>
  </tr>
</table>

<div id="generatebutton" style="text-align: center;">
  <input type='submit' name="generate" value="generate" />
</div>
</form>

</body>
</html>
