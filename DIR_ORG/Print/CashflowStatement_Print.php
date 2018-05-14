<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>&nbsp</title>
    <?php
                
                include('../../config/connection.php');

                $item = '';    
                foreach (explode(',', $_GET['items']) as $data) {
                    $item = $item . ",'".$data."'";
                }
                $view_query = mysqli_query($con,"SELECT OrgForCompliance_ORG_CODE as CODE,IF(OrgCashFlowStatement_COLLECTION IS NULL,(SELECT OrgVoucher_CHECKED_BY FROM `t_org_voucher` WHERE OrgVoucher_CASH_VOUCHER_NO = OrgCashFlowStatement_ITEM ),
        (SELECT OrgRemittance_DESC FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM )) 		 AS DESCRIPTION,IF(OrgCashFlowStatement_COLLECTION IS NULL,'A',
        (SELECT OrgCashFlowStatement_ITEM FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM ))   AS REF ,IF(OrgCashFlowStatement_COLLECTION IS NOT 
                                                                                                             	             NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_COLLECTION,3)),'') AS COLLECTION,IF(OrgCashFlowStatement_EXPENSES IS NOT 
                                                                                                             	             NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_EXPENSES,3)),'') AS EXPENSES,
       		CONCAT('₱',FORMAT((SELECT IFNULL(SUM(OrgRemittance_AMOUNT),0) FROM t_org_remittance WHERE OrgRemittance_DISPLAY_STAT = 'Active' AND OrgRemittance_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgRemittance_DATE_ADD <= OrgCashFlowStatement_DATE_ADD) - (SELECT IFNULL(SUM(OrgVouchItems_AMOUNT),0) FROM `t_org_voucher_items` 
	INNER JOIN t_org_voucher ON OrgVoucher_CASH_VOUCHER_NO = OrgVouchItems_VOUCHER_NO
    WHERE OrgVoucher_ORG_CODE = OrgCashFlowStatement_ORG_CODE AND OrgVouchItems_DATE_ADD <= OrgCashFlowStatement_DATE_ADD AND OrgVoucher_DISPLAY_STAT = 'Active' AND OrgVouchItems_DISPLAY_STAT = 'Active' ),3)) AS BALANCE,OrgCashFlowStatement_REMARKS AS REMARKS,DATE_FORMAT(OrgCashFlowStatement_DATE_ADD,'%M %d, %Y') AS DATEISSUED                                                                                                                     
        FROM `t_org_cash_flow_statement`
		INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
        WHERE OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND IF(OrgCashFlowStatement_COLLECTION IS NULL,(SELECT OrgCashFlowStatement_ID FROM `t_org_voucher` WHERE OrgVoucher_CASH_VOUCHER_NO = OrgCashFlowStatement_ITEM ),
        (SELECT OrgCashFlowStatement_ID FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM )) IN ('0'".$item.") ORDER BY OrgCashFlowStatement_ID asc ");
                while($row = mysqli_fetch_assoc($view_query))
                {
                        
                    $code = $row["CODE"];

                }
    
                $view_query = mysqli_query($con," SELECT UPPER(OrgAppProfile_NAME) AS NA,(SELECT UPPER(OSASHead_NAME) FROM `r_osas_head` WHERE OSASHead_DISPLAY_STAT = 'Active') AS NAME FROM t_org_for_compliance 
               INNER JOIN r_org_applicant_profile ON OrgForCompliance_OrgApplProfile_APPL_CODE = OrgAppProfile_APPL_CODE
                WHERE OrgForCompliance_ORG_CODE = '$code'");
                while($row = mysqli_fetch_assoc($view_query))
                {

                    $name = $row["NA"];
                    $osas = $row["NAME"];




                }

                    

        ?>
        <link rel='stylesheet' type='text/css' href='../../Report/css/style.css' />
        <link rel='stylesheet' type='text/css' href='../../Report/css/print.css' media="print" />
        <script type='text/javascript' src='../../Report/js/jquery-1.3.2.min.js'></script>
        <script type='text/javascript' src='../../Report/js/example.js'></script>
        <style>
            @media print {
                .header,
                .hide {
                    visibility: hidden
                }
            }

        </style>
</head>

<body>
    <div id="page-wrap">
        <div class="headerrow">
            <div class="column">
                <img src="../../Report/ASSETS/images/puplogo.png">
            </div>
            <div class="column">
                <center>
                    <br>
                    <h5>Republic of the Philippines</h5>
                    <h5>Polytechnic University of the Philippines</h5>
                    <h5>Quezon City Branch</h5>

                    <h6 id="orgname">
                        <?php echo $name; ?>
                    </h6>
                </center>
            </div>
            <div class="column">
                <img src="../../Report/ASSETS/images/commitslogo.png" style="float:right;display:none"></div>
        </div>
        <p id="header">CASH FLOW
        </p>



        <div style="clear:both"></div>
        <div id="event">
        </div>

        <table id="items">

            <tr>
                <th>Date</th>
                <th>Description</th>
                <th>Collection</th>
                <th>Expense</th>
                <th>Balance</th>
            </tr>

            <?php
                 
                $item = '';    
                foreach (explode(',', $_GET['items']) as $data) {
                    $item = $item . ",'".$data."'";
                }
            
                $view_query = mysqli_query($con,"SELECT OrgCashFlowStatement_ID ID,OrgCashFlowStatement_ORG_CODE ORGCODE, IF(OrgCashFlowStatement_COLLECTION IS NULL,
                CONCAT('Voucher Item/s: ',(SELECT GROUP_CONCAT(OrgVouchItems_ITEM_NAME SEPARATOR ', ')
                FROM t_org_voucher_items WHERE OrgVouchItems_VOUCHER_NO=OrgCashFlowStatement_ITEM
                GROUP BY OrgVouchItems_VOUCHER_NO)),
                CONCAT('Remit Description: ',(SELECT OrgRemittance_DESC FROM `t_org_remittance` WHERE OrgRemittance_NUMBER = OrgCashFlowStatement_ITEM ))) AS DESCRIPTION,
                OrgCashFlowStatement_ITEM AS REF ,
                
            IF(OrgCashFlowStatement_COLLECTION IS NOT NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_COLLECTION,3)),'') AS COLLECTION
            ,IF(OrgCashFlowStatement_EXPENSES IS NOT NULL,CONCAT('₱',FORMAT(OrgCashFlowStatement_EXPENSES,3)),'') AS EXPENSES
            ,CONCAT('₱',FORMAT(((@exsum := @exsum + IFNull( OrgCashFlowStatement_EXPENSES,0))),3)) AS exBal
            ,CONCAT('₱',FORMAT(((@colsum := @colsum + IFNull( OrgCashFlowStatement_COLLECTION,0))),3)) AS colBal
            ,CONCAT(FORMAT(((@balsum := @colsum - @exsum)),3)) AS BALANCE
                ,OrgCashFlowStatement_REMARKS AS REMARKS,DATE_FORMAT(OrgCashFlowStatement_DATE_ADD,'%M %d, %Y') AS DATEISSUED FROM `t_org_cash_flow_statement`
                
            cross join
            (select @exsum := 0,@colsum := 0,@balsum := 0) params
                INNER JOIN t_org_for_compliance ON OrgCashFlowStatement_ORG_CODE = OrgForCompliance_ORG_CODE
                WHERE OrgCashFlowStatement_DISPLAY_STAT = 'Active' AND  OrgCashFlowStatement_ID IN ('0'".$item.") order by OrgCashFlowStatement_ID asc");
                while($row = mysqli_fetch_assoc($view_query))
                {
                        
                    $desc = $row["DESCRIPTION"];
                    $ref = $row["REF"];
                    $col = $row["COLLECTION"];
                    $exp = $row["EXPENSES"];
                    $bal = $row["BALANCE"];
                    $rem = $row["REMARKS"];
                    $dat = $row["DATEISSUED"];
                    $code = $row["ORGCODE"];
                    $curbal = $row["BALANCE"];
                    $totcol = $row["colBal"];
                    $totexp = $row["exBal"];
                    $totbal = $row["BALANCE"];

                    
                    echo '
                        <tr class="item-row">
                            <td class="item-name">'.$dat.'</td>
                            <td class="description">'.$code.' - '.$desc.'</td>
                            <td>'.$col.'</td>
                            <td>'.$exp.'</td>
                            <td>'.$bal.'</td>
                        </tr>
                    ';
                    
                    
                }


            ?>

                <td colspan="5">
                    <center>
                        <h4> Summary
                        </h4>
                        <center>
                </td>



                <tr>

                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line">Total Collection</td>
                    <td class="total-value">
                        <div id="total">
                            <?php echo $totcol; ?>
                        </div>
                    </td>
                </tr>
                <tr>

                    <td colspan="2" class="blank"> </td>
                    <td colspan="2" class="total-line">Total Expense</td>
                    <td class="total-value">
                        <div id="total">
                            <?php echo $totexp; ?>
                        </div>
                    </td>
                </tr>
                <table id="summ">
                    <br>
                    <tr>
                        <td class="summ	">CASH LEFT: </td>
                        <td>
                            <div class="totcashonhand">
                                <?php echo $totbal; ?>
                            </div>
                        </td>
                    </tr>

                </table>

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


        </script>

    </div>

</body>

</html>
