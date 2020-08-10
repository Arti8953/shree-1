<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
    function __construct()
    {
        parent::__construct();
          // $this->load->model('Design_model');
    }
    //Page header
    public $invoice;
    public $data;
    public $Inword;
    // public function Get($data){
    //   $this->data = $data;
    // }
    public function Header() {
        // $this->invoice = new Invoice;
        // echo "<pre>";
        // echo print_r($this->data);
        // $image_file = 'https://i.ibb.co/L6L8BdC/Whats-App-Image-2019-09-18-at-17-58-51-51.jpg';
        // $image_file = base_url('optimum/images/tcpdf_logo2.jpg');
        // $data['data'] = $this->Design_model->get_single_value_by_id($id);
        // echo print_r($data['data']);exit;
       
        //  $image_file = base_url('optimum/admin/assets/images/hallabool_n.png');
        // $this->Image($image_file, 12, 10, 40, 12, 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->SetX(-80);
        // Set font
        $this->SetFont('times', 'B', 10,'', 'false');
        $date = "Date: ".my_date_show(current_datetime());
        // Title
        $this->Cell(0, 12, '', 0, false, 'C', 0, '', 0, false, 'S', 'S');

    }

    // Page footer
    // public function Footer() {
    //     // Position at 15 mm from bottom
    //     $this->SetY(-20);
    //     // Set font
    //     $this->SetFont('times', 'B', 10,'', 'false');
    //     // Page number
    //     $html = 'Office no 1102, 11th floor, Ambience Court, Phase 2, Sector 19E, Vashi, Navi Mumbai, Maharashtra 400703';
    //     $this->Cell(0, 0, $html, 0, false, 'C', 0, '', 0, false, 'A', 'A');
    //
    //     $this->SetY(-15);
    //     // Set font
    //     $this->SetFont('times', 'B', 10,'', 'false');
    //     $html1 = '+917800110563 | +919167373515 | info@rdpaymentsolutions.com | www.rdpaymentsolution.com';
    //     $this->Cell(0, 0, $html1, 0, false, 'C', 0, '', 0, false, 'A', 'A');
    //
    // }

    function date_show_time($date){
          if($date != ''){
              $date2 = date_create($date);
              $date_new = date_format($date2,"d M Y");
              return $date_new;
          }else{
              return '';
          }
      }

      function getIndianCurrency(float $number)
  		{
  			$decimal = round($number - ($no = floor($number)), 2) * 100;
  			$hundred = null;
  			$digits_length = strlen($no);
  			$i = 0;
  			$str = array();
  			$words = array(0 => '', 1 => 'one', 2 => 'two',
  					3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
  					7 => 'seven', 8 => 'eight', 9 => 'nine',
  					10 => 'ten', 11 => 'eleven', 12 => 'twelve',
  					13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
  					16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
  					19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
  					40 => 'forty', 50 => 'fifty', 60 => 'sixty',
  					70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
  			$digits = array('', 'hundred','thousand','lakh', 'crore');
  			while( $i < $digits_length ) {
  					$divider = ($i == 2) ? 10 : 100;
  					$number = floor($no % $divider);
  					$no = floor($no / $divider);
  					$i += $divider == 10 ? 1 : 2;
  					if ($number) {
  							$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
  							$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
  							$str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
  					} else $str[] = null;
  			}
  			$Rupees = implode('', array_reverse($str));
  			$paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
  			return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
  		}
}
