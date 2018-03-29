<?php
	
    include('../../config/connection.php');     

    $appcode = $_GET['_appcode'];


    $view_query = mysqli_query($con,"SELECT CONCAT(Stud_LNAME,', ',Stud_FNAME ,IF(Stud_MNAME = '','',CONCAT(' ',Stud_MNAME)))  AS NAME , Stud_NO,CONCAT(Stud_COURSE,' ',Stud_YEAR_LEVEL,' - ',Stud_SECTION) AS CAS,OrgOffiPosDetails_NAME AS POS FROM t_assign_org_members
		INNER JOIN r_stud_profile ON AssOrgMem_STUD_NO = Stud_NO
        INNER JOIN t_org_officers  ON OrgOffi_STUD_NO = AssOrgMem_STUD_NO       
        INNER JOIN r_org_officer_position_details ON OrgOffiPosDetails_ID = OrgOffi_OrgOffiPosDetails_ID
        WHERE AssOrgMem_DISPLAY_STAT = 'Active' AND  OrgOffi_DISPLAY_STAT = 'Active' AND  AssOrgMem_COMPL_ORG_CODE = '$appcode' AND OrgOffiPosDetails_ORG_CODE =  '$appcode'  ");
    $officerlist = '';
    $i = 0;
    while($row = mysqli_fetch_assoc($view_query))
    {
        $i = 1;
        $name = $row["NAME"];
        $stud = $row["Stud_NO"];
        $cas = $row["CAS"];
        $pos = $row["POS"];
        
        $officerlist = $officerlist . '<div class=" wk-progress tm-membr">
                                            <div class="col-lg-2">
                                                <div class="tm-avatar">
                                                    <img src="../images/avatar1.jpg" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-7" style="padding-top:10px">
                                                    <span class="label label-primary">'.$name.'</span>
                                                    <span class="label label-default">'.$cas.'</span>
                                            </div>
                                            <div class="col-lg-3" style="padding-top:10px">
                                                <span class="label label-success">'.$pos.'</span>
                                            </div>
                                        </div>';
        
        
    

        
    }
    if($i == 0)
        $officerlist = '<span class="label label-primary" style="font-size:15px">Empty</span>';


    echo $officerlist;

    
?>
