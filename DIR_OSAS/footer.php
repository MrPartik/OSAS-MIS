<footer class="footer"></footer>
<script src="../ASSETS/js/jquery.js"></script>
<script src="../ASSETS/js/jquery-ui/jquery-ui-1.10.1.custom.min.js"></script>
<script src="../ASSETS/bs3/js/bootstrap.min.js"></script>
<script src="../ASSETS/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="../ASSETS/js/jquery.scrollTo.min.js"></script>
<script src="../ASSETS/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="../ASSETS/js/skycons/skycons.js"></script>
<script src="../ASSETS/js/jquery.scrollTo/jquery.scrollTo.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!--<script type="text/javascript" src="../ASSETS/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>-->
<script src="../ASSETS/js/jquery-tags-input/jquery.tagsinput.js"></script>
<script src="../ASSETS/js/calendar/clndr.js"></script>
<script src="../ASSETS/js/underscore-min.js"></script>
<script src="../ASSETS/js/calendar/moment-2.2.1.js"></script>
<script src="../ASSETS/js/evnt.calendar.init.js"></script>
<script src="../ASSETS/js/jvector-map/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../ASSETS/js/jvector-map/jquery-jvectormap-us-lcc-en.js"></script>
<script src="../ASSETS/js/gauge/gauge.js"></script>
<!--clock init-->
<script src="../ASSETS/js/css3clock/js/css3clock.js"></script>
<!--Easy Pie Chart-->
<script src="../ASSETS/js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="../ASSETS/js/sparkline/jquery.sparkline.js"></script>
<script src="../ASSETS/js/jquery.customSelect.min.js"></script>
<!--sweet alert -->
<script src="../ASSETS/js/sweetalert/sweetalert-dev.js"></script>
<script src="../ASSETS/js/sweetalert/sweetalert.min.js"></script>
<!--common script init for all pages-->
<script src="../ASSETS/js/scripts.js"></script>
<!--script for this page-->
<script src="../ASSETS/js/advanced-form.js"></script>
<script src="../ASSETS/js/select2/select2.js"></script>
<script src="../ASSETS/js/select-init.js"></script>
<script type="text/javascript" src="../ASSETS/js/fuelux/js/spinner.min.js"></script>
<script type="text/javascript" src="../ASSETS/js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="../ASSETS/js/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="../ASSETS/js/data-tables/DT_bootstrap.js"></script>
<script src="../ASSETS/js/mini-upload-form/assets/js/jquery.knob.js"></script>
<!-- jQuery File Upload Dependencies -->
<script src="../ASSETS/js/mini-upload-form/assets/js/jquery.ui.widget.js"></script>
<script src="../ASSETS/js/mini-upload-form/assets/js/jquery.iframe-transport.js"></script>
<script src="../ASSETS/js/mini-upload-form/assets/js/jquery.fileupload.js"></script>
<!-- Our main JS file -->
<script src="../ASSETS/js/mini-upload-form/assets/js/script.js"></script>
<script src="../ASSETS/js/jquery.nicescroll.js"></script>
<script type="text/javascript" src="../ASSETS/js/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!--icheck init -->
<script src="../ASSETS/js/iCheck/jquery.icheck.js"></script>
<script type="text/javascript" src="../ASSETS/js/ckeditor/ckeditor.js"></script>
<script src="../ASSETS/js/icheck-init.js"></script>
<script>
    $("#divVerify").css("display", "none");
    $("#OSAS_newpassword").on("input", function () {
        if ($(this).val().length < 8) {
            $("#divVerify").slideUp();;
            $("#OSAS_verifypassword").val("");
        }
        else {
            $("#divVerify").slideDown();
        }
    });
    $("#OSAS_verifypassword").on("input", function () {
        if ($("#OSAS_newpassword").val() == $(this).val()) {
            $(this).css("background", "#FFFFFF");
        }
        else {
            $(this).css("background", "#ff000024");
        }
    });
    $("button[name='insertUpdateProfileInfo']").on("click", function () {
        if ($("#OSAS_ProfilePicture").val().length || $("#OSAS_username").val().length && $("#OSAS_currentpassword").val().length && $("#OSAS_newpassword").val().length && $("#OSAS_verifypassword").val().length) {
            if ($("#OSAS_newpassword").val() == $("#OSAS_verifypassword").val()) {
                swal({
                    title: "Are you sure you want to save your profile?"
                    , text: "This data will be added  and used for further transaction"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#9DD656'
                    , confirmButtonText: 'Yes!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        var file_data = $('#OSAS_ProfilePicture').prop('files')[0]
                            , form_data = new FormData();
                        form_data.append('OSAS_Save', 'insertDoc');
                        form_data.append('username', $("#OSAS_username").val());
                        form_data.append('prevpassword', $("#OSAS_currentpassword").val());
                        form_data.append('password', $("#OSAS_verifypassword").val());
                        form_data.append('file', file_data);
                        $.ajax({
                            url: "../config/saveProfile.php"
                            , type: "POST"
                            , data: form_data
                            , cache: false
                            , contentType: false
                            , processData: false
                            , success: function (data) {
                                if (data == "ERR") {
                                    swal("Incorrect current password", "The transaction is cancelled, please try again", "error");
                                }
                                else {
                                    swal({
                                        title: "Woaah, that's neat!"
                                        , text: "changes will see after you re-login."
                                        , type: "success"
                                        , showCancelButton: false
                                        , confirmButtonColor: '#9DD656'
                                        , confirmButtonText: 'Ok'
                                    }, function (isConfirm) {
                                        location.reload();
                                    });
                                }
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                    }
                });
            }
            else {
                swal("Please make sure you verified your password", "The transaction is cancelled, please try again", "error");
            }
        }
        else {
            swal("Please fill all the required fields", "The transaction is cancelled, please try again", "error");
        }
    });
</script>
