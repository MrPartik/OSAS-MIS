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
        <p id="header">Voucher
        </p>



        <div style="clear:both"></div>
        <div id="event">
        </div>

        <table id="items">

            <tr>
                <th style="width:200px">Voucher Number</th>
                <th style="width:200px">Organization</th>
                <th style="width:200px">Overview</th>
                <th style="width:200px">Description</th>
                <th style="width:150px">Date Issued</th>
            </tr>

            <?php

                $view_query = mysqli_query($con," SELECT DATE_FORMAT(OrgVoucher_DATE_MOD,'%M %d, %Y') AS DATEISSUED ,OrgAppProfile_NAME,OrgVoucher_CHECKED_BY,OrgVoucher_VOUCHED_BY,OrgVoucher_CASH_VOUCHER_NO,(SELECT GROUP_CONCAT(OrgVouchItems_ITEM_NAME SEPARATOR ', ')
                FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO) AS ITEMS,(SELECT SUM(OrgVouchItems_AMOUNT)
                FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO = OrgVoucher_CASH_VOUCHER_NO) AS AMOUNT FROM `t_org_voucher` INNER JOIN t_org_for_compliance ON OrgForCompliance_ORG_CODE = OrgVoucher_ORG_CODE INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE =  OrgAppProfile_APPL_CODE  WHERE OrgVoucher_ID  IN ('0'".$item.") AND OrgVoucher_STATUS = 'Approved' ");
                while($row = mysqli_fetch_assoc($view_query))
                {
                    $number = $row["OrgVoucher_CASH_VOUCHER_NO"];
                    $name = $row["OrgAppProfile_NAME"];
                    $send = $row["OrgVoucher_VOUCHED_BY"];
                    $rec = $row["OrgVoucher_CHECKED_BY"];
                    $amount = $row["AMOUNT"];
                    $desc = $row["ITEMS"];
                    $date = $row["DATEISSUED"];

                    echo "
                    <tr class=''>
                        <td style='width:250px'><label>$number</label></td>
                        <td style='width:200px'><label>$name</label></td>
                        <td style='width:280px'><label>Send by: </label> $send<br/>
                            <label>Receive by: </label> $rec</td>
                        <td><label>Amount: </label> $amount<br/><label>Description: </label> $desc</td>
                        <td><label>$date</label></td>
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
