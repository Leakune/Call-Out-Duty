<?php
require('fpdf182/fpdf.php');

class PDF extends FPDF
{

	public $id_prestataires;
	public $name_prestataires;
	public $firstname_prestataires;
	public $phone_prestataires;
	public $address_prestataires;


	public function __construct($orientation, $unit, $size, $i_p, $n_p, $f_p, $a_p, $p_p)
	{
		parent::__construct($orientation, $unit, $size);

		$this->id_prestataires = $i_p;
		$this->name_prestataires = $n_p;
		$this->firstname_prestataires = $f_p;
		$this->address_prestataires = $a_p;
		$this->phone_prestataires = $p_p;


	}
	// Header
	function Header()
	{
		// Logo
		$this->Image('../image/logo.png',80,6,50, 50);
		// Police
		$this->SetFont('Arial', 'B', 15);
		// Justifie
		$this->Cell(80);
		// Titre
	//	$this->Cell(30,10,'Titre',1,0,'C');
		// Saut de ligne
		$this->Ln(30);
	}
	// Footer
	function Footer()
	{
		// Positionnement à 1,5 cm du bas
		$this->SetY(-15);
		// Police
		$this->SetFont('Arial', 'I', 8);
		// Numéro de page
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

	}

	function corps()
	{

	$invoice=new PDF('P', 'mm', 'A4', 'x','x', 'x', 'x', 'x','x');
	$invoice->AddFont('arial_narrow','','arial_narrow_7.php');
	$invoice->AliasNbPages();
	$invoice->AddPage();
	$invoice->SetFont('Times','',12);

	$invoice->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$invoice->ln(20);
$invoice->Cell(130 ,5,'Call-Out Duty',0,0);
$invoice->Cell(59 ,5,'Employ'.chr(233).'(e)',0,1);//end of line
$invoice->ln(2);
//set font to arial, regular, 12pt
$invoice->SetFont('Arial','',12);

$invoice->Cell(130 ,5,'[Adresse]',0,0);
$invoice->Cell(59 ,5,$this->name_prestataires,0,1);//end of line

$invoice->Cell(130 ,5,'[Ville, Pays, CP]',0,0);
$invoice->Cell(59 ,5,$this->firstname_prestataires,0,1);//end of line


$invoice->Cell(130 ,5,'Telephone [+33234567877]',0,0);
$invoice->Cell(59 ,5,$this->address_prestataires,0,1);//end of line

$invoice->Cell(130 ,5,'Fax [+33234567877]',0,0);
$invoice->Cell(59 ,5,'France',0,1);//end of line

$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(59 ,5,'Telephone : '.$this->phone_prestataires,0,1);//end of line

$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(59 ,5,'',0,1);//end of line




//make a dummy empty cell as a vertical spacer
$invoice->Cell(189 ,10,'',0,1);//end of line




$invoice->Cell(10 ,5,'',0,0);
$invoice->SetFont('Arial','B',22);
$invoice->Cell(0 ,5,'CERTIFICAT DE TRAVAIL - HOME SERVICES',0,1,'C');//end of line

$invoice->ln(15);


$invoice->SetFont('Arial','B',16);
$invoice->Cell(0 ,5,'EMPLOYE : [Nom]',0,1);
$invoice->ln(2);
$invoice->setFillColor(0,0,0);
$invoice->Cell(0,1,'',0,1,'L',true);

$invoice->ln(5);





$invoice->SetFont('Arial','B',16);
$invoice->Cell(0 ,5,'SALARIE N'.chr(176).$this->id_prestataires,0,1);
$invoice->ln(2);
$invoice->setFillColor(0,0,0);
$invoice->Cell(0,1,'',0,1,'L',true);

$invoice->ln(5);

$invoice->SetFont('Arial','',12);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'D'.chr(233).'livr'.chr(233).' le : '.date('d/m/yy'),0,0);

$invoice->ln(10);

$invoice->SetFont('Arial','',12);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'N'.chr(176). ' personnel d\'immatriculation de travail : [num]',0,0);
$invoice->ln(10);


$invoice->SetFont('Arial','',12);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'N'.chr(176). ' personnel d\'immatriculation de travail : [num]',0,0);
$invoice->ln(10);



	$invoice->Output('I','certificat-travail.pdf', true);
	//	$invoice->Output('F','invoices/test.pdf');
	}


}


?>
