<?php
require_once('fpdf.php');
require_once("generate.php");

class PDF extends FPDF {
  public $drillid;
  protected $col = 0;
  public $y0;
  public $cols = 3;
  public $colspace = 3.33;
  public $textwidth = 3;
  public $leftmargin = 0.5;

  function SetCol($col)
  {
    // Set position at a given column
    $this->col = $col;
    $x = $this->leftmargin + $col * $this->colspace;
    $this->SetLeftMargin($x);
    $this->SetX($x);
    error_log("Col: $col, X: $x");
  }

  function AcceptPageBreak()
  {
    // Method accepting or not automatic page break
    if($this->col<($this->cols-1))
    {
        // Go to next column
        $this->SetCol($this->col+1);
        // Set ordinate to top
        $this->SetY($this->y0);
        // Keep on page
        return false;
    }
    else
    {
        // Go back to first column
        $this->SetCol(0);
        // Page break
        return true;
    }
  }

  function Header()
  {
    $this->y0 = $this->GetY();
  }
  function Footer()
  { 
    $this->SetLeftMargin($this->leftmargin);
    $this->SetFont('Arial','',8);
    // Position at 0.3 in from bottom
    $this->SetY(-0.3);
    // Page number
    $this->Cell(0,0.2,$this->drillid,0,0,'C');
  }
}

$pdf = new PDF("L","in","Letter");

if ( !isset($_GET['drillid']) ) {
  $text = "There was an error generating this page. Please try again.";
  $link = dirname($_SERVER['PHP_SELF']);
  $pdf->AddPage();
  $pdf->SetFont('Arial','',24);
  $pdf->Cell(0,1.15,$text,0,1,"C",$false,$link);
  $pdf->Output();
} else {
  $pdf->SetMargins(0.5,0.5,0.5);
  $pdf->AddPage();
  $pdf->SetFont('Arial','',24); 
  $pdf->Cell(0,0.5,"Drill Call Guide",0,1,"C");
  $pdf->y0 = $pdf->GetY();

  $drillid = $_GET['drillid'];
  if (file_exists('cache/'.$drillid)) {
    $drilldata = LoadData('cache/'.$drillid);
  } else {
    $drillid = generate_from_id($drillid); 
    $drilldata = LoadData('cache/'.$drillid);
  }
  $pdf->drillid = $drillid;
  $qcount = $drilldata[0][0];
  $ccount = $drilldata[0][1];
  $bcount = $drilldata[0][2];
  $kcount = $drilldata[0][3];

  $pdf->SetFont('Arial','',10); 
  $current = 1;

  for ($i = 0; $i < $qcount; $i++) {
    $call = iconv('UTF-8', 'windows-1252', html_entity_decode("$current. {$drilldata[$current][0]}"));
    $text = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][1]} {$drilldata[$current][0]}"));
    $pdf->SetFont('','B');
    $pdf->MultiCell($pdf->textwidth,0.2,$call,0,'C');
    $pdf->SetFont('','');
    $pdf->MultiCell($pdf->textwidth,0.2,$text,0);
    $current++;
  }
  for ($i = 0; $i < $ccount; $i++) {
    $call = iconv('UTF-8', 'windows-1252', html_entity_decode("$current. {$drilldata[$current][1]}"));
    $text = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][2]} {$drilldata[$current][0]}"));
    $pdf->SetFont('','B');
    $pdf->MultiCell($pdf->textwidth,0.2,$call,0,'C');
    $pdf->SetFont('','');
    $pdf->MultiCell($pdf->textwidth,0.2,$text,0);
    $current++;
  }
  for ($i = 0; $i < $bcount; $i++) {
    $call = iconv('UTF-8', 'windows-1252', html_entity_decode("$current. {$drilldata[$current][0]}"));
    $text = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][1]}"));
    $pdf->SetFont('','B');
    $pdf->MultiCell($pdf->textwidth,0.2,$call,0,'C');
    $pdf->SetFont('','');
    $pdf->MultiCell($pdf->textwidth,0.2,$text,0);
    $current++;
  }
  for ($i = 0; $i < $kcount; $i++) {
    $call = iconv('UTF-8', 'windows-1252', html_entity_decode("$current. {$drilldata[$current][0]}"));
    $text = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][1]}"));
    $pdf->SetFont('','B');
    $pdf->MultiCell($pdf->textwidth,0.2,$call,0,'C');
    $pdf->SetFont('','');
    $pdf->MultiCell($pdf->textwidth,0.2,$text,0,'C');
    $call = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][2]}"));
    $text = iconv('UTF-8', 'windows-1252', html_entity_decode("{$drilldata[$current][3]}"));
    $pdf->SetFont('','B');
    $pdf->MultiCell($pdf->textwidth,0.2,$call,0,'C');
    $pdf->SetFont('','');
    $pdf->MultiCell($pdf->textwidth,0.2,$text,0);
    $current++;
  }
  $pdf->Output();
}
?>
</body>
</html>
