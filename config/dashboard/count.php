<?php
include('../config/connection.php');
$count_stud = 0;
$count_registered_org =0;
$count_stud_sanction = 0;
$count_stud_financial_assistance = 0;
$count_stud_LossIDRegiCard=0;
    
$count_stud_LossIDRegiCard = mysql_num_rows(mysql_query("SELECT `AssLoss_STUD_NO` 
FROM t_assign_stud_loss_id_regicard 
where `AssLoss_DISPLAY_STAT` <> 'Inactive'
GROUP BY `AssLoss_STUD_NO`"));
$count_stud = mysql_num_rows(mysql_query("select stud_no from r_stud_profile where Stud_DISPLAY_STATUS='active'"));
 
$count_stud_sanction = mysql_num_rows(mysql_query("SELECT count(A.Stud_NO )
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
 
$count_stud_financial_assistance = mysql_num_rows( mysql_query("select a.AssStudFinanAssistance_STUD_NO from t_assign_stud_finan_assistance a 
inner join r_financial_assistance_title b on b.FinAssiTitle_NAME = a.AssStudFinanAssistance_FINAN_NAME
and b.FinAssiTitle_DISPLAY_STAT <> 'Inactive'
inner join r_stud_profile c on c.Stud_NO = a.AssStudFinanAssistance_STUD_NO
and c.Stud_DISPLAY_STATUS <> 'Inactive'
and a.AssStudFinanAssistance_DISPLAY_STAT <> 'Inactive'
GROUP by a.AssStudFinanAssistance_STUD_NO"));

?>