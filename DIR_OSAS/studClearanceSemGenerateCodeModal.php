<?php include ('../config/query.php'); ?>
    <?php if(isset($_POST['ViewQR'])){ ?>
        <div class="modal-dialog" style="width: 500px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Quick Response Code</h4> </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <center> <img style="border:gray; border-style:double" src="../config/generateQR.php?text=<?php echo $_GET['genData']?>"> </center>
                        </div>
                    </div>
                    <center>
                        <div class="modal-footer"> <strong> <?php echo $_GET['genData'] ?></strong> </div>
                    </center>
                </div>
            </div>
        </div>
        <?php } else if(isset($_POST['ViewCompletion'])){
        ?>

            <div class="modal-dialog" style="width: 700px; ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Completion Form</h4> </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <iframe src="../Print/certCompletion.php?studno=<?php echo $_GET['studno'];?> "style="height:  500px;width: 100%;"> </iframe>
                            </div>
                        </div>
                        <center>
                        </center>
                    </div>
                </div>
            </div>
            <?php }?>
