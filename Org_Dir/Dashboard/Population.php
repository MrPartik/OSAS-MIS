<?php
	
    include('../../config/connection.php');     

    $appcode = $_GET['_appcode'];


    $view_query = mysqli_query($con,"SELECT COUNT(*) AS COU, Stud_COURSE AS COURSE,CONCAT('At ',COUNT(*)/(SELECT COUNT(*) FROM t_assign_org_members B
	INNER JOIN r_stud_profile ON B.AssOrgMem_STUD_NO = Stud_NO
    WHERE B.AssOrgMem_APPL_ORG_CODE = '$appcode'  )*100,'% of population') AS PERCENTAGE FROM t_assign_org_members A
	INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
    WHERE AssOrgMem_APPL_ORG_CODE = '$appcode' AND AssOrgMem_DISPLAY_STAT = 'Active' GROUP BY Stud_COURSE  ");
    $population = '';
    $color = array('#E67A77', '#D9DD81', '#79D1CF', '#95D7BB');
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $cou = $row["COU"];
        $course = $row["COURSE"];
        
        $population = $population . '<div class=" wk-progress tm-membr">
                                            <div class="col-lg-2">
                                                <div class="tm-avatar">
                                                    <img src="../images/default.png" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-7" style="padding-top:10px">
                                                    <span class="label " style="background-color:'.$color[$i].'">'.$course.'</span>
                                                    <span class="label label-default">'.$cou.'</span>
                                            </div>
                                        </div>';
        $i++;
    }
    if($i == 0)
        $population = '<span class="label label-primary" style="font-size:15px">Empty</span>';

    echo $population;

    
?>
