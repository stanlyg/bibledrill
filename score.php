<?php
require_once('fpdf.php');
require_once('pdfrotate.php');
include("generate.php");

class PDF extends PDF_Rotate
{
  public $drillid;
  function RotatedText($x,$y,$txt,$angle)
  {
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
  }
  function NinetyCenterPoint($x, $y, $w, $h, $txt, $rect=1, $wpad=0)
  {
    // Text rotated 90 degrees around centered in a box
    $tl = $this->GetStringWidth($txt);
    $newx = $x + $w; 
    $newy = $y + $h / 2 + $tl / 2;
    $this->RotatedText($newx,$newy,$txt,90);

    if ($rect = 1) {
      $this->Rect($x, $y, $w+$wpad, $h);
    }
  }
  // Simple table
  function DrillTable($counts,$data)
  {
    // Top Header
    $this->Cell(0.35,0.2,"",0,0,"C");
    $this->Cell(2.95,0.2,"Call",1,0,"C");
    for ($i = 1; $i <= 12; $i++) {
      $this->Cell(0.35,0.2,$i,1,0,"C");
    }
    $this->Ln();

    // Left Header
    $savey = $this->GetY();
    $y = $this->GetY();
    $x = $this->GetX();

    $h = 0.25*$counts[0];
    $this->NinetyCenterPoint($x,$y,0.25,$h,"Quotation Drill",1,0.1);
    $this->setY($y);

    $q = 1;
    for ($i = 0; $i < $counts[0]; $i++) {
      $this->SetX(0.85);
      $this->Cell(2.95,0.25,$q.". ".$data[$q][0],1);
      for ($j = 1; $j <= 12; $j++) {
        $this->Cell(0.35,0.25,"",1,0,"C");
      }
      $this->Ln();
      $q++;
    }

    $y = $y + $h;
    $h = 0.25*$counts[1];
    if ( ($y + $h) > ($this->GetPageHeight() - 0.75) ) { 
      $this->AddPage();
      $y = $this->GetY();
    }
    $this->NinetyCenterPoint($x,$y,0.25,$h,"Completion Drill",1,0.1);
    for ($i = 0; $i < $counts[1]; $i++) {
      $this->SetX(0.85);
      $this->Cell(2.95,0.25,$q.". ".$data[$q][0],1);
      for ($j = 1; $j <= 12; $j++) {
        $this->Cell(0.35,0.25,"",1,0,"C");
      }
      $this->Ln();
      $q++;
    }
    $y = $y + $h;
    $h = 0.25*$counts[2];
    if ( ($y + $h) > ($this->GetPageHeight() - 0.75) ) { 
      $this->AddPage();
      $y = $this->GetY();
    }
    $this->NinetyCenterPoint($x,$y,0.25,$h,"Book Drill",1,0.1);
    for ($i = 0; $i < $counts[2]; $i++) {
      $this->SetX(0.85);
      $this->Cell(2.95,0.25,$q.". ".$data[$q][0],1);
      for ($j = 1; $j <= 12; $j++) {
        $this->Cell(0.35,0.25,"",1,0,"C");
      }
      $this->Ln();
      $q++;
    }

    $y = $y + $h;
    $h = 0.25*$counts[3];
    if ( ($y + $h) > ($this->GetPageHeight() - 0.75) ) { 
      $this->AddPage();
      $y = $this->GetY();
    }
    $this->NinetyCenterPoint($x,$y,0.25,$h,"Key Passage Drill",1,0.1);
    $y = $y + $h;
    for ($i = 0; $i < $counts[3]; $i++) {
      $this->SetX(0.85);
      $this->Cell(2.95,0.25,$q.". ".$data[$q][0],1);
      for ($j = 1; $j <= 12; $j++) {
        $this->Cell(0.35,0.25,"",1,0,"C");
      }
      $this->Ln();
      $q++;
    }
    // Footer
    $max=count($data);
    $this->Cell(3.3,0.25,"Highest possible Score",1,0,"L");
    for ($i = 1; $i <= 12; $i++) {
      $this->Cell(0.35,0.25,$max,1,0,"C");
    }
    $this->Ln();
    $this->Cell(3.3,0.25,"Subtract Number of Errors",1,0,"L");
    for ($i = 1; $i <= 12; $i++) {
      $this->Cell(0.35,0.25,"",1,0,"C");
    }
    $this->Ln();
    $this->Cell(3.3,0.25,"Total Score",1,0,"L");
    for ($i = 1; $i <= 12; $i++) {
      $this->Cell(0.35,0.25,"",1,0,"C");
    }
    $this->Ln();
  }

  function Footer()
  {
    // Position at 0.3 in from bottom
    $this->SetY(-0.3);
    // Page number
    $this->Cell(0,0.2,$this->drillid,0,0,'C');
  }

}

$pdf = new PDF("P","in","Letter");
// Data loading
$drillid = $_GET['drillid'];
$pdf->drillid = $drillid;
if ( file_exists('cache/'.$drillid) ) {
  $data = LoadData('cache/'.$drillid);
} else {
  $drillid = generate_from_id($drillid);
  $data = LoadData('cache/'.$drillid);
}
$counts = $data[0];
unset($data[0]);

$pdf->SetMargins(0.5,0.5,0.5);

$pdf->AddPage();
$pdf->Image('logo.jpg',null,null,1.26,1.00);
$y=$pdf->GetY();
$x=$pdf->GetX();
$pdf->SetXY(1.80,0.50);
$pdf->SetFont('Arial','',24);
$pdf->Cell(0,1.0,"Children's Bible Drill Score Sheet",0,1,"C");
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,0.25,"Judge: _________________________  Drill: ____________________  Date:  _______________ ",0,0,"L");
$pdf->Ln();
$pdf->Ln();
$pdf->DrillTable($counts,$data);
$footertext = <<<EOT
Mistakes are: 
1.  Child fails to step out within 10 seconds. 
2.  Child gives incorrect response. This includes any child who raises his or her hand, indicating an error. 
3.  Child fails to stand straight or keep eyes on the drill caller until the command "Start" is given. 
4.  When the Bible is used, child steps forward before the index finger is on the correct response. 
5.  Child fails to handle the Bible according to instructions or obviously misuses the Bible. The Bible should be parallel to the floor with one hand flat on the top and one hand flat on the bottom with no fingers extending over the edges.  
(IF A MISTAKE IS MADE, PLEASE WRITE THE NUMBER (1-5) IN THE CORRESPONDING BOX ON THE SCORE SHEET.) 
EOT;
$pdf->SetFont('Arial','',9);
$pdf->Multicell(0,0.15,$footertext,0,"L");
$pdf->Output();
?>
