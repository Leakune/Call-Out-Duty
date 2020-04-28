<?php
require('fpdf182/fpdf.php');

class PDF extends FPDF
{

	// Header
	function Header()
	{
		// Logo
		$this->Image('../../image/logo.png',80,6,50, 50);
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

	function ContactInfo(String $clientName, String $clientAddress, String $city, String $country, String $cp, String $clientPhoneNumber){
		$this->SetFont('Arial','B',14);
		$this->ln(20);
		$this->Cell(130 ,5,'Call-Out Duty',0,0);
		$this->Cell(59 ,5,$clientName,0,1);//end of line
		$this->ln(2);
		//set font to arial, regular, 12pt
		$this->SetFont('Arial','',12);
		$this->Cell(130 ,5,'[Adresse]',0,0);
		$this->Cell(59 ,5,$clientAddress,0,1);//end of line
		$this->Cell(130 ,5,'[Ville, Pays, CP]',0,0);
		$this->Cell(59 ,5,$city.', '.$country.', '.$cp,0,1);//end of line
		$this->Cell(130 ,5,'Telephone [+33234567877]',0,0);
		$this->Cell(59 ,5,'Telephone : '.$clientPhoneNumber,0,1);//end of line
		$this->Cell(130 ,5,'Fax [+33234567877]',0,0);
		$this->Cell(59 ,5,'',0,1);
	}

	function PdfTitle(String $subcriptionOfferName, String $clientName, String $clientAdress, String $city, String $bookingPeriode){

		$this->Cell(189 ,10,'',0,1);//end of line

		// Draw line
		$this->setFillColor(0,0,0);
		$this->Cell(0,1,'',0,1,'L',true);
		$this->ln(5);

		//Abonnement
		$this->Cell(10 ,5,'',0,0);
		$this->SetFont('Arial','B',16);
		$this->Cell(0 ,5,$subcriptionOfferName.' - HOME SERVICES',0,1,'C');//end of line
		$this->ln(2);
		//add dummy cell at beginning of each line for indentation
		$this->SetFont('Arial','',12);
		$this->Cell(10 ,5,'',0,0);
		$this->Cell(0 ,5,$clientName,0,1,'C');



		$this->Cell(10 ,5,'',0,0);
		$this->Cell(0 ,5,$clientAdress.','.$city,0,1,'C');

		$this->Cell(10 ,5,'',0,0);
		$this->Cell(0 ,5,$bookingPeriode,0,1,'C');
		$this->ln(6);
	}
	function PdfTypeNum(String $type, String $num){
		$this->SetFont('Arial','B',16);
		$this->Cell(0 ,5,$type.' N'.chr(176).' '.$num,0,1);
		$this->ln(2);
		$this->setFillColor(0,0,0);
		$this->Cell(0,1,'',0,1,'L',true);

		$this->ln(5);

	}
	function PdfTotalMontant(String $ht, String $tvaAmount, $ttc){
		$this->SetFont('Arial','',14);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,'Total facture HT',0,0);
		$this->Cell(59,5,$ht.' '.chr(128),0,1,'R');

		$this->ln(3);

		$this->SetFont('Arial','',12);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,'TVA [19,6%]',0,0);
		$this->Cell(59,5,$tvaAmount.' '.chr(128),0,1,'R');

		$this->ln(3);

		$this->SetFont('Arial','B',14);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,'Somme '.chr(224).' payer TTC',0,0);
		$this->Cell(59,5,$ttc.' '.chr(128),0,1,'R');

		$this->ln(5);
		$this->setFillColor(0,0,0);
		$this->Cell(0,1,'',0,1,'L',true);

		$this->ln(8);
		$this->SetFont('Arial','B',14);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,'D'.chr(233).'tail de votre facture',0,1);
	}
	function PdfElements(string $category, string $service, string $amount){

		$this->ln(8);

		$this->SetFont('Arial','B',12);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,$category,0,0);
		$this->Cell(59,5,'Cout en '.chr(128).' TTC',0,1,'R');

		$this->ln(3);

		$this->SetFont('Arial','',10);
		$this->Cell(5,5,'', 0, 0);
		$this->Cell(120,5,$service,0,0);
		$this->Cell(59,5,$amount.' ',0,1,'R');

	}
	function PdfLocalOutput(String $name,String $location){
		$this->Output('F',$location.$name.".pdf");

	}
	function PdfDisplayOutput(String $name){
		$this->Output('I', $name.".pdf", true);
	}

}
	/*$invoice=new PDF();
	$invoice->AddFont('arial_narrow','','arial_narrow_7.php');
	$invoice->AliasNbPages();
	$invoice->AddPage();
	$invoice->SetFont('Times','',12);

	$invoice->SetFont('Arial','B',14);*/

//Cell(width , height , text , border , end line , [align] )

// $invoice->ln(20);
// $invoice->Cell(130 ,5,'Call-Out Duty',0,0);
// $invoice->Cell(59 ,5,'CLIENT',0,1);//end of line
// $invoice->ln(2);
// //set font to arial, regular, 12pt
// $invoice->SetFont('Arial','',12);

// $invoice->Cell(130 ,5,'[Adresse]',0,0);
// $invoice->Cell(59 ,5,'[Adresse]',0,1);//end of line

// $invoice->Cell(130 ,5,'[Ville, Pays, CP]',0,0);
// $invoice->Cell(59 ,5,'[Ville, Pays, CP]',0,1);//end of line

// $invoice->Cell(130 ,5,'Telephone [+33234567877]',0,0);
// $invoice->Cell(59 ,5,'Telephone [+33234567877]',0,1);//end of line

// $invoice->Cell(130 ,5,'Fax [+33234567877]',0,0);
// $invoice->Cell(59 ,5,'',0,1);//end of line

// //make a dummy empty cell as a vertical spacer
// $invoice->Cell(189 ,10,'',0,1);//end of line

// // Draw line
// $invoice->setFillColor(0,0,0);
// $invoice->Cell(0,1,'',0,1,'L',true);
// $invoice->ln(5);

// //Abonnement
// $invoice->Cell(10 ,5,'',0,0);
// $invoice->SetFont('Arial','B',16);
// $invoice->Cell(0 ,5,'FORFAIT ANNUEL - HOME SERVICES',0,1,'C');//end of line
// $invoice->ln(2);
// //add dummy cell at beginning of each line for indentation
// $invoice->SetFont('Arial','',12);
// $invoice->Cell(10 ,5,'',0,0);
// $invoice->Cell(0 ,5,'[Nom]',0,1,'C');



// $invoice->Cell(10 ,5,'',0,0);
// $invoice->Cell(0 ,5,'[Adresse]',0,1,'C');

// $invoice->Cell(10 ,5,'',0,0);
// $invoice->Cell(0 ,5,'[periode]',0,1,'C');

// $invoice->ln(6);

// $invoice->SetFont('Arial','B',16);
// $invoice->Cell(0 ,5,'FACTURE N'.chr(176).' 7849403',0,1);
// $invoice->ln(2);
// $invoice->setFillColor(0,0,0);
// $invoice->Cell(0,1,'',0,1,'L',true);

// $invoice->ln(5);
// Corps Facture


// //$invoice->SetFont('arial_narrow','',12);
// $invoice->SetFont('Arial','',14);
// $invoice->Cell(5,5,'', 0, 0);
// $invoice->Cell(120,5,'Total facture HT',0,0);
// $invoice->Cell(59,5,'2412 '.chr(128),0,1,'R');

// $invoice->ln(3);

// $invoice->SetFont('Arial','',12);
// $invoice->Cell(5,5,'', 0, 0);
// $invoice->Cell(120,5,'TVA [19,6%]',0,0);
// $invoice->Cell(59,5,'588 '.chr(128),0,1,'R');

// $invoice->ln(3);

// $invoice->SetFont('Arial','B',14);
// $invoice->Cell(5,5,'', 0, 0);
// $invoice->Cell(120,5,'Somme '.chr(224).' payer TTC',0,0);
// $invoice->Cell(59,5,'3000 '.chr(128),0,1,'R');

// $invoice->ln(5);
// $invoice->setFillColor(0,0,0);
// $invoice->Cell(0,1,'',0,1,'L',true);

// $invoice->ln(8);
/*
$invoice->SetFont('Arial','B',14);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'D'.chr(233).'tail de votre facture',0,1);

$invoice->ln(8);

$invoice->SetFont('Arial','B',12);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'Abonnement',0,0);
$invoice->Cell(59,5,'Cout en '.chr(128).' TTC',0,1,'R');

$invoice->ln(3);

$invoice->SetFont('Arial','',10);
$invoice->Cell(5,5,'', 0, 0);
$invoice->Cell(120,5,'Abonnement Familial Annuel',0,0);
$invoice->Cell(59,5,'3000 ',0,1,'R');*/
//make a dummy empty cell as a vertical spacer
//$invoice->Cell(189 ,10,'',0,1);//end of line

/*
//invoice contents
$invoice->SetFont('Arial','B',12);

$invoice->Cell(130 ,5,'Description',1,0);
$invoice->Cell(25 ,5,'Taxable',1,0);
$invoice->Cell(34 ,5,'Amount',1,1);//end of line

$invoice->SetFont('Arial','',12);

//Numbers are right-aligned so we give 'R' after new line parameter

$invoice->Cell(130 ,5,'UltraCool Fridge',1,0);
$invoice->Cell(25 ,5,'-',1,0);
$invoice->Cell(34 ,5,'3,250',1,1,'R');//end of line

$invoice->Cell(130 ,5,'Supaclean Diswasher',1,0);
$invoice->Cell(25 ,5,'-',1,0);
$invoice->Cell(34 ,5,'1,200',1,1,'R');//end of line

$invoice->Cell(130 ,5,'Something Else',1,0);
$invoice->Cell(25 ,5,'-',1,0);
$invoice->Cell(34 ,5,'1,000',1,1,'R');//end of line

//summary
$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(25 ,5,'Subtotal',0,0);
$invoice->Cell(4 ,5,'$',1,0);
$invoice->Cell(30 ,5,'4,450',1,1,'R');//end of line

$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(25 ,5,'Taxable',0,0);
$invoice->Cell(4 ,5,'$',1,0);
$invoice->Cell(30 ,5,'0',1,1,'R');//end of line

$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(25 ,5,'Tax Rate',0,0);
$invoice->Cell(4 ,5,'$',1,0);
$invoice->Cell(30 ,5,'10%',1,1,'R');//end of line

$invoice->Cell(130 ,5,'',0,0);
$invoice->Cell(25 ,5,'Total Due',0,0);
$invoice->Cell(4 ,5,'$',1,0);
$invoice->Cell(30 ,5,'4,450',1,1,'R');//end of line

*/
	//$invoice->Output('I','facture.pdf', true);
	//	$invoice->Output('F','invoices/test.pdf');


?>
