<!DOCTYPE HTML>
<html>
<head>
<title>Children's Bible Drill</title>
<link rel='stylesheet' type='text/css' href='drill.css' />
</head>
<body>
<h1>Children's Bible Drill</h1>

<form method='post' action='drill.php' style='border: 1px solid black;'>

<table>
  <tr>
    <td>Quotation Drill</td>
    <td>
<!--
      <label for='qyes'>Enabled</label> <input type='radio' name='qdrill' id='qyes' checked='checked' value='yes' />
      <label for='qno'>Disabled</label> <input type='radio' name='qdrill' id='qno' value='no' />
-->
      <input type='text' name='qcount' id='qcount' value='6' size='5' /> <label for='qcount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Completion Drill</td>
    <td>
<!--
      <label for='cyes'>Enabled</label> <input type='radio' name='cdrill' id='qyes' checked='checked' value='yes' />
      <label for='cno'>Disabled</label> <input type='radio' name='cdrill' id='qno' value='no' />
-->
      <input type='text' name='ccount' id='ccount' value='6' size='5' /> <label for='ccount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Book Drill</td>
    <td>
<!--
      <label for='byes'>Enabled</label> <input type='radio' name='bdrill' id='qyes' checked='checked' value='yes' />
      <label for='bno'>Disabled</label> <input type='radio' name='bdrill' id='qno' value='no' />
-->
      <input type='text' name='bcount' id='bcount' value='6' size='5' /> <label for='bcount'>Questions</label>
    </td>
  </tr>
  <tr>
    <td>Key Passage Drill</td>
    <td>
<!--
      <label for='kyes'>Enabled</label> <input type='radio' name='kdrill' id='qyes' checked='checked' value='yes' />
      <label for='kno'>Disabled</label> <input type='radio' name='kdrill' id='qno' value='no' />
-->
      <input type='text' name='kcount' id='kcount' value='6' size='5' /> <label for='kcount'>Questions</label>
    </td>
  </tr>
</table>

<input type='submit'>
</form>

</body>
</html>
