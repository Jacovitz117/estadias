<?php
session_start();


if(isset($_SESSION['nombre_us']))
{ 

    
error_reporting(1);

require_once ('conexion_bd.php');
require('fpdf/fpdf.php');

$obj = new BD_PDO;

// CONSULTAS MYSQL

$id = $_GET['id'];


$ord = $obj->Ejecutar_Instruccion("SELECT
id_orden, 
proveedores.nombre_prov AS proveedor, 
ordencompra.fecha_crea AS fecha, 
departamentos.nombre_dep AS departamento, 
departamentos.encargado_dep as encargado, 
ordencompra.numero_orden AS orden, 
ordencompra.numero_req_orden AS req,
proveedores.iva_prov AS iva
FROM ordencompra 
INNER JOIN proveedores ON ordencompra.id_prov_orden = proveedores.id_prov 
INNER JOIN departamentos ON ordencompra.id_dep_orden = departamentos.id_dep 
WHERE id_orden = '{$id}'");

$det = $obj->Ejecutar_Instruccion("SELECT id_det, id_orden_det, ordencompra.numero_orden, 
cuentas.numero_cuen AS cuenta, subcuentas.numero_sub AS subcuenta, productos.nombre_prod AS prod, unidades.nombre_unid AS unid, 
cantidad_pedida_det AS cantidad, precio_unitario_det AS pu, estado_det 
FROM detalleorden 
INNER JOIN ordencompra ON detalleorden.id_orden_det = ordencompra.id_orden 
INNER JOIN cuentas ON detalleorden.id_cuenta_det = cuentas.id_cuen 
INNER JOIN subcuentas ON detalleorden.id_subcuenta_det = subcuentas.id_sub 
INNER JOIN unidades ON detalleorden.id_unidad_det = unidades.id_unid 
INNER JOIN productos ON detalleorden.id_prod = productos.id_prod 
WHERE id_orden_det = '{$id}'");


$subtotal = $obj->Ejecutar_Instruccion("SELECT SUM(detalleorden.cantidad_pedida_det*detalleorden.precio_unitario_det) AS total FROM detalleorden WHERE detalleorden.id_orden_det = '{$id}'");



$IVA = intval($subtotal[0]['total']) * $ord[0]['iva'];

$IVAA = number_format($IVA,2);

// var_dump($ord[0]['iva'],$subtotal[0]['total']);


$TOOTAL = intval($subtotal[0]['total']) + $IVA ;

$Total = number_format($TOOTAL,2);

// var_dump(intval($subtotal[0]['total']));

// FIN CONSULTAS MYSQL

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
    // $this->Image('logo.png',10,8,33);
        // Arial bold 15
        // $this->SetFont('Arial','B',15);
        // // Movernos a la derecha
        // $this->Cell(80);
        // // Título
        // $this->Cell(30,10,'Title',1,0,'C');
        // // Salto de línea
        // $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // // Posición: a 1,5 cm del final
        // $this->SetY(-15);
        // // Arial italic 8
        // $this->SetFont('Arial','I',8);
        // // Número de página
        // $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }


    
// SCRIPT MULTICELDAS


var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        if ($i == 6 or $i== 7)
        {
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'R';
        } else 
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}


// FINAL SCRIPT MULTICELDAS





// Creación del objeto de la clase heredada
$pdf = new PDF(); //Crea Instancias de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //Añade Pagina en blanco
$pdf->SetFont('Times','B',12); //elegir fuente

//Registro Legenda
$pdf->setXY(10,5);
$pdf->Cell(90,35.1,'',1,0,'C',0);
//Logo Universidad
$pdf->Image('imgpdf/logo.jpg',40,8,33);

//Nombre de Formato
$pdf->setXY(100,5);
$pdf->Cell(100,35.1,'ORDEN DE COMPREA Y/O SERVICIO',1,0,'C',0);

//Registro Legenda
$pdf->setXY(10,40);
$pdf->Cell(90,15,'Registro',1,0,'C',0);

//Registro Dato
$pdf->setXY(100,40);
$pdf->Cell(100,15,'F-AFI-02',1,0,'C',0);

//Salto de Linea
$pdf->Ln(6);

//Proveedor Legenda
$pdf->setXY(10,59);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(20,10 ,'Proveedor',0,0,'C',0);

//Proveedor Datos
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->setXY(32,59);
$pdf->Cell(100,10,$ord[0]['proveedor'],1,0,'C',0);

//Fecha legenda
$pdf->setXY(140,59);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(20,10,'Fecha',0,0,'C',0);

//Fecha Datos
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->setXY(158,59);
$pdf->Cell(42,10,$ord[0]['fecha'],1,0,'C',0);

//Salto de Linea
$pdf->Ln(10);

// Departamento Legenda
$pdf->setXY(10,72);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(60,6,'Departamento',1,0,'C',0);

// Solicitó Legenda
$pdf->setXY(70,72);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(85,6,utf8_decode('Solicitó'),1,0,'C',0);

// Num-Orden Legenda
$pdf->setXY(155,72);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.5,6,utf8_decode('No. Orden'),1,0,'C',0);

// Num-Req Legenda
$pdf->setXY(177.5,72);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.5,6,utf8_decode('No. Req'),1,0,'C',0);

//Salto de Linea
$pdf->Ln(10);



// Departamento Datos
$pdf->setXY(10,78);
$pdf->SetFont('Times','',10); //elegir fuente
$pdf->Cell(60,6,utf8_decode($ord[0]['departamento']),1,0,'C',0);

// Solicitó Legenda
$pdf->setXY(70,78);
$pdf->SetFont('Times','',10); //elegir fuente
$pdf->Cell(85,6,utf8_decode($ord[0]['encargado']),1,0,'C',0);

// Num-Orden Legenda
$pdf->setXY(155,78);
$pdf->SetFont('Times','',10); //elegir fuente
$pdf->Cell(22.5,6,utf8_decode($ord[0]['orden']),1,0,'C',0);

// Num-Req Legenda
$pdf->setXY(177.5,78);
$pdf->SetFont('Times','',10); //elegir fuente
$pdf->Cell(22.5,6,utf8_decode($ord[0]['req']),1,0,'C',0);

//Salto de Linea
$pdf->Ln(10);

// Part Legenda
$pdf->setXY(10,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(13,6,'Part',1,0,'C',0);

// Cuenta Legenda
$pdf->setXY(23,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(15,6,'Cuenta',1,0,'C',0);

// Sub-Cuenta Legenda
$pdf->setXY(38,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(15,6,'Subc.',1,0,'C',0);

// Cantidad Legenda
$pdf->setXY(53,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(15,6,'Cant.',1,0,'C',0);

// Unidad Legenda
$pdf->setXY(68,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(18,6,'Unid.',1,0,'C',0);

// Descripcion/producto Legenda
$pdf->setXY(86,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(70,6,utf8_decode('Descripción'),1,0,'C',0);

// Precio Unitario Legenda
$pdf->setXY(156,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(21.5,6,utf8_decode('P.U.'),1,0,'C',0);

// Precio Unitario Legenda
$pdf->setXY(177.5,88);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('Total'),1,0,'C',0);

$pdf->Ln(6);



$pdf->SetWidths(array(13,15,15,15,18,70,21.5,22.4));

for ($i=0;$i<count($det);$i++){

    $pu = number_format($det[$i]['pu'],2);
    $total = number_format($det[$i]['pu']*$det[$i]['cantidad'],2);
    $subcuenta = utf8_decode($det[$i]['subcuenta']);
    $cuenta = utf8_decode($det[$i]['cuenta']);
    $inc = $i+1;

    $pdf->setX(10);
    $pdf->SetFont('Times','',9); //elegir fuente
    $pdf->Row(array($inc,$cuenta,$subcuenta,utf8_decode($det[$i]['cantidad']),utf8_decode($det[$i]['unid']),utf8_decode($det[$i]['prod']),'$ '.$pu,'$ '.$total));
}

// foreach ($det as $dets) 
// {
//     $pdf->setX(10);
//     $pdf->SetFont('Times','',9); //elegir fuente
//     $pdf->Row(array($i,utf8_decode($det[$i]['cuenta']),utf8_decode($det[$i]['subcuenta']),utf8_decode($det[$i]['cantidad']),utf8_decode($det[$i]['unid']),utf8_decode($det[$i]['prod']),utf8_decode('$         '.$det[$i]['pu']),utf8_decode('$         '.$det[$i]['pu']*$det[$i]['cantidad'])));
// }



// Otro caja de texto
$pdf->setXY(23,195);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('MERCANCIA'),0,0,'C',0);


// Otro caja de texto
$pdf->setXY(20,208);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// Otro caja de texto
$pdf->setXY(38,208);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('INCOMPLETA'),0,0,'C',0);


// Otro caja de texto
$pdf->setXY(20,201);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// Otro caja de texto
$pdf->setXY(36,201);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('COMPLETA'),0,0,'C',0);


// Otro caja de texto
$pdf->setXY(86,195);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('OBSERVACIONES (ALMACENISTA)'),0,0,'C',0);

// Comentarios del Almacenista
$pdf->setXY(60,201);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(94,12,utf8_decode(''),1,0,'C',0);


// TOTAL IVA Y SUB TOTAL

// SUBTOTAL
$pdf->setXY(156,194);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,15,utf8_decode(''),1,0,'C',0);

// SUBTOTAL
$pdf->setXY(145,191);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('SUBTOTAL'),0,0,'C',0);

// SUBTOTAL
$pdf->setXY(166,191);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('   $ '.number_format(intval($subtotal[0]['total']),2).''),0,0,'C',0);

// IVA
$pdf->setXY(139,195);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('I.V.A'),0,0,'C',0);

// IVA
$pdf->setXY(167,195);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('   $ '.$IVAA.''),0,0,'C',0);

// TOTAL
$pdf->setXY(141,199);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('TOTAL'),0,0,'C',0);

// TOTAL
$pdf->setXY(167,199);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(44,12,utf8_decode('   $ '.$Total.''),0,0,'C',0);





// FIN TOTAL IVA Y SUB TOTAL


/* 

    AQUI COMIENZA SECCION SOBRE DATOS DE CUENTAS (CAJAS DE TEXTO Y TEXTO)

*/


// Otro caja de texto
$pdf->setXY(20,220);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('CUENTA:'),0,0,'C',0);



// EFECTIVO caja de texto
$pdf->setXY(40,215);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// EFECTIVO caja de texto
$pdf->setXY(56,215);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('EFECTIVO'),0,0,'C',0);



// CHEQUE caja de texto
$pdf->setXY(80,215);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// CHEQUE caja de texto
$pdf->setXY(95,215);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('CHEQUE'),0,0,'C',0);


// TRANSFERENCIA caja de texto
$pdf->setXY(120,215);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// TRANSFERENCIA caja de texto
$pdf->setXY(142,215);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('TRANSFERENCIA'),0,0,'C',0);




// FEDERAL caja de texto
$pdf->setXY(40,222);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// FEDERAL caja de texto
$pdf->setXY(55,222);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('FEDERAL'),0,0,'C',0);



// ESTATAL caja de texto
$pdf->setXY(80,222);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// ESTATAL caja de texto
$pdf->setXY(95,222);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('ESTATAL'),0,0,'C',0);


// PROPIOS caja de texto
$pdf->setXY(120,222);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// PROPIOS caja de texto
$pdf->setXY(135,222);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('PROPIOS'),0,0,'C',0);


// Otro caja de texto
$pdf->setXY(40,229);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(10,6,utf8_decode(''),1,0,'C',0);

// Otro caja de texto
$pdf->setXY(94,229);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(10,6,utf8_decode('OTRO:_______________________________________________'),0,0,'C',0);


/* 

    AQUI FINALIZA SECCION SOBRE DATOS DE CUENTAS (CAJAS DE TEXTO Y TEXTO)

*/



/* 

    AQUI COMIENZA SECCION SOBRE FIRMAS DE ENCARGADOS DE DEPARTAMENTOS

*/


// Linea Firma Elaboro Legenda
$pdf->setXY(30,244);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('_______________________'),0,0,'C',0);

// Titulo Elaboro Legenda
$pdf->setXY(30,250);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('ELABORO'),0,0,'C',0);

// Descripcion Elaboro Legenda
$pdf->setXY(30,254);
$pdf->SetFont('Times','B',7); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('JEFE DE OFICINA'),0,0,'C',0);
$pdf->setXY(30,257);
$pdf->SetFont('Times','B',7); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('ADMON. Y FINANZAS'),0,0,'C',0);


// Linea Firma Autorizo Legenda
$pdf->setXY(90,244);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('_______________________'),0,0,'C',0);

// Titulo Autorizo Legenda
$pdf->setXY(90,250);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('AUTORIZO'),0,0,'C',0);

// Descripcion Autorizo Legenda
$pdf->setXY(90,254);
$pdf->SetFont('Times','B',7); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('DIRECTOR DE ADMON. Y FINANZAS'),0,0,'C',0);


// Linea Firma Recibio Legenda
$pdf->setXY(150,244);
$pdf->SetFont('Times','B',12); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('_______________________'),0,0,'C',0);

// Titulo Recibio Legenda
$pdf->setXY(150,250);
$pdf->SetFont('Times','B',10); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('RECIBIO'),0,0,'C',0);

// Descripcion Recibio Legenda
$pdf->setXY(150,254);
$pdf->SetFont('Times','B',7); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('ALMACENISTA'),0,0,'C',0);



/* 

    AQUI FINALIZA SECCION SOBRE FIRMAS DE ENCARGADOS DE DEPARTAMENTOS

*/



// Descripcion Documento Legenda
$pdf->setXY(10,268);
$pdf->SetFont('Times','B',6); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('C.C.P. Almacén-Contabilidad'),0,0,'C',0);
$pdf->setXY(25,270);
$pdf->SetFont('Times','B',8); //elegir fuente
$pdf->Cell(22.4,6,utf8_decode('Fecha de aprobación: 04 de Septiembre de 2017'),0,0,'C',0);






$pdf->Output('I','ORDEN DE COMPRA NO. '.$ord[0]['orden'].'-'.$ord[0]['req'].'-'.$ord[0]['fecha'].'.pdf');
// $pdf->Output();



 
}
else
{ 
    echo'<script type="text/javascript">window.location.href="./";</script>';

}

?>
