<?php
	
    include('../../../config/connection.php');     

    $id = $_GET['_id'];

    $view_query = mysqli_query($con," SELECT OrgRemittance_ORG_CODE,OrgAppProfile_NAME,OrgRemittance_SEND_BY,OrgRemittance_REC_BY,OrgRemittance_AMOUNT AS AMOUNT  ,OrgRemittance_DESC  FROM t_org_remittance
                                                    INNER JOIN t_org_for_compliance ON OrgRemittance_ORG_CODE = OrgForCompliance_ORG_CODE
                                                    INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                                                    WHERE OrgRemittance_ID = '$id'  ");
    while($row = mysqli_fetch_assoc($view_query))
    {
        $name = $row["OrgAppProfile_NAME"];
        $code = $row["OrgRemittance_ORG_CODE"];
        $send = $row["OrgRemittance_SEND_BY"];
        $rec = $row["OrgRemittance_REC_BY"];
        $amo = $row["AMOUNT"];
        $desc = $row["OrgRemittance_DESC"];

    }
    echo json_encode(
          array("name" => $name,"send" => $send,"rec" => $rec,"amo" => $amo,"code" => $code,"desc" => $desc)
     );


?>
