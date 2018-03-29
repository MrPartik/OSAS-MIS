<!DOCTYPE html>
<html>
<title>OSAS - Vouching</title>
<?php 
$breadcrumbs =" <div class='col-md-12'>
<ul class='breadcrumbs-alt'>
    <li> <a href='dashboard.php'>Home</a> </li>
    <li> <a href='#'>Organization Management</a> </li>
    <li> <a class='current' href='OrganizationVoucher.php'>Voucher</a> </li>
</ul>
</div>";   
$currentPage ='OSAS_OrgVouch';  
include('header.php'); 
include('../config/connection.php');     

?>

<body>
    <!--sidebar start-->
    <?php include('sidenav.php')?>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row ">
                <!-- <div class="col-md-12">
                            <ul class="breadcrumbs-alt">
                                <li> <a href="dashboard.php">Home</a> </li>
                                <li> <a href="#">Student Management</a> </li>
                                <li> <a class="current" href="studprofile.php">Student Profile</a> </li>
                            </ul>
                        </div> -->

            </div>
            <div class="row ">
                <div class="col-md-12">
                    <section class="panel">
                        <header class="panel-heading"> Organization Voucher <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a> 
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span> </header>
                        <div class="panel-body">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <button data-toggle="modal" href="#Add" class="btn btn-default"> <i class="fa fa-plus"></i> Add</button>
                                </div>
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default " id="btnprint">Print <i class="fa fa-print"></i></button>
                                </div>
                            </div>
                            <div class="adv-table" id="TableStudProfile">
                                <table class="display table table-bordered table-striped col-md-12" id="dynamic-table">
                                    <thead>
                                        <tr>
                                            <th>Organization Code</th>
                                            <th>Voucher number</th>
                                            <th>Amount</th> 
                                            <th>Checked by</th>
                                            <th>Date Issue</th> 
                                            <th>
                                                <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php  while($vouch=mysqli_fetch_array($view_orgVoucher)) { ?>
                                        <tr>
                                        <td>
                                                <?php echo $vouch['OrgForCompliance_ORG_CODE'];?>
                                            </td>
                                            <td>
                                                <?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?>
                                            </td>
                                            <td id="amo">
                                                <?php
                                                $v = $vouch['OrgVoucher_CASH_VOUCHER_NO'];
                                                $amo = mysqli_fetch_assoc(mysqli_query($con,"SELECT ifnull(SUM(OrgVouchItems_AMOUNT),'0.000') as amo FROM t_org_voucher_items where OrgVouchItems_VOUCHER_NO = '$v'"));
                                                echo "₱ ".$amo['amo'];?>
                                            </td>
                                            <td id="byyy">
                                                <?php echo $vouch['OrgVoucher_CHECKED_BY']?>
                                            </td>
                                            <td id="datee">
                                                <?php echo (new DateTime($vouch["OrgVoucher_DATE_ADD"]))->format('D M d, Y ')  ?>
                                            </td> 
                                            <td>
                                                <center>
                                                    <button id="btnStudProfile" orgcode="<?php echo $vouch['OrgForCompliance_ORG_CODE'];?>" vouch="<?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?>"data-toggle="modal" href="#Voucher" class="btn btn-info"> <i class="fa  fa-info-circle"></i> </button>
                                                </center>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Organization Code</th>
                                            <th>Voucher number</th>
                                            <th>Amount</th> 
                                            <th>Checked by</th>
                                            <th>Date Issue</th> 
                                            <th>
                                                <center><i style="font-size:20px" class="fa fa-bolt"></i></center>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </section>
    <!-- Modal -->
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="Add" class="modal fade">
        <div class="modal-dialog" style="width:700px">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Student</h4>
                </div>
                <div class="modal-body">
                    <br>
                    <p>You are now adding organization voucher</p>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
<table id="meta">
<tr>
    <td class="meta-head">Voucher Number:</td>
    <td class="AddOrgCode"><select id="Addorgcode">><?php  $query= mysqli_query($con,"SELECT * FROM t_org_for_compliance where OrgForCompliance_BATCH_YEAR  = (SELECT  ActiveAcadYear_Batch_YEAR FROM active_academic_year WHERE ActiveAcadYear_IS_ACTIVE =1)"); while($code=mysqli_fetch_assoc($query)){?>
        <option><?php echo $code["OrgForCompliance_ORG_CODE"]?></option>
    <?php }?><select></td>
</tr>
                        <tr>
                            <td class="meta-head">Voucher Number:</td>
                            <td class="AddVoucherNo"><?php echo mysqli_num_rows(mysqli_query($con,"select *  from t_org_voucher where OrgVoucher_DISPLAY_STAT ='active'"))+1;  ?></td>
                        </tr>
                        <tr> 
                        <td class="meta-head">Date Issued</td>
                        <td class="AddDateIssue"><?php echo dateNow(); ?></td>
                    </tr>
                    <tr> 
                    <td class="meta-head">Vouch by</td>
                    <td><input id="AddVouchBy" type="text"></td>
                </tr>   <tr> 
                            <td class="meta-head">Total Vouch</td>
                            <td><p id="cash"></p></td>
                        </tr>
                         
        
                    </table>
                
                </div>
                
                <br><br>
                <br><br>
                <br><br>
                <br><br>    
                <center>
                <table id="items">
                
                                        <tr>  
                                            <th style="width:100%">Item Description</th>
                                            <th class="numeric ">Amount</th> 
                                        </tr> 
                                    <tbody id="tbodyvoucher">
                                    
                                  
 
                                    </tbody>

                                </table> 
                <br><br>
                <br><br>  
                                </center>
                        </div>
                        <button id="addItem" class="btnInsert btn btn-success" type="submit">Add Item</button>
                    </div> 
                    <div class="modal-footer">
                        <button id="insertVoucher" class="btnInsert btn btn-success" type="submit">Submit</button>
                        <button data-dismiss="modal" class="btn btn-cancel" type="button">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal -->
    <div id="Voucher" class="modal fade content-voucher" role="dialog"> </div>
    <!--main content end-->
    <!-- Placed js at the end of the document so the pages load faster -->
    <!--Core js-->
    <?php include('footer.php')?>
    <script>
        $(document).ready(function() {
            $('#btnprint').click(function() {
                var items = [];
                var rows = $('#dynamic-table').dataTable()
                    .$('tr', {
                        "filter": "applied"
                    });
                $(rows).each(function(index, el) {
                    items.push($(this).closest('tr').children('td:first').attr("studno"));

                })
                window.open('Print/StudentProfile_Print.php?items=' + items, '_blank');
            });
            var dataSrc = [];
            var table = $('#dynamic-table').DataTable({
                'initComplete': function() {
                    var api = this.api();
                    api.cells('tr', [0, 1, 2, 3, 4]).every(function() {
                        var data = $('<div>').html(this.data()).text();
                        if (dataSrc.indexOf(data) === -1) {
                            dataSrc.push(data);
                        }
                    });
                    dataSrc.sort();
                    $('.dataTables_filter input[type="search"]', api.table().container()).typeahead({
                        source: dataSrc,
                        afterSelect: function(value) {
                            api.search(value).draw();
                        }
                    });
                },
                bDestroy: true,
                aaSorting: [
                    [0, "desc"]
                ]
            });
        });
        
        $(".btnInsert").on("click", function() {
            
        });

        $("#addItem").on("click",function(){
            
            $("#tbodyvoucher").append("<tr class='newItem'><td><input id='AddDesc' type='text' style='width:100%'></td> <td><input id='AddAmo' type='text' style='width:100%'></td> </tr>");
        });
        $("#TableStudProfile").on("click", "#btnStudProfile", function() {

            var orgcode = $(this).attr("orgcode")
                ,vouch = $(this).attr("vouch")
                ,amo = $(this).closest("tr").find("td[id='amo']").text()
                ,byyy = $(this).closest("tr").find("td[id='byyy']").text()
                ,datee = $(this).closest("tr").find("td[id='datee']").text();
               
            $.ajax({
                url: "OrganizationVoucherModal.php?orgcode=" + orgcode+"&vouch="+vouch+"&amo="+amo+"&datee="+datee+"&byyy="+byyy,
                cache: false,
                async: false,
                success: function(result) {
                    $(".content-voucher").html(result);
                }
            });
        });
        
        $("#insertVoucher").on("click",function(){
            var orgcode=($("table[id='meta']").find("tbody").find("tr").find(".AddOrgCode").find("#Addorgcode option:selected").val())
            ,vouchBy=($("table[id='meta']").find("tbody").find("tr").find("#AddVouchBy").val())
            ,vouch= ($("table[id='meta']").find("tbody").find("tr").find(".AddVoucherNo").text());
        
                    $.ajax({
                        url: "OrganizationVoucherSave.php"
                        ,type:"POST"
                        ,data:{
                            insertVouch:"insert"
                            ,orgcode:orgcode
                            ,vouchBy:vouchBy
                            ,vouch:vouch

                        }
                        ,success:function(){

                            $("#tbodyvoucher").find("tr[class='newItem']").each(function(){
                            var desc= ($(this).find("#AddDesc").val())
                            ,amou =($(this).find("#AddAmo").val());
                                    $.ajax({

                                        url:"OrganizationVoucherSave.php"
                                        ,type:"POST"
                                        ,data:{
                                            insertVouchItem:"insert"
                                            ,desc:desc
                                            ,amou:amou
                                            ,vouch:vouch

                                        }
                                        ,success:function(response){
                                           
                            location.reload();


                                        },error:function(){

                                        }

                                    });
                            });

                        },error:function(error){
                            alert(error);
                        }

                     });
        });

    </script>
</body> 
</html>
