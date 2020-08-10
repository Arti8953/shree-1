<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf_barcodes_1d.php';

class Barcode
{
    public function getBarCode($code,$key='C128'){
    $barcodeobj = new TCPDFBarcode($code, $key);
      return $barcodeobj;
    }

}
