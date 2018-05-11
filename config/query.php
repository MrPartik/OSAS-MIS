<?php 
include ('connection.php');    
$view_studProfile_cond = "";
$view_studSanctionCond ="";
$view_studSanctionComputation="";
$view_studSanctionDetails ="";
$view_studFinanCond ="";
$view_studLossCond="";
$view_orgVoucherCustomQuery ="";



                function dateNow()
                {
                    return  date('D M d, Y h:i A');
                }
                function view_orgVoucherCustom($OrgCode) 
                {
                    include ('connection.php');    
                    global $view_studLossCond;
                    $view_orgVoucherCustomQuery = mysqli_query($con,"SELECT * FROM t_org_voucher v
                    INNER JOIN t_org_for_compliance OC on v.OrgVoucher_ORG_CODE = oc.OrgForCompliance_ORG_CODE
                    INNER JOIN r_org_applicant_profile OP on OP.OrgAppProfile_APPL_CODE = OC.OrgForCompliance_OrgApplProfile_APPL_CODE
                    INNER JOIN active_academic_year AY on AY.ActiveAcadYear_Batch_YEAR = OC.OrgForCompliance_BATCH_YEAR
                    AND  ay.ActiveAcadYear_IS_ACTIVE = 1 AND ay.ActiveAcadYear_ID = (SELECT MAX(ay.ActiveAcadYear_ID))");
                    
                    
                    
                }
                function viewStud_LossCond($ID,$StudNo) 
                {
                    include ('connection.php');    
                    global $view_studLossCond;
                    $view_studLossCond = mysqli_query($con,"SELECT  `AssLoss_ID` ID
                                        ,`AssLoss_STUD_NO` StudNo
                                        ,`AssLoss_TYPE` type
                                         ,`AssLoss_REMARKS` remarks
                                         ,`AssLoss_DATE_CLAIM` claim
                                        ,`AssLoss_DATE_ADD` start 
                                        ,`AssLoss_DATE_MOD` mods
                                        ,`AssLoss_DISPLAY_STAT` display
                                        FROM t_assign_stud_loss_id_regicard
                                        where (`AssLoss_STUD_NO` = '$StudNo'
                                        or `AssLoss_ID` = $ID )
                                        and `AssLoss_DISPLAY_STAT` <>'Inactive' ");
                }
                function viewFinanStudCond($ID,$StudNo)
                {
                    include ('connection.php');    
                    global $view_studFinanCond;
                    $view_studFinanCond = mysqli_query($con,"SELECT 
                                        B.AssStudFinanAssistance_ID AssID
                                        ,B.AssStudFinanAssistance_DATE_ADD Start
                                        ,B.AssStudFinanAssistance_DATE_MOD Mods
                                        ,A.Stud_NO
                                        ,CONCAT(A.Stud_LNAME,', ',A.Stud_FNAME,' ',COALESCE(A.Stud_MNAME,'')) AS FullName 
                                        ,A.Stud_EMAIL
                                        ,A.Stud_CONTACT_NO
                                        ,b.AssStudFinanAssistance_REMARKS remarks
                                        ,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,'-',Stud_SECTION) as Course
                                        ,B.AssStudFinanAssistance_STATUS as Status
                                        ,B.AssStudFinanAssistance_FINAN_NAME as Finan_Name
                                        ,C.FinAssiTitle_DESC FinanDesc
                                        ,C.FinAssiTitle_DESC as Finan_Desc
                                        ,b.AssStudFinanAssistance_ID as ID
                                        FROM r_stud_profile a
                                        right join t_assign_stud_finan_assistance b
                                        on a.Stud_NO =b.AssStudFinanAssistance_STUD_NO
                                        inner join r_financial_assistance_title c 
                                        on b.AssStudFinanAssistance_FINAN_NAME = c.FinAssiTitle_NAME
                                        WHERE
                                        a.Stud_DISPLAY_STATUS = 'Active'
                                        and b.AssStudFinanAssistance_DISPLAY_STAT <> 'Inactive'
                                        and c.FinAssiTitle_DISPLAY_STAT <> 'Inactive' and
                                        ( a.Stud_NO = '$StudNo'
                                        or b.AssStudFinanAssistance_ID = $ID)");
                }
                function viewStudProfileCond($StudID,$Studno)
                {
                    include ('connection.php');    
                    global $view_studProfile_cond; 
                    $view_studProfile_cond = mysqli_query($con,"select Stud_ID as ID ,Stud_NO ,Stud_LNAME,Stud_FNAME,Stud_MNAME,CONCAT(Stud_LNAME,', ',Stud_FNAME,' ',COALESCE(Stud_MNAME,'')) as FullName ,Stud_COURSE,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,'-',Stud_SECTION) as Course ,Stud_EMAIL , Stud_SECTION,Stud_CONTACT_NO ,Stud_GENDER ,Stud_BIRHT_DATE ,Stud_BIRTH_PLACE ,Stud_STATUS ,Stud_ADDRESS FROM osas.r_stud_profile where (Stud_id = $StudID or Stud_NO= '$Studno') and Stud_DISPLAY_STATUS='active'"); 
                }
                function viewStudSanctionCond($StudNO)
                {
                    include ('connection.php');    
                    global $view_studSanctionCond;
                    $view_studSanctionCond = mysqli_query($con,"SELECT A.Stud_NO
                                    ,CONCAT(A.Stud_LNAME,', ',A.Stud_FNAME,' ',COALESCE(A.Stud_MNAME,'')) AS FullName
                                    ,C.SancDetails_NAME AS SanctionName
                                    ,C.SancDetails_TIMEVAL AS TimeVal
                                    ,D.DesOffDetails_NAME AS Office
                                    ,b.AssSancStudStudent_CONSUMED_HOURS AS Consumed
                                    ,b.AssSancStudStudent_DATE_ADD AS start
                                    ,b.AssSancStudStudent_DATE_MOD as mods
                                    FROM r_stud_profile A
                                    INNER JOIN  t_assign_stud_saction B ON 
                                        A.Stud_NO = B.AssSancStudStudent_STUD_NO
                                    INNER JOIN r_sanction_details C ON
                                        C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE
                                    INNER JOIN r_designated_offices_details D ON
                                        D.DesOffDetails_CODE = B.AssSancStudStudent_DesOffDetails_CODE 
                                    WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
                                    AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
                                    AND C.SancDetails_DISPLAY_STAT='ACTIVE'
                                    AND D.DesOffDetails_DISPLAY_STAT='ACTIVE'
                                    AND B.AssSancStudStudent_IS_FINISH<>'FINISHED'
                                    AND A.Stud_NO = '$StudNO'
                                    AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL ");
                }
         
                function viewStudSanctionComputation($StudNO)
                {
                    include ('connection.php');    
                    global $view_studSanctionComputation;
                    $view_studSanctionComputation = mysqli_query($con,"SELECT A.Stud_NO  
                                    ,SUM(C.SancDetails_TIMEVAL) AS TimeVal 
                                    ,SUM(B.AssSancStudStudent_CONSUMED_HOURS) AS Consumed
                                    ,(SUM(C.SancDetails_TIMEVAL) - SUM(B.AssSancStudStudent_CONSUMED_HOURS)) AS TOTAL
                                    ,((SUM(B.AssSancStudStudent_CONSUMED_HOURS)/ SUM(C.SancDetails_TIMEVAL))*100) AS Percentage
                                    FROM r_stud_profile A
                                    INNER JOIN  t_assign_stud_saction B ON
                                        A.Stud_NO = B.AssSancStudStudent_STUD_NO
                                    INNER JOIN r_sanction_details C ON
                                        C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE 
                                    WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
                                    AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
                                    AND C.SancDetails_DISPLAY_STAT='ACTIVE' 
                                    AND B.AssSancStudStudent_IS_FINISH<>'FINISHED'
                                    AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL
                                    AND A.Stud_NO = '$StudNO'
                                    GROUP BY A.Stud_NO");
                } 
            
            function view_studSanctionDetails($StudNo)
            {
                include ('connection.php');    
                global $view_studSanctionDetails;
                $view_studSanctionDetails= mysqli_query($con,"SELECT B.AssSancStudStudent_ID AssSancID
                                    ,A.Stud_NO
                                    ,CONCAT(A.Stud_LNAME,', ',A.Stud_FNAME,' ',COALESCE(A.Stud_MNAME,'')) AS FullName
                                    ,C.SancDetails_NAME AS SanctionName
                                    ,C.SancDetails_TIMEVAL AS TimeVal
                                    ,D.DesOffDetails_NAME AS Office
                                    ,b.AssSancStudStudent_CONSUMED_HOURS AS Consumed
                                    ,B.AssSancStudStudent_IS_FINISH AS FINISHED
                                    ,B.AssSancStudStudent_DATE_ADD Start
                                    ,B.AssSancStudStudent_DATE_MOD Mods
                                    ,B.AssSancStudStudent_REMARKS Remarks
                                    ,B.AssSancStudStudent_TO_BE_DONE Done
                                    FROM r_stud_profile A
                                    INNER JOIN  t_assign_stud_saction B ON
                                        A.Stud_NO = B.AssSancStudStudent_STUD_NO
                                    INNER JOIN r_sanction_details C ON
                                        C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE
                                    INNER JOIN r_designated_offices_details D ON
                                        D.DesOffDetails_CODE = B.AssSancStudStudent_DesOffDetails_CODE 
                                    WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
                                    AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
                                    AND C.SancDetails_DISPLAY_STAT='ACTIVE'
                                    AND D.DesOffDetails_DISPLAY_STAT='ACTIVE'
                                    AND A.Stud_NO ='$StudNo'
                                    ORDER BY B.AssSancStudStudent_DATE_MOD DESC");
}

$view_studSanction = mysqli_query($con,"SELECT B.AssSancStudStudent_ID AssSancID
                                    ,A.Stud_NO
                                    ,CONCAT(A.Stud_LNAME,', ',A.Stud_FNAME,' ',COALESCE(A.Stud_MNAME,'')) AS FullName
                                    ,C.SancDetails_NAME AS SanctionName
                                    ,C.SancDetails_TIMEVAL AS TimeVal
                                    ,D.DesOffDetails_NAME AS Office
                                    ,b.AssSancStudStudent_CONSUMED_HOURS AS Consumed
                                    FROM r_stud_profile A
                                    INNER JOIN  t_assign_stud_saction B ON
                                        A.Stud_NO = B.AssSancStudStudent_STUD_NO
                                    INNER JOIN r_sanction_details C ON
                                        C.SancDetails_CODE = B.AssSancStudStudent_SancDetails_CODE
                                    INNER JOIN r_designated_offices_details D ON
                                        D.DesOffDetails_CODE = B.AssSancStudStudent_DesOffDetails_CODE 
                                    WHERE A.Stud_DISPLAY_STATUS='ACTIVE'
                                    AND B.AssSancStudStudent_DISPLAY_STAT='ACTIVE'
                                    AND C.SancDetails_DISPLAY_STAT='ACTIVE'
                                    AND D.DesOffDetails_DISPLAY_STAT='ACTIVE' 
                                    AND B.AssSancStudStudent_IS_FINISH<>'FINISHED'
                                    AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL ");


$view_studProfile = mysqli_query($con,"select Stud_ID as ID 
                                    ,Stud_NO ,CONCAT(Stud_LNAME,', ',Stud_FNAME,' ',COALESCE(Stud_MNAME,'')) as FullName 
                                    ,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,'-',Stud_SECTION) as Course
                                    ,Stud_EMAIL ,Stud_CONTACT_NO 
                                    ,Stud_GENDER 
                                    ,Stud_BIRHT_DATE
                                    ,Stud_BIRTH_PLACE 
                                    ,Stud_STATUS 
                                    ,Stud_ADDRESS
                                    ,Stud_DATE_ADD  
                                        FROM osas.r_stud_profile 
                                    where Stud_DISPLAY_STATUS='active'"); 

$current_semster_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM  active_semester where `ActiveSemester_IS_ACTIVE` =1 and `ActiveSemester_ID` = (SELECT MAX(`ActiveSemester_ID`) FROM active_semester A 
INNER JOIN r_semester B ON A.ActiveSemester_SEMESTRAL_NAME = B.Semestral_NAME AND B.Semestral_DISPLAY_STAT='ACTIVE' WHERE A.ActiveSemester_IS_ACTIVE =1 )"));

$current_semster = $current_semster_query['ActiveSemester_SEMESTRAL_NAME'];

$current_acadyear_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM  active_academic_year where `ActiveAcadYear_IS_ACTIVE` =1 and `ActiveAcadYear_ID` = (SELECT MAX(`ActiveAcadYear_ID`) FROM active_academic_year A 
INNER JOIN r_batch_details B ON A.ActiveAcadYear_Batch_YEAR = B.Batch_YEAR AND B.Batch_DISPLAY_STAT='ACTIVE' WHERE A.ActiveAcadYear_IS_ACTIVE =1 )"));

$current_acadyear = $current_acadyear_query['ActiveAcadYear_Batch_YEAR'];
 
$view_course = mysqli_query($con,"select * from r_courses where course_display_stat ='active'"); 

$view_orgVoucher = mysqli_query($con,"SELECT * FROM t_org_voucher v
INNER JOIN t_org_for_compliance OC on v.OrgVoucher_ORG_CODE = oc.OrgForCompliance_ORG_CODE
INNER JOIN r_org_applicant_profile OP on OP.OrgAppProfile_APPL_CODE = OC.OrgForCompliance_OrgApplProfile_APPL_CODE
INNER JOIN active_academic_year AY on AY.ActiveAcadYear_Batch_YEAR = OC.OrgForCompliance_BATCH_YEAR
AND ay.ActiveAcadYear_IS_ACTIVE = 1 AND ay.ActiveAcadYear_ID = (SELECT MAX(ay.ActiveAcadYear_ID))");

$view_availOrgVouch =mysqli_query($con,"SELECT * FROM t_org_for_compliance OC
INNER JOIN r_org_applicant_profile OP on OP.OrgAppProfile_APPL_CODE = OC.OrgForCompliance_OrgApplProfile_APPL_CODE
INNER JOIN active_academic_year AY on AY.ActiveAcadYear_Batch_YEAR = OC.OrgForCompliance_BATCH_YEAR
AND ay.ActiveAcadYear_IS_ACTIVE = 1 AND ay.ActiveAcadYear_ID = (SELECT MAX(ay.ActiveAcadYear_ID)) 
WHERE (SELECT COUNT(AAP.OrgAccrProcess_IS_ACCREDITED) FROM t_org_accreditation_process AAP WHERE AAP.OrgAccrProcess_IS_ACCREDITED=1 AND AAP.OrgAccrProcess_DISPLAY_STAT='Active' AND AAP.OrgAccrProcess_ORG_CODE = OC.OrgForCompliance_ORG_CODE)=(SELECT COUNT(ad.OrgAccrDetail_CODE) FROM r_org_accreditation_details AD )");
$registered_org_query =mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(a.OrgForCompliance_ORG_CODE) as counts FROM t_org_for_compliance a WHERE a.OrgForCompliance_BATCH_YEAR ='$current_acadyear' and a.OrgForCompliance_DISPAY_STAT='Active'"));
$count_registered_org = $registered_org_query["counts"];
$pending_acc_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(a.OrgForCompliance_ORG_CODE) as counts FROM t_org_for_compliance a 
WHERE a.OrgForCompliance_BATCH_YEAR ='$current_acadyear' AND a.OrgForCompliance_DISPAY_STAT='Active' 
AND (SELECT COUNT(b.OrgAccrProcess_ORG_CODE) FROM t_org_accreditation_process b WHERE b.OrgAccrProcess_IS_ACCREDITED=1 AND b.OrgAccrProcess_DISPLAY_STAT ='Active' AND a.OrgForCompliance_ORG_CODE = b.OrgAccrProcess_ORG_CODE) = (SELECT COUNT(c.OrgAccrDetail_CODE) FROM r_org_accreditation_details c WHERE c.OrgAccrDetail_DISPLAY_STAT='Active')"));
$count_pending_acc = $pending_acc_query["counts"];

$financial_ass_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT COUNT(a.AssStudFinanAssistance_STUD_NO) as countss FROM t_assign_stud_finan_assistance a WHERE a.AssStudFinanAssistance_DISPLAY_STAT='Active'"));
$count_finan_ass = $financial_ass_query["countss"];

$count_notif_query = mysqli_fetch_assoc(mysqli_query($con,"SELECT  count(Notification_RECEIVER) as countt FROM `r_notification` 
WHERE Notification_RECEIVER = (SELECT OSASHead_CODE FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active')
AND 
(SELECT OrgRemittance_APPROVED_STATUS FROM T_ORG_REMITTANCE WHERE OrgRemittance_NUMBER = Notification_ITEM) = 'Pending' 
OR (SELECT OrgEvent_STATUS FROM r_org_event_management WHERE OrgEvent_Code = Notification_ITEM) = 'Pending'
ORDER BY Notification_DATE_ADDED DESC"))or die("0");
$count_notif = $count_notif_query["countt"];


?>