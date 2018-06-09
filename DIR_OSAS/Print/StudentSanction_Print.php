<?php
require('../../ASSETS/fpdf17/fpdf.php');


class myPDF extends FPDF{
// Page header
    function Header(){
        require('../../config/connection.php');
        $Course = $_GET['Course'];
        $Year = $_GET['Year'];
        $Section = $_GET['Section'];
        
        $query = mysqli_prepare($con, "SELECT DATE_FORMAT(CURRENT_DATE, '%M %d, %Y ') AS DATEP ");
        mysqli_stmt_execute($query);
        $result = mysqli_stmt_get_result($query);

        while($row = mysqli_fetch_assoc($result)){
            $date = $row['DATEP'];

        }
//
//        
//        $picpath = '../../Avatar/'.$orgcode.'.jpg';
//
//
//        if (file_exists($picpath)) {
//
//        }
//        else {
//            $picpath = '../../Avatar/Default-Organization.png';
//        }


        //Header Logo
        $this->Image('../../ASSETS/images/PUPLogo.png',10,6,24);
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
        $this->Ln(5);
        
        
        $this->SetFont('Times','',10);
        $this->Cell(0,3,'Office of the Student Affairs and Services',0,0,'C');
        $this->Ln(5);

        $this->SetFont('Times','',10);
        $this->Cell(0,0,'Student Sanction',0,0,'C');
        $this->Ln(5);
        
        $classifyby = '';
        
        if($Course != 'Default'){
            $classifyby = $classifyby . $Course;
        }
        if($Year != 'Default'){
            if($Year == '1'){
                $classifyby = $classifyby .' First Year' ;
            }
            else if($Year == '2'){
                $classifyby = $classifyby .' Second Year' ;
            }
            else if($Year == '3'){
                $classifyby = $classifyby .' Third Year' ;                
            }
            else if($Year == '4'){
                $classifyby = $classifyby .' Fourth Year' ;                
            }
            else if($Year == '5'){
                $classifyby = $classifyby .' Fifth Year' ;                
            }
            
        }
        if($Section != 'Default'){
            $classifyby = $classifyby .' Section ' . $Section;
        }
        
        $this->SetFont('Times','',10);
        $this->Cell(0,0,$classifyby,0,0,'C');
        $this->Ln(5);
        
        


        $this->Cell(0,0,'Date: '.$date,0,0,'R');
        $this->Ln(10);

    }
// Page footer
    function Footer(){
        $this->SetFont('Times','',10);
        $this->SetXY(120,-50);
        $this->Cell(0,3,'T H I S      R E P O R T     I S     G E N E R A T E D     B Y     T H E     S Y S T E M',0,0,'');
        $this->Ln();

        $this->SetX(10);
        $this->SetFont('Times','B',28);
        $this->Cell(0,0,'____________________________________________________________________',0,0,'');
        $this->Ln();

        $this->SetFont('Times','',10);
        $this->SetXY(115,-40);
        $this->Cell(0,3,'Rothlener Bldg., PUP Quezon City Branch, Don Fabian St., Commonwealth Quezon City ',0,0,'');
        $this->Ln();

        $this->SetFont('Times','',10);
        $this->SetXY(140,-35);
        $this->Cell(0,3,'Phone: (Direct Lines) 9527817; 4289144; 9577817 ',0,0,'');
        $this->Ln();

        $this->SetFont('Times','',10);
        $this->SetXY(130,-30);
        $this->Cell(0,3,'Email: commonwealth@pup.edu.ph/ Website: www.pup.edu.ph ',0,0,'');
        $this->Ln();

        $this->SetFont('Times','',10);
        $this->SetXY(155,-25);
        $this->Cell(0,3,'"The Countrys 1st Polytechnic U"',0,0,'');
        $this->Ln();

        $this->SetY(-20);
        $this->SetFont('Times','I',8);
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

    }
    function headerTable(){
        $this->SetFont('Arial','',8);
        $this->SetFillColor(220,220,220);
        $this->Cell(30,5,'DATE',1,0,'C',true);
        $this->Cell(60,5,'FULL NAME',1,0,'C',true);
        $this->Cell(55,5,'CASE',1,0,'C',true);
        $this->Cell(30,5,'SANCTION',1,0,'C',true);
        $this->Cell(55,5,'DESIGNATION',1,0,'C',true);
        $this->Cell(50,5,'COMPLETION DATE',1,0,'C',true);
        $this->Cell(55,5,'REMARKS',1,0,'C',true);
        $this->Ln();

        require('../../config/connection.php');
        $item = '';    

        foreach (explode(',', $_GET['items']) as $data) {
            $item = $item . ",'".$data."'";
        }
        $view_query = mysqli_query($con, "select RSP.Stud_ID as ID
                                    ,RSP.Stud_NO ,CONCAT(RSP.Stud_LNAME,', ',RSP.Stud_FNAME,' ',COALESCE(RSP.Stud_MNAME,'')) as FullName
                                    ,CONCAT(RSP.Stud_COURSE,' ',RSP.Stud_YEAR_LEVEL,'-',RSP.Stud_SECTION) as Course
                                    ,RSP.Stud_EMAIL
                                    ,RSP.Stud_MOBILE_NO
                                    ,RSP.Stud_GENDER
                                    ,RSP.Stud_BIRTH_DATE
                                    ,RSP.Stud_BIRTH_PLACE
                                    ,RSP.Stud_STATUS
                                    ,RSP.Stud_CITY_ADDRESS
                                    ,RSP.Stud_DATE_ADD
                                        FROM osas.r_stud_profile RSP
                                        INNER JOIN r_stud_batch SB on  RSP.Stud_NO = SB.Stud_NO
                                        INNER JOIN active_academic_year AY on SB.Batch_YEAR = ay.ActiveAcadYear_Batch_YEAR AND  Stud_DISPLAY_STATUS='active'
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 AND RSP.Stud_NO IN ('0'".$item.") GROUP BY RSP.Stud_NO  ORDER BY ay.ActiveAcadYear_ID desc   ");
                while($row = mysqli_fetch_assoc($view_query))
                {
                    
                    $studno = $row["Stud_NO"];
                    $fullname = $row["FullName"];
                    $course = $row["Course"];
                    $status = $row["Stud_STATUS"];
                    
//                    $view_query2 = mysqli_query($con, "SELECT (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE = b.SancDetails_CODE and b.SancDetails_DISPLAY_STAT='Active' WHERE a.AssSancStudStudent_STUD_NO = '$studno' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive'  and a.AssSancStudStudent_IS_FINISH <>'finished') AS R1, (SELECT COUNT(a.AssSancStudStudent_STUD_NO) FROM t_assign_stud_saction a inner join r_sanction_details b on a.AssSancStudStudent_SancDetails_CODE= b.SancDetails_CODE WHERE a.AssSancStudStudent_STUD_NO  = '$studno' and a.AssSancStudStudent_IS_FINISH ='finished' and a.AssSancStudStudent_DISPLAY_STAT <> 'Inactive' ) AS R2");
//                    while($row2 = mysqli_fetch_assoc($view_query2))
//                    {
//                        $r1 = $row2["R1"];
//                        $r2 = $row2["R2"];                        
//                    }                    
                    $view_query2 = mysqli_query($con, "SELECT DATE(AssSancStudStudent_DATE_ADD) AS DATE,SancDetails_NAME,DesOffDetails_NAME,AssSancStudStudent_REMARKS,AssSancStudStudent_TO_BE_DONE,AssSancStudStudent_CONSUMED_HOURS FROM t_assign_stud_saction 
                        INNER JOIN r_designated_offices_details ON AssSancStudStudent_DesOffDetails_CODE = DesOffDetails_CODE
                        INNER JOIN r_sanction_details ON AssSancStudStudent_SancDetails_CODE = SancDetails_CODE
                    WHERE AssSancStudStudent_STUD_NO = '$studno' AND AssSancStudStudent_DISPLAY_STAT = 'Active'  ");
                    while($row2 = mysqli_fetch_assoc($view_query2))
                    {
                        $createddate = $row2["DATE"];
                        $sanctionname = $row2["SancDetails_NAME"];
                        $designationname = $row2["DesOffDetails_NAME"];
                        $remarks = $row2["AssSancStudStudent_REMARKS"];
                        $date = $row2["AssSancStudStudent_TO_BE_DONE"];
                        $hrs = $row2["AssSancStudStudent_CONSUMED_HOURS"];                        

                        $this->Cell(30,5,$createddate,1,0,'C');
                        $this->Cell(60,5,$fullname,1,0,'C');
                        $this->Cell(55,5,$sanctionname,1,0,'C');
                        $this->Cell(30,5,$hrs,1,0,'C');
                        $this->Cell(55,5,$designationname,1,0,'C');
                        $this->Cell(50,5,$date,1,0,'C');
                        $this->Cell(55,5,$remarks,1,0,'C');
                        $this->Ln();
                
                    }
                    
                                        
//                    $this->Cell(40,10,$studno,1,0,'C');
//                    $this->Cell(70,10,$fullname,1,0,'C');
//                    $this->Cell(27,10,$course,1,0,'C');
//                    if($r1 > 0)
//                        $this->Cell(25,10,'Not Cleared',1,0,'C');
//                    else 
//                        $this->Cell(25,10,'Cleared',1,0,'C');
//                    
//                    $this->Cell(30,10,$status,1,0,'C');
//                    $this->Ln();
                    
                }
        
        
    }



}
$pdf = new myPDF();
$pdf->SetTitle('Student Sanction');
$pdf->AliasNbPages();
$pdf->AddPage('L','Legal',0);
$pdf->headerTable();
$pdf->Output();
