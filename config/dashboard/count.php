<?php
include('../config/connection.php');
$count_stud = 0;
$count_registered_org =0;
$count_stud_sanction = 0;
$count_stud_financial_assistance = 0;
$count_stud_LossIDRegiCard=0;
    
$count_stud_LossIDRegiCard = mysqli_num_rows(mysqli_query($con,"SELECT `AssLoss_STUD_NO` 
FROM t_assign_stud_loss_id_regicard 
where `AssLoss_DISPLAY_STAT` <> 'Inactive'
GROUP BY `AssLoss_STUD_NO`"));
$count_stud = mysqli_num_rows(mysqli_query($con,"select RSP.Stud_ID as ID
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
                                        AND ay.ActiveAcadYear_IS_ACTIVE=1 ORDER BY ay.ActiveAcadYear_ID desc"));
 
$count_stud_sanction = mysqli_num_rows(mysqli_query($con,"SELECT count(A.Stud_NO )
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
AND B.AssSancStudStudent_CONSUMED_HOURS <> C.SancDetails_TIMEVAL
group by a.Stud_NO ") );
 
$count_stud_financial_assistance = mysqli_num_rows( mysqli_query($con,"select a.AssStudFinanAssistance_STUD_NO from t_assign_stud_finan_assistance a 
inner join r_financial_assistance_title b on b.FinAssiTitle_NAME = a.AssStudFinanAssistance_FINAN_NAME
and b.FinAssiTitle_DISPLAY_STAT <> 'Inactive'
inner join r_stud_profile c on c.Stud_NO = a.AssStudFinanAssistance_STUD_NO
and c.Stud_DISPLAY_STATUS <> 'Inactive'
and a.AssStudFinanAssistance_DISPLAY_STAT <> 'Inactive'
GROUP by a.AssStudFinanAssistance_STUD_NO"));

?>
