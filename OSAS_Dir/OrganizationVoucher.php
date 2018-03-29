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
<style>
/*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/
* {
    box-sizing: border-box;
}

/* Create three equal columns that floats next to each other */
.column {
    float: left;
    width: 33.33%;
  
}

/* Clear floats after the columns */
.headerrow:after {
    content: "";
    display: table;
    clear: both;
}

* { margin: 0; padding: 0; } 
#page-wrap { width: 800px; margin: 0 auto; } 
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header { height: 34px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font:  15px Helvetica, Sans-Serif; text-decoration: none; letter-spacing: 10px; padding: 8px 0px; }
#headerlong { height: 34px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font:  10px Helvetica, Sans-Serif; text-decoration: none; letter-spacing: 10px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#event { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#eventname { font-size: 15px; font-weight: bold; float: left; }

#meta { margin-bottom: 10px; margin-right:-15px; width: 350px; float: right; }
#meta td { text-align: center;  }
#meta td.meta-head { text-align: left; background: #eee; padding-left: 10px; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#summ { margin-top: 1px; width: 500px; float: right; }
#summ td { text-align: right;   }
#summ td.meta-head { text-align: left; background:  #eee; padding-right: 10px; }
#summ td textarea { width: 100%; height: 20px; text-align: right; }


#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td {border: 0;vertical-align: top;text-align: center;border-bottom: 1px solid #ccc6c6;}
#items td.description { width: 1000px; }

#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 20px 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }


textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
</style>

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
                                            <th>Voucher No.</th>
                                            <th>Organization Code</th>
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
                                        <tr><td>
                                                <center>#<?php echo $vouch['OrgVoucher_CASH_VOUCHER_NO'];?></center>
                                            </td>
                                        <td>
                                                <?php echo $vouch['OrgForCompliance_ORG_CODE']." - ".$vouch['OrgAppProfile_NAME'];?>
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
                                            <th>Voucher No.</th>
                                            <th>Organization Code</th>
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
    <td class="meta-head">Organization:</td>
    <td class="AddOrgCode"><select id="Addorgcode" class="form-control m-bot10"><?php  while($code=mysqli_fetch_assoc($view_availOrgVouch)){?>
        <option value="<?php echo $code['OrgForCompliance_ORG_CODE']?>"><?php echo $code["OrgAppProfile_NAME"]?></option>
    <?php }?><select></td>
</tr>
                        <tr>
                            <td class="meta-head">Voucher Number:</td>
                            <td class="AddVoucherNo" value="<?php echo mysqli_num_rows(mysqli_query($con,"select *  from t_org_voucher where OrgVoucher_DISPLAY_STAT ='active'"))+1;  ?>">#<?php echo mysqli_num_rows(mysqli_query($con,"select *  from t_org_voucher where OrgVoucher_DISPLAY_STAT ='active'"))+1;  ?></td>
                        </tr>
                        <tr> 
                        <td class="meta-head">Date Issued</td>
                        <td class="AddDateIssue"><?php echo dateNow(); ?></td>
                    </tr>
                    <tr> 
                    <td class="meta-head">Vouch by</td>
                    <td><input id="AddVouchBy"class="form-control" type="text"></td>
                </tr>   <tr> 
                            <td class="meta-head">Total Vouch</td>
                            <td><p id="cash"></p></td>
                        </tr>
                         
        
                    </table>
                
                </div>
                
                <br><br>
                <br>
                   <button id="addItem" class="btnInsert btn btn-success" type="submit">Add Item</button>
                <center>
                <table id="items">
                
                                        <tr>  
                                            <th style="width:2%"></th>
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
                    [0, "asc"]
                ]
            });
        });
        
        $(".btnInsert").on("click", function() {
            
        });

        $("#addItem").on("click",function(){
            
            $("#tbodyvoucher").append("<tr class='newItem'><td><i id='deletemoto' class='fa fa-minus-circle  '></i></td><td><input id='AddDesc' type='text' style='width:100%'></td> <td><input id='AddAmo' type='text' style='width:100%'></td> </tr>");
        });
        $("#tbodyvoucher").on("click","#deletemoto",function(){
            
            $(this).closest("tr").remove();
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
            ,vouch= ($("table[id='meta']").find("tbody").find("tr").find(".AddVoucherNo").attr("value"));
                    $.ajax({
                        url: "OrganizationVoucherSave.php"
                        ,type:"POST"
                        ,data:{
                            insertVouch:"insert"
                            ,orgcode:orgcode
                            ,vouchBy:vouchBy
                            ,vouch:vouch

                        }
                        ,success:function(response){

                            alert(response);
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
                                           alert(response);
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
