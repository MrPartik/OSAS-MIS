<?php include ('../config/query.php'); ?>
    <div class="modal-dialog" style="width:700px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Student Details</h4> </div>
            <div class="modal-body">
                <div class='twt-feed maroon-bg'>
                    <?php viewStudProfileCond($_GET['StudID'],''); 
                $data =$_GET['StudID'];?>
                        <?php while($profileLayoutRow = mysqli_fetch_array($view_studProfile_cond)){ ?>
                            <div class='corner-ribon black-ribon'><i class='fa fa-user'></i></div>
                            <div class='fa fa-user wtt-mark'></div> <a href='#'><img alt='<?php echo $profileLayoutRow['FullName']?>' src='../images/Student//Student.png'></a>
                            <h1>
                    <?php echo $profileLayoutRow['FullName']?>
                            </h1>
                            <p>
                                <?php echo $profileLayoutRow['Stud_EMAIL']?>
                            </p>
                            <p>
                                <?php echo $profileLayoutRow['Stud_NO']?>
                            </p>
                            <br/>
                            <br/> </div>
                <aside class="profile-nav alt">
                    <section class="panel">
                        <ul class="nav nav-pills nav-stacked">
                            <li>
                                <a href="javascript:;"> <i class="fa fa-info-circle"></i> Status <span class="label <?php echo  ($profileLayoutRow['Stud_STATUS']=='Regular')?'label-success':'label-danger'?> label-success pull-right r-activity"><?php echo $profileLayoutRow['Stud_STATUS']?></span></a>
                            </li>
                            <li>
                                <a href="javascript:;"> <i class="fa fa-tag"></i> Course <span class="label  label-success pull-right r-activity"><?php echo $profileLayoutRow['Course']?></span></a>
                            </li>
                            <li>
                                <a href="javascript:;"> <i class="fa  fa-arrow-circle-down"></i> Year Admitted <span class="label label-success pull-right r-activity"><?php echo substr($profileLayoutRow['Stud_NO'],0,4); ?></span></a>
                            </li>
                             <?php  
                                        $counterSanction=0; 
                                        viewStudSanctionCond($profileLayoutRow['Stud_NO']);
                                        while(mysqli_fetch_array($view_studSanctionCond)){
                                            $counterSanction++;}
                                         if($counterSanction!=0){
                                         ?>
                                            
                            <li> 
                                    <a href="javascript:;"> <i class="fa fa-thumbs-down"></i> Sanction /s 
                                        <span class="label <?php echo ($counterSanction==0)?'label-success':'label-danger' ?> pull-right r-activity">
                                            <?php echo $counterSanction;} ?>
                                        </span></a>
                            </li>
                              <?php $percentageSanction = "0 %";
                            viewStudSanctionComputation($profileLayoutRow['Stud_NO']);
                            while($row=mysqli_fetch_array($view_studSanctionComputation)){ 
                            
                            $percentageSanction = $row['Percentage'];
                            ?>
                            <li>
                              
                                    <a href="javascript:;"> <i class="fa  fa-refresh"></i>Sanction Percentage Finished<span class="label <?php echo ($percentageSanction==0)?'label-success':'label-danger' ?>  pull-right r-activity"> 
                                        <?php echo round($percentageSanction,2).' %';} ?></span></a>
                            </li>
                                <?php viewFinanStudCond(0,$profileLayoutRow['Stud_NO']);  
                                                                    $scholarship ="";
                                                        while($row = mysqli_fetch_array($view_studFinanCond)){ ?>
                            <li>
                                <a href="javascript:;"> <i class="fa fa-money"></i>Scholarship/s
                                    <span class="pull-right ">
                                            <?php viewFinanStudCond(0,$profileLayoutRow['Stud_NO']);  
                                                                    $scholarship ="";
                                                        while($row = mysqli_fetch_array($view_studFinanCond)){ 
                                                             
                                                                    $scholarship =  $row["Finan_Name"]." "; 
                                                                    $statusColor = ($row["Status"]==="Active")? "label-success" : "label-danger";
                                                                    $date = new DateTime($row["Start"]);
                                                        echo " &nbsp;<span title ='".$date->format('D M d, Y h:i A')."' class='label ".$statusColor." r-activity'>".$scholarship."</span>";}?>
                                    </span>
                                </a>
                                <?php  
                                            $statusFinan = 'INACTIVE';    
                                            viewFinanStudCond (0,$profileLayoutRow['Stud_NO']); 
                                            while ($finanStud= mysqli_fetch_array($view_studFinanCond)){
                                            $statusFinan=  $finanStud['Status']; ?>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="javascript:;"> <i class="fa fa-info-circle"></i> Scholarship Status <span class="label label-success pull-right r-activity">
                                    <?php echo $statusFinan;} ?>
                                    </span>
                                </a>
                            </li>
                            <?php
                                                                            $ID =0;
                                                                            $Regi =0;
                                                                            $StudNo =$profileLayoutRow['Stud_NO'];
                                                                            $row = mysqli_fetch_array(mysqli_query($con,"SELECT (SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Identification Card') as ID
,(SELECT Count(`AssLoss_STUD_NO`) FROM `t_assign_stud_loss_id_regicard` WHERE `AssLoss_STUD_NO` = '$StudNo' and `AssLoss_DISPLAY_STAT` <>'Inactive' and `AssLoss_TYPE` = 'Registration Card') as Regi"));
                                                                             $ID = $row["ID"];
                                                                             $Regi = $row["Regi"];
                                                                            if($ID!=0 && $Regi!=0){
                                                                ?>
                                <li>
                                    <a href="javascript:;"> <i class="fa fa-bell-o"></i> Loss of Identification Card <span class="label label-success pull-right r-activity"><?php   echo $ID;  ?></span></a>
                                </li>
                                <li>
                                    <a href="javascript:;"> <i class="fa fa-bell-o"></i>Loss of Registration Card<span class="label label-success pull-right r-activity"><?php   echo $Regi; } ?></span></a>
                                </li>
                        </ul>
                    </section>
                </aside>
                <!--    <div class="collapse-group">
                    <br/>
                    <br/>
                    <div class="row collapse">
                        <div class="col-md-4 form-group"> *Student Number
                            <input id="studno1" value="<?php echo $profileLayoutRow['Stud_NO']?>" type="text" class="form-control" placeholder="ex. 2015-00001-CM-0" required/> </div>
                        <div class="col-md-4 form-group"> *Email Address
                            <input id="emailadd1" value="<?php echo $profileLayoutRow['Stud_EMAIL']?>" type="text" class="form-control" placeholder="ex. email@email.com" required/> </div>
                        <div class="col-md-4 form-group"> *Contact Number
                            <input id="contact1" value="<?php echo $profileLayoutRow['Stud_CONTACT_NO']?>" type="text" class="form-control" placeholder="ex. 099999999" required/> </div>
                        <div class="col-md-4 form-group"> *First Name
                            <input id="fname1" value="<?php echo $profileLayoutRow['Stud_FNAME']?>" type="text" class="form-control" placeholder="First Name" required/> </div>
                        <div class="col-md-4 form-group"> Middle Name
                            <input id="mname1" value="<?php echo $profileLayoutRow['Stud_MNAME']?>" type="text" class="form-control" placeholder="Middle Name"> </div>
                        <div class="col-md-4 form-group"> *Last Name
                            <input id="lname1" value="<?php echo $profileLayoutRow['Stud_LNAME']?>" type="text" class="form-control" placeholder="Last Number" required/> </div>
                        <div class="col-md-4 form-group"> *Course
                            <select id="course1" type="text" class="form-control m-bot15" required>
                                <?php   
                                    while($course_row =mysqli_fetch_array($view_course)){?>
                                    <option value="<?php echo $course_row['Course_CODE'] ?>" <?php if($course_row[ 'Course_CODE']===$profileLayoutRow[ 'Stud_COURSE']){ echo 'selected';} ?>>
                                        <?php echo $course_row['Course_CODE'] ?>
                                    </option>
                                    <?php }?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group"> *Section
                            <input id="section1" type="number" value="<?php echo $profileLayoutRow['Stud_SECTION']?>" class="form-control" placeholder="Section" required/> </div>
                        <div class="col-md-4 form-group"> *Gender
                            <select id="gender1" type="text" class="form-control m-bot15">
                                <option value="Male" <?php if( "Male"===$profileLayoutRow[ 'Stud_GENDER']){ echo 'selected';} ?>>Male</option>
                                <option value="Female" <?php if( "Female"===$profileLayoutRow[ 'Stud_GENDER']){ echo 'selected';} ?>>Female</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group"> *Birth Date
                            <input id="bdate1" value="<?php echo $profileLayoutRow['Stud_BIRHT_DATE']?>" type="Date" class="form-control" required/> </div>
                        <div class="col-md-4 form-group"> Birth Place
                            <input id="bplace1" value="<?php echo $profileLayoutRow['Stud_BIRTH_PLACE']?>" type="text" class="form-control" placeholder="ex. Quezon City"> </div>
                        <div class="col-md-4 form-group"> *Student Status
                            <select id="studStat1" class="form-control" value="Irregular" required>
                                <option value="Regular" <?php if( "Regular"===$profileLayoutRow[ 'Stud_STATUS']){ echo 'selected';} ?>>Regular Student</option>
                                <option value="Irregular" <?php if( "Irregular"===$profileLayoutRow[ 'Stud_STATUS']){ echo 'selected';} ?>>Irregular Student</option>
                                <option value="Disqualified" <?php if( "Disqualified"===$profileLayoutRow[ 'Stud_STATUS']){ echo 'selected';} ?>>Disqualified Student</option>
                                <option value="LOA" <?php if( "LOA"===$profileLayoutRow[ 'Stud_STATUS']){ echo 'selected';} ?>>Leave of Absense</option>
                                <option value="Transferee" <?php if( "Transferee"===$profileLayoutRow[ 'Stud_STATUS']){ echo 'selected';} ?>>Transferee Student</option>
                            </select>
                        </div>
                        <div class="col-md-12 form-group"> *Address
                            <input id="address1" value="<?php echo $profileLayoutRow['Stud_ADDRESS']?>" type="text" class="form-control" placeholder="enter your home/ permanent address"> </div>
                    </div>
                    <div class="modal-footer">
                        <button data-toggle="modal" class="editStud btn btn-primary"><i class="fa fa-pencil"></i> Modify</button>
                        <button name="update" style="display:none" class="btnSave btn btn-success"><i class="fa fa-save"></i> Save</button>
                        <button name="Archive" style="display:none" class="btnArchive btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button> 
                        <a id="btnStudModal" href="<?php echo $data?>" class="profileView btn btn-info"><i class="fa fa-eye"></i>  View Profile</a> </div>
                </div> 
            </div>
        </div> -->
                <?php }?>
                    <!-- <script>
                $('.editStud').on('click', function () {
                    if ($('.twt-feed:visible').length) {
                        $('.twt-feed').hide();
                        $('.editStud').html("<i class='fa  fa-arrow-circle-o-left'></i>  Back");
                        $('.collapse').show("fade", 500);
                        $('.btnSave').show();
                        $('.btnArchive').show();
                        $('.profileView').hide();
                    }
                    else {
                        $('.twt-feed').show("fade", 500);
                        $('.btnSave').hide();
                        $('.btnArchive').hide();
                        $('.editStud').html("<i class='fa fa-pencil'></i>  Modify");
                        $('.collapse').hide();
                        $('.profileView').show();
                    }
                });
                $(".btnSave").on("click", function () {
                    var $studno = $('#studno1').val();
                    var $emailadd = $('#emailadd1').val();
                    var $contact = $('#contact1').val();
                    var $fname = $('#fname1').val();
                    var $mname = $('#mname1').val();
                    var $lname = $('#lname1').val();
                    var $course = $('#course1').val();
                    var $section = $('#section1').val();
                    var $gender = $('#gender1').val();
                    var $bdate = $('#bdate1').val();
                    var $bplace = $('#bplace1').val();
                    var $status = $('#studStat1').val();
                    var $address = $('#address1').val();
                    var $studID = <?php echo $data ?>;
                    if ($studno.length && $emailadd.length && $contact.length && $fname.length && $lname.length && $bdate.length && $section.length && $address.length) {
                        $.ajax({
                            type: 'POST'
                            , url: 'studProfileSave.php'
                            , data: {
                                action: 'updateActive'
                                , studID: $studID
                                , studno: $studno
                                , emailadd: $emailadd
                                , contact: $contact
                                , fname: $fname
                                , mname: $mname
                                , lname: $lname
                                , course: $course
                                , section: $section
                                , gender: $gender
                                , bdate: $bdate
                                , bplace: $bplace
                                , status: $status
                                , address: $address
                            }
                            , success: function (result) {
                                alert($studID);
                                alert(result);
                                window.location.reload();
                            }
                            , error: function (result) {
                                alert('Error')
                            }
                        });
                    }
                    else alert('(*) Please provide value in reqired fields');
                });
                $(".btnArchive").on("click", function () {
                    var $studID = <?php echo $data ?>;
                    $.ajax({
                        type: 'POST'
                        , url: 'studProfileSave.php'
                        , data: {
                            action: 'ArchiveActive'
                            , studID: $studID
                        }
                        , success: function (result) {
                            alert($studID);
                            alert(result);
                            window.location.reload();
                        }
                        , error: function (result) {
                            alert('Error')
                        }
                    });
                });
            </script>-->
