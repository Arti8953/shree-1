<?php
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 003');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}
$params = $pdf->serializeTCPDFtagParameters(array('CODE 128', 'C128', '', '', 80, 30, 0.4, array('position'=>'S', 'border'=>true, 'padding'=>4, 'fgcolor'=>array(0,0,0), 'bgcolor'=>array(255,255,255), 'text'=>true, 'font'=>'helvetica', 'fontsize'=>8, 'stretchtext'=>4), 'N'));

// ---------------------------------------------------------

$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,1),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);


// set font

$pdf->SetFont('times', 'B', 9,'', 'false');

// $date = my_date_show($data->created_date);
// add a page
$pdf->AddPage();
$image_file = base_url('optimum/admin/assets/images/hallabool_n.png');
$pdf->SetAlpha(0.2);
$pdf->Image($image_file, 60, 130, 90, 20, 'png', '', '', false, 300, '', false, false, 0, false, false, false);
    // $ojbect = $this->barcode->getBarCode($data->designCode);
    //  $ojbect->getBarcodeHTML(2, 30, 'black');
  // $pdf->Cell(0, 0, 'CODE 39 + CHECKSUM', 0, 1);
    //$pdf->write1DBarcode($data->barCode, 'C39+', '', '', '', 18, 0.4, $style, 'N');

/* NOTE:
 * *********************************************************
 * You can load external XHTML using :
 *
 * $html = file_get_contents('/path/to/your/file.html');
 *
 * External CSS files will be automatically loaded.
 * Sometimes you need to fix the path of the external CSS.
 * *********************************************************
 */

// define some HTML content with style

  



$html = <<<EOD
<style>

.main-text{
  text-align:center;
   height:40px;
}
.short {
 
 height:30px;


}

</style>

<table border="1">
  <tr><td colspan="2" class="main-text"><h3>Order Details</h3></td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Series Number</th><td>&nbsp;&nbsp;&nbsp;$data->serial_number</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fabric Name</th><td>&nbsp;&nbsp;&nbsp;$data->fabric_name</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HSN</th><td>&nbsp;&nbsp;&nbsp;$data->hsn</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order Number</th><td>&nbsp;&nbsp;&nbsp;$data->order_number</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Customer Name</th><td>&nbsp;&nbsp;&nbsp;$data->customer_name</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Design Barcode</th><td>&nbsp;&nbsp;&nbsp;$data->dbc</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Design Name</th><td>&nbsp;&nbsp;&nbsp;$data->design_name</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Design Code</th><td>&nbsp;&nbsp;&nbsp;$data->design_code</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stitch</th><td>&nbsp;&nbsp;&nbsp;$data->stitch</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dye</th><td>&nbsp;&nbsp;&nbsp;$data->dye</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Matching</th><td>&nbsp;&nbsp;&nbsp;$data->matching</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remark</th><td>&nbsp;&nbsp;&nbsp;$data->remark</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quntity</th><td>&nbsp;&nbsp;&nbsp;$data->quantity</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unit</th><td>&nbsp;&nbsp;&nbsp;$data->unit</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order Barcode</th><td>&nbsp;&nbsp;&nbsp;$data->order_barcode</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Priority</th><td>&nbsp;&nbsp;&nbsp;$data->priority</td></tr>
  <tr><th class="short">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Order Date</th><td>&nbsp;&nbsp;&nbsp;$data->created_at</td></tr>
  
</table>

EOD;

$pdf->SetAlpha(1);
// output the HTML content
 $pdf->writeHTML($html, true, false, true, false, '');

// print a block of text using Write()
// $pdf->Write(0, $html, '', 0, 'C', true, 0, false, false, 0);

// ---------------------------------------------------------

// add a page






// print a block of text using Write()
// $pdf->Write($txt, '', 0, 'C', true, 0, false, false, 0);
// $pdf->writeHTML($txt, '', 0, 'C', true, 0, false, false, 0);


//Close and output PDF document
$pdf->Output('example_003.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
