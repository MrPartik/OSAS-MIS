<?php
require('../../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
    function Header(){
        require('../../config/connection.php');
        $item = $_GET['items'];
        $orgc = $_GET['Organization'];

        $query = mysqli_prepare($con, "SELECT OrgForCompliance_ORG_CODE,OrgAppProfile_NAME,OrgForCompliance_BATCH_YEAR,DATE_FORMAT(DATE(CURRENT_TIMESTAMP),'%M %d, %Y') AS DATEISSUED,OrgForCompliance_BATCH_YEAR FROM `t_org_for_compliance` 
	INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE  
    WHERE OrgForCompliance_ORG_CODE = ? ");
        mysqli_stmt_bind_param($query, 's', $orgc);
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        while($row = mysqli_fetch_assoc($result)){
            $name = $row["OrgAppProfile_NAME"];
            $byear = $row["OrgForCompliance_BATCH_YEAR"];
            $orgcode = $row["OrgForCompliance_ORG_CODE"];
            $byear = $row["OrgForCompliance_BATCH_YEAR"];
            $date = $row["DATEISSUED"];

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

        $this->SetFont('Arial','',10);
        $this->Cell(0,3,'QUEZON CITY BRANCH',0,0,'C');
        $this->Ln(12);

        $this->SetFont('Times','B',10);
        $this->Cell(0,0,$name,0,0,'C');  
        $this->Ln(5);       
        $this->SetFont('Times','',9);
        $this->Cell(0,0,'Batch of '.$byear,0,0,'C');  
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

        // $this->Ln(5);

        $this->Cell(0,0,'Date: '.$date,0,0,'R');
        $this->Ln(10);


        $this->SetFont('Arial','B',8);
        $this->SetFillColor(220,220,220);
        $this->Cell(45,5,'STUDENT NUMBER',1,0,'C',true);
        $this->Cell(50,5,'NAME:',1,0,'C',true);
        $this->Cell(50,5,'COURSE - YEAR AND SECTION:',1,0,'C',true);
        $this->Cell(50,5,'POSITION:',1,0,'C',true);
        $this->Ln();

    }
   function Footer(){
        $this->SetFont('Times','',10);
        $this->SetXY(50,-50);
        $this->Cell(0,3,'T H I S      R E P O R T     I S     G E N E R A T E D     B Y     T H E     S Y S T E M',0,0,'');
        $this->Ln();

        $this->SetX(10);        
        $this->SetFont('Times','B',28);
        $this->Cell(0,0,'_______________________________________',0,0,'');  
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(46,-40);
        $this->Cell(0,3,'Rothlener Bldg., PUP Quezon City Branch, Don Fabian St., Commonwealth Quezon City ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(70,-35);
        $this->Cell(0,3,'Phone: (Direct Lines) 9527817; 4289144; 9577817 ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(60,-30);
        $this->Cell(0,3,'Email: commonwealth@pup.edu.ph/ Website: www.pup.edu.ph ',0,0,'');
        $this->Ln();
        
        $this->SetFont('Times','',10);
        $this->SetXY(85,-25);
        $this->Cell(0,3,'"The Countrys 1st Polytechnic U"',0,0,'');
        $this->Ln();
        
        $this->SetY(-20);
        $this->SetFont('Times','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        
    }
    function headerTable(){

        require('../../config/connection.php');
        $item = '';
        foreach (explode(',', $_GET['items']) as $data) {
            $item=$item . ",'".$data."'";
        }
        $orgc = $_GET['Organization'];


        $view_query = mysqli_query($con," SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,' ', IFNULL(Stud_MNAME,''))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS, IFNULL((SELECT OrgOffiPosDetails_NAME FROM r_org_officer_position_details 
		INNER JOIN t_org_officers ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
 	WHERE OrgOffi_DISPLAY_STAT = 'Active' AND OrgOffi_STUD_NO = Stud_NO  AND OrgOffiPosDetails_DISPLAY_STAT = 'Active' AND OrgOffiPosDetails_ORG_CODE = '$orgc'   ),'Member') AS POS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        LEFT JOIN t_org_officers  ON OrgOffi_STUD_NO = AssOrgMem_STUD_NO       
        LEFT JOIN r_org_officer_position_details ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
        WHERE AssOrgMem_DISPLAY_STAT = 'Active'  AND AssOrgMem_COMPL_ORG_CODE = '$orgc'  AND AssOrgMem_STUD_NO IN ('1'".$item.") GROUP BY Stud_NO ");
        while($row = mysqli_fetch_assoc($view_query)){
            $name = $row["NAME"];
            $no = $row["Stud_NO"];
            $cas = $row["CAS"];
            $pos = $row["POS"];
            


            $this->SetFont('Arial','',8);
            $this->Cell(45,5,$name,1,0,'L');
            $this->Cell(50,5,$no,1,0,'C');
            $this->Cell(50,5,$cas,1,0,'C');
            $this->Cell(50,5,$pos,1,0,'C');
            $this->Ln();

            
        }            

    }

  

}

$pdf = new myPDF();
$pdf->SetTitle('Organization Member'); 
$pdf->AliasNbPages();
$pdf->AddPage('P','Legal',0);
$pdf->headerTable();
$pdf->Output();
