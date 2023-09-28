<?php
require('fpdf/fpdf.php');


 
class PDF extends FPDF
{
function Header()
{

    $this->setY(12);
    $this->setX(10);
    
    $this->Image('img/Logo_hr.png',25,5,33);
    
    $this->SetFont('times', 'B', 13);
    
    $this->Text(70, 15, utf8_decode('HR365 - SISTEMA DE GESTION DE '));
    
    $this->Text(80, 21, utf8_decode('RECURSOS HUMANOS'));
   
    $this->Text(88,32, utf8_decode('Tel: 964706345'));
    $this->Text(78,38, utf8_decode('nimerce1234@gamail.com'));
    
    $this->Image('img/logo_banny.png',160,5,33);
    
   
    
    
    // Agregamos los datos del cliente
    $this->SetFont('Arial','B',10);    
    $this->Text(10,48, utf8_decode('Fecha:'));
    $this->SetFont('Arial','',10);    
    $this->Text(25,48, date('d/m/Y'));
    
    
    
    
   
    
    $this->Ln(50);
}

function Footer()
{
     $this->SetFont('helvetica', 'B', 8);
        $this->SetY(-15);
        $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        $this->Cell(95,5,date('d/m/Y | g:i:a') ,00,1,'R');
        $this->Line(10,287,200,287);
        $this->Cell(0,5,utf8_decode("DannySystem © Todos los derechos reservados."),0,0,"C");
        
}


}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);


date_default_timezone_set('America/Lima');
$idpersona = $_GET['idpersona'] ;
$date = $_GET['date'] ;
if($date ==="HOY"){
$date = date('Y-m-d'); 
}

 require '../../models/modelo_pagosjornada.php';
 $pago = new Pagos;
 $result= $pago->PagosRealizadosMensuales($idpersona,$date);

if (isset($result) && count($result) > 0) {
   
$nombre= $result[0]['Nombre'];
$apellido= $result[0]['Apellidos'];
$dni= $result[0]['dni'];


$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
// En esta parte estan los encabezados
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(45, 7, utf8_decode('Fechas'),1,0,'C',0);
    $pdf->Cell(80, 7, utf8_decode('Descripción'),1,0,'C',0);
    $pdf->Cell(20, 7, utf8_decode('T. jornada'),1,0,'C',0);
    $pdf->Cell(20, 7, utf8_decode('T. Adelanto'),1,0,'C',0);
    $pdf->Cell(20, 7, utf8_decode('H. Extra'),1,1,'C',0);
   
    $pdf->SetFont('Arial','',10);

    $totalMontoExtra = 0;
    $totalAdelantos = 0;
    $totalMontoP = 0;

    foreach ($result as $row){
    $pdf->Cell(45, 7, $row['fechasPagados'],1,0,'L',0);
    $pdf->Cell(80, 7, utf8_decode($row['Description']),1,0,'L',0);
    $pdf->Cell(20, 7, utf8_decode($row['montoP']),1,0,'R',0);
    $pdf->Cell(20, 7, utf8_decode($row['adelantos']),1,0,'R',0);
    $pdf->Cell(20, 7, utf8_decode($row['montoextra']),1,1,'R',0);

     // Sumar los valores
    $totalMontoExtra += $row['montoextra'];
    $totalAdelantos += $row['adelantos'];
    $totalMontoP += $row['montoP'];

    }


//// Apartir de aqui esta la tabla con los subtotales y totales

$pdf->Ln(10);

        $pdf->setX(95);
        $pdf->Cell(40,6,'Total Jornasa S/.',1,0);
        $pdf->Cell(60,6, $totalMontoP,'1',1,'R');
        $pdf->setX(95);
        $pdf->Cell(40,6,'Total Adelantos S/.',1,0);
        $pdf->Cell(60,6,$totalAdelantos,'1',1,'R');
        $pdf->setX(95);
        $pdf->Cell(40,6,'Total H. Extras S/.',1,0);
        $pdf->Cell(60,6,$totalMontoExtra,'1',1,'R');
        $pdf->setX(95);
        $pdf->Cell(40,6,'Tptal Resivido S/.',1,0);
        $pdf->Cell(60,6,($totalMontoExtra+$totalMontoP)- $totalAdelantos ,'1',1,'R');
 
 // Agregamos los datos de la factura
    $pdf->SetFont('Arial','B',10);    
   $pdf->Text(10,54, utf8_decode('Cliente:'));
   $pdf->SetFont('Arial','',10);    
    $pdf->Text(25,54, $nombre.','.$apellido ); //AQUI DESEO PONER EL NOMBR

     //información de # de factura
     $pdf->SetFont('Arial','B',10);   
     $pdf->Text(150,48, utf8_decode('FACTURA N°:'));
     $pdf->SetFont('Arial','',10);  
     $pdf->Text(176,48, $dni);
} else {
    // La consulta no retornó resultados o $result no está definida
    // Realiza la acción correspondiente, por ejemplo, mostrar un mensaje de error
     "No se encontraron resultados.";
}

$pdf->Output();
?>