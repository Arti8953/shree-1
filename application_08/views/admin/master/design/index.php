<?php
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 050');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 050', PDF_HEADER_STRING);

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
// ---------------------------------------------------------
// set style for barcode
$style = array(
    'position' => 'L',
    'align' => 'L',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => false,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255),
    'text' => TRUE,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);
// set font

$pdf->SetFont('times', 'B', 9,'', 'false');

// $date = my_date_show($data->created_date);
// add a page
$pdf->AddPage();

// chmod($image_file, 0600);

$style['position'] = 'L';
$pdf->write1DBarcode($data->barCode, 'C128', '', 30, '', 16, 0.4, $style, 'T');
$style['position'] = 'C';
$pdf->write1DBarcode($data->barCode, 'C128', '', 30, '', 16, 0.4, $style, 'T');
$style['position'] = 'R';
$pdf->write1DBarcode($data->barCode, 'C128', '', 30, '', 16, 0.4, $style, 'T');
$pdf->Ln(0);


$html = <<<EOD
<style>

.main-text{
  text-align:left;
}
</style>
<table border="1">
  <tr class="first_part">
    <td>
      <table>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN NAME :- </td>
          <td class="main-text"> $data->designName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN SER :- </td>
          <td class="main-text"> $data->designSeries</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN CODE :- </td>
          <td class="main-text">$data->desCode</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; FABRIC :- </td>
          <td class="main-text">$data->fabricName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DYE :- </td>
          <td class="main-text">$data->dye</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; MATCHING :- </td>
          <td class="main-text">$data->matching</td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN NAME :- </td>
          <td class="main-text"> $data->designName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN SER :- </td>
          <td class="main-text"> $data->designSeries </td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN CODE :- </td>
          <td class="main-text"> $data->desCode</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; FABRIC :- </td>
          <td class="main-text"> $data->fabricName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DYE :- </td>
          <td class="main-text"> $data->dye</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; MATCHING :- </td>
          <td class="main-text"> $data->matching</td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
    <td>
      <table>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td colspan="2" class="align-center main-text"></td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN NAME :- </td>
          <td class="main-text"> $data->designName</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN SER :- </td>
          <td class="main-text"> $data->designSeries</td>
        </tr>
        <tr>
          <td> &nbsp;&nbsp; DESIGN CODE :- </td>
          <td class="main-text">$data->desCode</td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
EOD;

$pdf->writeHTML($html, true, false, true, false, '');
//Close and output PDF document



$pdf->Output('example_050.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
