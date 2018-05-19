<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>&nbsp</title>
    <link rel='stylesheet' type='text/css' href='css/style.css' />
    <link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
    <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='js/example.js'></script>
    <style>
        @media print {
            .header,
            .hide {
                visibility: hidden
            }
        }

        <?php include('../../config/connection.php');

        $view_query=mysqli_query($con, " SELECT UPPER(OSASHead_NAME) AS NAME FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active' ");
        while($row=mysqli_fetch_assoc($view_query)) {
            $osas=$row["NAME"];

        }
        $orgc = $_GET['Organization'];
        $view_query=mysqli_query($con, " SELECT OrgAppProfile_NAME,OrgForCompliance_BATCH_YEAR FROM `t_org_for_compliance` 
	INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE  
    WHERE OrgForCompliance_ORG_CODE = '$orgc' ");
        while($row=mysqli_fetch_assoc($view_query)) {
            $orgname = $row["OrgAppProfile_NAME"];
            $byear = $row["OrgForCompliance_BATCH_YEAR"];

        }

        $item='';
        foreach (explode(',', $_GET['items']) as $data) {
            $item=$item . ",'".$data."'";
        }

        ?>

    </style>
</head>

<body>
    <div id="page-wrap">
        <div class="headerrow">
            <div class="column">
                <img src="images/puplogo.png">
            </div>
            <div class="column">
                <center>
                    <br/>
                    <br/>
                    <h5>Republic of the Philippines</h5>
                    <h5>Polytechnic University of the Philippines</h5>
                    <h5>Quezon City Branch</h5>
                </center>
            </div>
            <div class="column">
                <img src="<?php ?>" style="float:right;display:none"></div>
        </div>
        <p id="header">Event</p>
        <div style="clear:both"></div>
        <div id="event"></div>

        <table id="items">
            <thead>
                <th>Event Code</th>
                <th>Event Name</th>
                <th>Event Description</th>
                <th>Date</th>
                <th>Event Status</th>
                <th>Approval Status</th>
            </thead>

            <?php

                $view_query = mysqli_query($con," SELECT OrgEvent_OrgCode,OrgEvent_Code,OrgEvent_NAME,OrgEvent_DESCRIPTION,OrgEvent_ReviewdBy,OrgEvent_STATUS,OrgAppProfile_NAME,DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') AS PROPDATE,IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') > DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'Tapos Na',IF(DATE_FORMAT(OrgEvent_PROPOSED_DATE, '%M %d, %Y') = DATE_FORMAT(CURRENT_DATE, '%M %d, %Y'),'On Going','Sa future') ) AS EVSTAT, OrgEvent_DISPLAY_STAT FROM `r_org_event_management` AS E
                                INNER JOIN t_org_for_compliance AS R ON E.OrgEvent_OrgCode = R.OrgForCompliance_ORG_CODE
                                INNER JOIN r_org_applicant_profile AS I ON I.OrgAppProfile_APPL_CODE = R.OrgForCompliance_OrgApplProfile_APPL_CODE AND OrgEvent_Code IN ('1'".$item.") ");
                while($row = mysqli_fetch_assoc($view_query))
                {
                    $code = $row["OrgEvent_Code"];
                    $name = $row["OrgEvent_NAME"];
                    $desc = $row["OrgEvent_DESCRIPTION"];
                    $date = $row["PROPDATE"];
                    $evestatus = $row["EVSTAT"];
                    $appstatus = $row["OrgEvent_STATUS"];
                    
                    $estat = '';
                    
                    if($evestatus == 'Sa future'){
                        $estat = 'Incoming';
                        
                    }else if($evestatus == 'On Going'){
                        $estat = 'On Going';
                        
                    }
                    else{
                        $estat = 'Done';
                        
                    }

                    echo "
                    <tr class=''>
                        <td style='width:250px'><label>$code</label></td>
                        <td style='width:200px'><label>$name</label></td>
                        <td style='width:200px'><label>$desc</label></td>
                        <td style='width:200px'><label>$date</label></td>
                        <td style='width:200px'><label>$estat</label></td>
                        <td style='width:200px'><label>$appstatus</label></td>
                    </tr>
                            ";
                }

            ?>
        </table>
        <br><br><br><br><br><br>

        <br><br><br>
        <div id="row">
            <div class="column">
                <h3>Reviewed by: </h3>
                <br><br>
                <p>
                    <?php echo $osas; ?>
                </p>
                Office of the Student Affairs
            </div>

        </div>

        <br><br><br><br><br>
        <br><br><br><br><br><br>

        <div id="terms">

            <h5>This report is generated by the system</h5>
            Rothlener Bldg., PUP Quezon City Branch, Don Fabian St., Commonwealth Quezon City
            <br>Phone: (Direct Lines) 9527817; 4289144; 9577817
            <br>Email: commonwealth@pup.edu.ph/ Website: www.pup.edu.ph
            <br> “The Country’s 1st Polytechnic U”
            <br>
        </div>
        <script>
            $(document).ready(function (){
                window.print();
            
            });

        </script>

    </div>

</body>

</html>
