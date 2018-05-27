<?php
require('../../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
    function Header(){
        require('../../config/connection.php');
        $item = $_GET['item'];

<<<<<<< HEAD
        $query = mysqli_prepare($con, "SELECT OrgAppProfile_NAME,OrgVoucher_CASH_VOUCHER_NO,DATE_FORMAT(OrgVoucher_DATE_ADD, '%M %d, %Y ') AS DATEP,OrgVoucher_VOUCHED_BY, FORMAT(SUM(OrgVouchItems_AMOUNT), 2) AS AMOUNT,OrgForCompliance_ORG_CODE
=======
        $query = mysqli_prepare($con, "SELECT OrgAppProfile_NAME,OrgVoucher_CASH_VOUCHER_NO,DATE_FORMAT(OrgVoucher_DATE_ADD, '%M %d, %Y ') AS DATEP,OrgVoucher_VOUCHED_BY, FORMAT(SUM(OrgVouchItems_AMOUNT), 3) AS AMOUNT,OrgForCompliance_ORG_CODE
>>>>>>> 9fdc63ff3fa8d1675fe553a3a103e575ad78235a
        FROM `t_org_voucher` 
        INNER JOIN t_org_for_compliance ON OrgVoucher_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
        INNER JOIN t_org_voucher_items ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
        WHERE OrgVoucher_ID = ? ");
        mysqli_stmt_bind_param($query, 's', $item);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        while($row = mysqli_fetch_assoc($result)){
            $vouchnum = $row['OrgVoucher_CASH_VOUCHER_NO'];
            $name = $row['OrgAppProfile_NAME'];
            $date = $row['DATEP'];
            $vouchby = $row['OrgVoucher_VOUCHED_BY'];
            $orgcode = $row['OrgForCompliance_ORG_CODE'];
            $date = $row['DATEP'];
            $amount = $row['AMOUNT'];

        }    
        
        $picpath = '../../Avatar/'.$orgcode.'.png';


        if (file_exists($picpath)) {

        }
        else {
            $picpath = '../../Avatar/Default-Organization.png';
        }

        
        //Header Logo
        $this->Image('../../ASSETS/images/PUPLogo.png',10,6,24);
        $this->Image($picpath,182,6,24);
        // $this->Image('deped.png',162,9,22);

        //Header
        $this->SetFont('Arial','',10);
        $this->Cell(0,3,'Republic of the Philippines',0,0,'C');
        $this->Ln(5);


        $this->SetFont('Arial','',10);
        $this->Cell(0,3,'POLYTECHNIC UNIVERSITY OF THE PHILIPPINES',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Arial','B',10);
        $this->Cell(0,3,'QUEZON CITY BRANCH',0,0,'C');
        $this->Ln(12);

        $this->SetFont('Times','B',10);
        $this->Cell(0,0,$name,0,0,'C');  
        $this->Ln(5);
        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Don Fabian St. Barangay Commonwealth, Quezon City',0,0,'C');
        $this->Ln(14);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Office of the Student Affairs and Services',0,0,'C');  
        $this->Ln(5);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Student Organizational and Fund Request Form',0,0,'C');
        $this->Ln(10);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Cash '.$vouchnum,0,0,'L');  
        // $this->Ln(5);

        $this->Cell(0,0,'Date: '.$date,0,0,'R');
        $this->Ln(10);

        $view_query=mysqli_query($con, " SELECT UPPER(OSASHead_NAME) AS NAME FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active' ");
        while($row=mysqli_fetch_assoc($view_query)) {
            $osas=$row["NAME"];

        }

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'To:        '.$osas,0,0,'L'); 
        $this->Ln(5);  
        $this->Cell(0,0,'             Head, Student Affairs & Services',0,0,'L');
        $this->Ln(10);  

    }

    function headerTable(){
        $this->SetFont('Arial','',9);
        $this->Cell(165,5,'DESCRIPTION OF ITEM - COMELEC Fund contribution under COMELEC Memorandum 001 Series of 2017:',1,0,'L');
        $this->Cell(30,5,'Amount:',1,0,'C');
        $this->Ln();

        require('../../config/connection.php');
        $item = $_GET['item'];

<<<<<<< HEAD
        $query = mysqli_prepare($con, "SELECT OrgAppProfile_NAME,OrgVoucher_CASH_VOUCHER_NO,DATE_FORMAT(OrgVoucher_DATE_ADD, '%M %d, %Y ') AS DATEP,OrgVoucher_VOUCHED_BY, SUM(OrgVouchItems_AMOUNT) AS AMOUNT,FORMAT(SUM(OrgVouchItems_AMOUNT), 2) AS TAMOUNT,OrgForCompliance_ADVISER
=======
        $query = mysqli_prepare($con, "SELECT OrgAppProfile_NAME,OrgVoucher_CASH_VOUCHER_NO,DATE_FORMAT(OrgVoucher_DATE_ADD, '%M %d, %Y ') AS DATEP,OrgVoucher_VOUCHED_BY, SUM(OrgVouchItems_AMOUNT) AS AMOUNT,FORMAT(SUM(OrgVouchItems_AMOUNT), 3) AS TAMOUNT,OrgForCompliance_ADVISER
>>>>>>> 9fdc63ff3fa8d1675fe553a3a103e575ad78235a
        FROM `t_org_voucher` 
        INNER JOIN t_org_for_compliance ON OrgVoucher_ORG_CODE = OrgForCompliance_ORG_CODE
        INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
        INNER JOIN t_org_voucher_items ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
        WHERE OrgVoucher_ID = ? ");
        mysqli_stmt_bind_param($query, 's', $item);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        while($row = mysqli_fetch_assoc($result)){
            $vouchnum = $row['OrgVoucher_CASH_VOUCHER_NO'];
            $adviser = $row['OrgForCompliance_ADVISER'];
            $amount = $row['AMOUNT'];
            $totamount = $row['TAMOUNT'];

        }            
        
<<<<<<< HEAD
        $view_query = mysqli_query($con," SELECT OrgVouchItems_ITEM_NAME,FORMAT(OrgVouchItems_AMOUNT, 2) AS AMOUNT FROM t_org_voucher_items WHERE OrgVouchItems_DISPLAY_STAT = 'Active' AND OrgVouchItems_VOUCHER_NO = '$vouchnum' ");
=======
        $view_query = mysqli_query($con," SELECT OrgVouchItems_ITEM_NAME,FORMAT(OrgVouchItems_AMOUNT, 3) AS AMOUNT FROM t_org_voucher_items WHERE OrgVouchItems_DISPLAY_STAT = 'Active' AND OrgVouchItems_VOUCHER_NO = '$vouchnum' ");
>>>>>>> 9fdc63ff3fa8d1675fe553a3a103e575ad78235a
        while($row = mysqli_fetch_assoc($view_query))
        {
            $itemname = $row["OrgVouchItems_ITEM_NAME"];
            $itemamount = $row["AMOUNT"];
            
            $this->Cell(165,5,$itemname,1,0,'L');
            $this->Cell(30,5,'Php '.$itemamount,1,0,'C');
            $this->Ln();

        }
        $decimal = substr($amount,strlen($amount)-2,strlen($amount));
        

        
        $this->Cell(165,5,'Amount in words: '.getCurrency("$amount"),1,0,'L');
        $this->Cell(30,5,'Php '.$totamount,1,0,'C');
        $this->Ln(20);

    $this->Cell(0,0,'         Checked by:_______________________',0,0,'L');
    $this->Cell(0,0,'Approved by:_______________________            ',0,0,'R'); 
    $this->Ln(5);  
    $this->Cell(0,0,'                                    Business Manager',0,0,'L');
    $this->Cell(0,0,'President                            ',0,0,'R');

    $this->Ln(20);

    $this->Cell(0,0,'Noted by:          '.$adviser,0,0,'C');
    $this->Ln();
    
    $this->SetX(100); 
    $this->Cell(0,0,'______________________',0,0,'');  
    $this->Ln(5);
    $this->Cell(0,0,'                      Adviser',0,0,'C');  

    }

  

}
function getCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Hundred Thousand', 'Million');
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
    $paise = ($decimal) ? " and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Centavos' : '';
    return ($Rupees ? $Rupees . 'Pesos ' : '') . $paise ;
}

$pdf = new myPDF();
$pdf->SetTitle('Voucher Item'); 
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);
$pdf->headerTable();
$pdf->Output();
