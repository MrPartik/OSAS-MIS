var getcode = '';
var getname = '';
var oldWizard = '';
var latcode = '';
var initFlag = 0;
var EditableTable = function () {
    return {
        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }
                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
            }

            function saveRow(oTable, nRow) {
                //                alert(document.getElementById('txtupdcode').value);
                var code = document.getElementById('txtupdcode').value;
                oTable.fnUpdate(code, nRow, 0, false);
                oTable.fnUpdate(document.getElementById('txtupdname').value, nRow, 1, false);
                oTable.fnUpdate(document.getElementById('txtupddesc').value, nRow, 2, false);
                if (document.getElementById('chkupdacc').checked) oTable.fnUpdate('Accredited', nRow, 3, false);
                else oTable.fnUpdate('This application is ready for accreditation', nRow, 3, false);
                //                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 4, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="btn btn-success edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnDraw();
            }
            var oTable = $('#editable-sample').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1]
                    , [5, 15, 20, "All"] // change per page values here
                ]
                , // set the initial value
                "iDisplayLength": 5
                , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                , "sPaginationType": "bootstrap"
                , "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                    , "oPaginate": {
                        "sPrevious": "Prev"
                        , "sNext": "Next"
                    }
                }
                , aaSorting:[[3,"desc"]]
            });
            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var oTable2 = $('#editable-sample2').dataTable({});
            var oTable3 = $('#editable-sample3').dataTable({});

            function fillstep5() {
                var fillstud = '<option value="default">Please Choose a member</option>';
                var fillpos = '<option value="default">Please Choose a position</option>';
                document.getElementById('drpstud').innerHTML = fillstud;
                document.getElementById('drppos').innerHTML = fillpos;
                $.ajax({
                    type: "GET"
                    , url: 'Organization/OrganizationProfile/FillStep5.php'
                    , dataType: 'json'
                    , data: {
                        _code: latcode
                    }
                    , success: function (data2) {
                        $.each(data2, function (key, val) {
                            $('#drpstud').append('<option value="' + val.no + '">' + val.name + '</option>')
                        });
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
                $.ajax({
                    type: "GET"
                    , url: 'Organization/OrganizationProfile/FillStep5b.php'
                    , dataType: 'json'
                    , data: {
                        _code: latcode
                    }
                    , success: function (data2) {
                        $.each(data2, function (key, val) {
                            $('#drppos').append('<option value="' + val.id + '">' + val.name + '</option>')
                        });
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            }
            $('#editable-sample_new3').on('click', function (e) {
                fillstep5();
            });
            $('#btnsubmitoff').on('click', function (e) {
                e.preventDefault();
                var _drppos = document.getElementById('drppos');
                var drpposname = _drppos.options[_drppos.selectedIndex].text;
                var drpposval = _drppos.options[_drppos.selectedIndex].value;
                var _drpstud = document.getElementById('drpstud');
                var drpstudname = _drpstud.options[_drpstud.selectedIndex].text;
                var drpstudval = _drpstud.options[_drpstud.selectedIndex].value;
                if (drpposval != 'default') {
                    if (drpstudval != 'default') {
                        $("#close3").click();
                        swal({
                            title: "Are you sure?"
                            , text: "The record will be save and will be use for further transaction"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#DD6B55'
                            , confirmButtonText: 'Yes, do it!'
                            , cancelButtonText: "No!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    type: 'post'
                                    , url: 'Organization/OrganizationProfile/AddOfficer.php'
                                    , data: {
                                        _studno: drpstudval
                                        , _pos: drpposval
                                    }
                                    , success: function (response) {
                                        swal("Record Added!", "The data is successfully Added!", "success");
                                        fillstep5();
                                        $.ajax({
                                            type: "GET"
                                            , url: 'Organization/OrganizationProfile/FillStep5c.php'
                                            , dataType: 'json'
                                            , data: {
                                                _code: latcode
                                            }
                                            , success: function (data2) {
                                                oTable3.fnClearTable();
                                                $.each(data2, function (key, val) {
                                                    var aiNew = oTable3.fnAddData(["<span posID='" + val.posID + "' studno='" + val.studno + "'>" + val.pos + "</span>", val.studno + " - " + val.name, '<center><a class="btn btn-danger delete" href="javascript:;"><i class="fa fa-trash-o" ></i></a></center>', ]);
                                                    var nRow = oTable3.fnGetNodes(aiNew[0]);
                                                });
                                            }
                                            , error: function (response) {
                                                swal("Error encountered while adding data", "Please try again", "error");
                                            }
                                        });
                                    }
                                    , error: function (response) {
                                        swal("Error encountered while adding data", "Please try again", "error");
                                        $("#editable-sample_new2").click();
                                    }
                                });
                            }
                            else {
                                swal("Cancelled", "The transaction is cancelled", "error");
                                $("#editable-sample_new2").click();
                            }
                        });
                    }
                    else swal("Please fill the position", "The transaction is cancelled", "error");
                }
                else swal("Please fill the member", "The transaction is cancelled", "error");
            });
            $('#submit-data2').on('click', function (e) {
                e.preventDefault();
                var pos = document.getElementById('txtposcode').value;
                var desc = document.getElementById('txtposdesc').value;
                var occ = document.getElementById('txtocc').value;
                $("#close2").click();
                swal({
                    title: "Are you sure?"
                    , text: "The record will be save and will be use for further transaction"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#DD6B55'
                    , confirmButtonText: 'Yes, do it!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post'
                            , url: 'Organization/OrganizationProfile/AddPosition.php'
                            , data: {
                                _code: latcode
                                , _pos: pos
                                , _occ: occ
                                , _desc: desc
                            }
                            , success: function (response) {
                                swal("Record Added!", "The data is successfully Added!", "success");
                                var aiNew = oTable2.fnAddData([pos, occ, "<center> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center>"]);
                                var nRow = oTable2.fnGetNodes(aiNew[0]);
                            }
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#editable-sample_new2").click();
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                        $("#editable-sample_new2").click();
                    }
                });
            });
            var nEditing = null;
            $('#btnStep1').click(function (e) {
                e.preventDefault();
                swal({
                    title: "Are you sure?"
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
                        var advname = document.getElementById('txtadvname').value;
                        $.ajax({
                            type: 'post'
                            , url: 'Organization/OrganizationProfile/Step1.php'
                            , data: {
                                _appcode: latcode
                                , _advname: advname
                            }
                            , success: function (response) {
                                swal({
                                    title: "Woaah, that's neat!"
                                    , text: "The organization adviser is saved"
                                    , type: "success"
                                    , confirmButtonColor: '#9DD656'
                                    , confirmButtonText: 'Ok'
                                    , closeOnConfirm: false
                                }, function (isConfirm) {
                                    location.reload();
                                })
                            }
                            , error: function (response) {
                                swal(response, "Please try again", "error");
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                    }
                });
            });
            $('#next1').click(function (e) {
                e.preventDefault();
                var advname = document.getElementById('txtadvname').value;
                $.ajax({
                    type: 'post'
                    , url: 'Organization/OrganizationProfile/Step1.php'
                    , data: {
                        _appcode: latcode
                        , _advname: advname
                    }
                    , success: function (response) {}
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
            });
            $('#btnStep3').click(function (e) {
                e.preventDefault();
                var mission = document.getElementById('txtmission').value;
                var vision = document.getElementById('txtvision').value;
                $.ajax({
                    type: 'post'
                    , url: 'Organization/OrganizationProfile/Step3.php'
                    , data: {
                        _appcode: latcode
                        , _mission: mission
                        , _vision: vision
                    }
                    , success: function (response) {
                        swal("Woaah, that's neat!", "The organization mission and vision is saved", "success");
                    }
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
                upload();
            });
            $('#next3').click(function (e) {
                e.preventDefault();
                var mission = document.getElementById('txtmission').value;
                var vision = document.getElementById('txtvision').value;
                $.ajax({
                    type: 'post'
                    , url: 'Organization/OrganizationProfile/Step3.php'
                    , data: {
                        _appcode: latcode
                        , _mission: mission
                        , _vision: vision
                    }
                    , success: function (response) {}
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
                upload();
            });

            function upload() {
                var file_data = $('#fileupload').prop('files')[0];
                var form_data = new FormData();
                form_data.append('file', file_data);
                $.ajax({
                    url: "../config/Upload_Avatar.php?Username=" + latcode
                    , type: "POST"
                    , data: form_data
                    , contentType: false
                    , cache: false
                    , processData: false
                    , success: function (data) {
                        console.log(data);
                    }
                });
            }
            $('#next4').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post'
                    , url: 'Organization/OrganizationProfile/Step4.php'
                    , data: {
                        _appcode: latcode
                    }
                    , success: function (response) {}
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
            });
            $('#next5').click(function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'post'
                    , url: 'Organization/OrganizationProfile/Step5.php'
                    , data: {
                        _appcode: latcode
                    }
                    , success: function (response) {}
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
            });
            var finflag = 0;
            $('#btnFinish').click(function (e) {
                e.preventDefault();
                var x = 0;
                $('#updaccreqlist tr').each(function (index, brand) {
                    x++;
                });
                var cou = 0;
                for (var z = 1; z <= x; z++) {
                    chkstat = document.getElementById('chkupdstat' + z);
                    if (chkstat.checked) {
                        stat = 1;
                        cou++;
                    }
                    else stat = 0;
                    reccode = document.getElementById('updcode' + z).innerText;
                    //                    alert(latcode + '-' + reccode + '-' + stat);
                    $.ajax({
                        type: 'post'
                        , url: 'Organization/OrganizationProfile/Step6.php'
                        , async: true
                        , data: {
                            _drpcode: latcode
                            , _reccode: reccode
                            , _stat: stat
                        }
                        , success: function (response) {
                            ///                            alert(latcode + '-' + reccode + '-' + stat);
                            //document.getElementById("form-data").reset();
                        }
                        , error: function (response) {
                            swal("Error encountered while adding data", "Please try again", "error");
                        }
                    });
                }
                if (x == cou) {
                    $.ajax({
                        type: 'post'
                        , url: 'Organization/OrganizationProfile/Insert_UserAccount.php'
                        , data: {
                            _reference: latcode
                        }
                        , success: function (response) {}
                        , error: function (response) {
                            swal(response, "Please try again", "error");
                            $("#editable-sample_new").click();
                        }
                    });
                    $.ajax({
                        url: "../config/Upload_DefaultAvatar.php?Username=" + latcode, // Url to which the request is send
                        type: "POST", // Type of request to be send, called as method
                        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false, // To send DOMDocument or non processed data file it is set to false
                        success: function (data) // A function to be called if request succeeds
                            {
                                alert('okay')
                            }
                    });
                    swal({
                        title: "Woaah, that's neat!"
                        , text: "The application is successfull!"
                        , type: "success"
                        , showCancelButton: false
                        , confirmButtonColor: '#9DD656'
                        , confirmButtonText: 'Ok'
                    }, function (isConfirm) {
                        location.reload();
                    });
                    //swal("Woaah, that's neat!", "The application is successfull!", "success");
                }
                else swal({
                    title: "Woaah, almost done!"
                    , text: "The application is saved!"
                    , type: "success"
                    , showCancelButton: false
                    , confirmButtonColor: '#9DD656'
                    , confirmButtonText: 'Ok'
                }, function (isConfirm) {
                    location.reload();
                });
                swal("Woaah, that's neat!", "The Accreditation is saved", "success");
                //swal("Woaah, almost done!", "The application is saved!", "success");  
            });
            $('#drpcat').change(function () {
                var e = document.getElementById("drpcat");
                var getcat = e.options[e.selectedIndex].text;
                if (getcat == 'Academic Organization') $('#course').removeClass('hidden');
                else $('#course').addClass('hidden');
            });
            $('#submit-data').click(function (e) {
                e.preventDefault();
                var _drporg = document.getElementById('drporg');
                var drporgname = _drporg.options[_drporg.selectedIndex].text;
                var drporgval = _drporg.options[_drporg.selectedIndex].value;
                if(drporgval != 'default' && drporgname != 'Please choose an Organization'){
                    $("#close").click();
                    swal({
                        title: "Are you sure?"
                        , text: "This data will be saved and used for further transaction"
                        , type: "warning"
                        , showCancelButton: true
                        , confirmButtonColor: '#DD6B55'
                        , confirmButtonText: 'Yes!'
                        , cancelButtonText: "No!"
                        , closeOnConfirm: false
                        , closeOnCancel: false
                    }, function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post'
                                , url: 'Organization/OrganizationProfile/Add-ajax.php'
                                , data: {
                                    _name: drporgname
                                    , _appcode: drporgval
                                }
                                , success: function (response) {
                                    swal({
                                        title: "Record Added!"
                                        , text: "The data is successfully Added!"
                                        , type: "success"
                                        , confirmButtonColor: '#88A755'
                                        , confirmButtonText: 'Okay'
                                        , closeOnConfirm: false
                                    }, function (isConfirm) {
                                        window.location.reload();
                                    });
                                }
                                , error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    $("#openAddmodal").click();
                                }
                            });
                        }
                        else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                            //                        $("#openAddmodal").click();
                            document.getElementById("form-data").reset();
                        }
                    });
                }
                else
                   swal("Please try again", "Please provide an organization", "error");

            });
            $('#updsubmit-data').click(function (e) {
                e.preventDefault();
                var code = document.getElementById('txtupdcode').value;
                var name = document.getElementById('txtupdname').value;
                var desc = document.getElementById('txtupddesc').value;
                var acc = document.getElementById('chkupdacc');
                var accstat = '';
                var getid = document.getElementById('txtgetid').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;
                $("#updclose").click();
                if (acc.checked) accstat = 'Accredited';
                else accstat = 'This application is ready for accreditation';
                //                $("#updclose").click();
                swal({
                    title: "Are you sure?"
                    , text: "This data will be saved and used for further transaction"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#DD6B55'
                    , confirmButtonText: 'Yes!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post'
                            , cache: false
                            , url: 'Organization/OrganizationProfile/Update-ajax.php'
                            , data: {
                                _id: getid
                                , _code: code
                                , _name: name
                                , _desc: desc
                                , _accstat: accstat
                            }
                            , success: function (response) {
                                swal("Record Updated!", "The data is successfully Added!", "success");
                                $("#updclose").click();
                                saveRow(oTable, nEditing);
                                nEditing = null;
                                document.getElementById("form-data2").reset();
                            }
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openModalupd").click();
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                        $("#openModalupd").click();
                    }
                });
            });
            $('#editable-sample').on('click', ' a.wizardOpen', function (e) {
                e.preventDefault();
                if (initFlag == 0) {
                    initFlag = 1;
                    oldWizard = document.getElementById('asteps').innerHTML;
                }
                var nRow = $(this).parents('tr')[0];
                getname = $(this).closest('tr').children('td:first').next().text();
                latcode = $(this).closest('tr').children('td:first').text();
                document.getElementById('lblname').innerText = latcode + ' - ' + getname + ' Application Wizard';
                var fillyear = '';
                var fillcat = '';
                $.ajax({
                    type: 'GET'
                    , url: 'Organization/OrganizationProfile/GetCurrentStep.php'
                    , async: true
                    , cache: false
                    , data: {
                        _appcode: latcode
                    }
                    , success: function (curstep) {
                        if (curstep == 1 || curstep == -1) {
                            $('#step-1').css("display", "block");
                            $('#step-3').css("display", "none");
                            $('#step-4').css("display", "none");
                            $('#step-5').css("display", "none");
                            $('#step-6').css("display", "none");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').attr('disabled', true);
                            $('#aStep4').attr('disabled', true);
                            $('#aStep5').attr('disabled', true);
                            $('#aStep6').attr('disabled', true);
                            $('#aStep1').addClass('btn-success');
                            $('#aStep3').removeClass('btn-success');
                            $('#aStep4').removeClass('btn-success');
                            $('#aStep5').removeClass('btn-success');
                            $('#aStep6').removeClass('btn-success');
                        }
                        if (curstep == 2) {
                            $('#step-1').css("display", "none");
                            $('#step-3').css("display", "block");
                            $('#step-4').css("display", "none");
                            $('#step-5').css("display", "none");
                            $('#step-6').css("display", "none");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').removeAttr('disabled');
                            $('#aStep4').attr('disabled', true);
                            $('#aStep5').attr('disabled', true);
                            $('#aStep6').attr('disabled', true);
                            $('#aStep1').removeClass('btn-success');
                            $('#aStep3').addClass('btn-success');
                            $('#aStep4').removeClass('btn-success');
                            $('#aStep5').removeClass('btn-success');
                            $('#aStep6').removeClass('btn-success');
                        }
                        if (curstep == 3) {
                            $('#step-1').css("display", "none");
                            $('#step-3').css("display", "none");
                            $('#step-4').css("display", "block");
                            $('#step-5').css("display", "none");
                            $('#step-6').css("display", "none");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').removeAttr('disabled');
                            $('#aStep4').removeAttr('disabled');
                            $('#aStep5').attr('disabled', true);
                            $('#aStep6').attr('disabled', true);
                            $('#aStep1').removeClass('btn-success');
                            $('#aStep3').removeClass('btn-success');
                            $('#aStep4').addClass('btn-success');
                            $('#aStep5').removeClass('btn-success');
                            $('#aStep6').removeClass('btn-success');
                        }
                        if (curstep == 4) {
                            $('#step-1').css("display", "none");
                            $('#step-3').css("display", "none");
                            $('#step-4').css("display", "none");
                            $('#step-5').css("display", "block");
                            $('#step-6').css("display", "none");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').removeAttr('disabled');
                            $('#aStep4').removeAttr('disabled');
                            $('#aStep5').removeAttr('disabled');
                            $('#aStep6').attr('disabled', true);
                            $('#aStep1').removeClass('btn-success');
                            $('#aStep3').removeClass('btn-success');
                            $('#aStep4').removeClass('btn-success');
                            $('#aStep5').addClass('btn-success');
                            $('#aStep6').removeClass('btn-success');
                        }
                        if (curstep == 5) {
                            $('#step-1').css("display", "none");
                            $('#step-3').css("display", "none");
                            $('#step-4').css("display", "none");
                            $('#step-5').css("display", "none");
                            $('#step-6').css("display", "block");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').removeAttr('disabled');
                            $('#aStep4').removeAttr('disabled');
                            $('#aStep5').removeAttr('disabled');
                            $('#aStep6').removeAttr('disabled');
                            $('#aStep1').removeClass('btn-success');
                            $('#aStep3').removeClass('btn-success');
                            $('#aStep4').removeClass('btn-success');
                            $('#aStep5').removeClass('btn-success')
                            $('#aStep6').addClass('btn-success')
                        }
                        if (curstep == 6) {
                            $('#step-1').css("display", "none");
                            $('#step-3').css("display", "none");
                            $('#step-4').css("display", "none");
                            $('#step-5').css("display", "none");
                            $('#step-6').css("display", "block");
                            $('#aStep1').removeAttr('disabled');
                            $('#aStep3').removeAttr('disabled');
                            $('#aStep4').removeAttr('disabled');
                            $('#aStep5').removeAttr('disabled');
                            $('#aStep6').removeAttr('disabled');
                            $('#aStep1').removeClass('btn-success');
                            $('#aStep3').removeClass('btn-success');
                            $('#aStep4').removeClass('btn-success');
                            $('#aStep5').removeClass('btn-success')
                            $('#aStep6').addClass('btn-success')
                        }
                        //DITO NASGSTART YUNG PAGFILL SA STEP1
                        $.ajax({
                            type: "GET"
                            , url: 'Organization/OrganizationProfile/FillStep4.php'
                            , dataType: 'json'
                            , data: {
                                _code: latcode
                            }
                            , success: function (data2) {
                                oTable2.fnClearTable();
                                $.each(data2, function (key, val) {
                                    var aiNew = oTable2.fnAddData([val.name, val.occ, '<center><a class="btn btn-danger delete" href="javascript:;"><i class="fa fa-trash-o" ></i></a></center>', ]);
                                    var nRow = oTable2.fnGetNodes(aiNew[0]);
                                });
                            }
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                            }
                        });
                        if (curstep > 1) {
                            $.ajax({
                                type: 'GET'
                                , url: 'Organization/OrganizationProfile/fillSteps.php'
                                , dataType: 'json'
                                , async: true
                                , cache: false
                                , data: {
                                    _appcode: latcode
                                }
                                , success: function (step) {
                                    document.getElementById('txtadvname').value = step.advname;
                                }
                                , error: function (response2) {
                                    swal(response2, "Please try again", "error");
                                }
                            });
                        }
                        //END NG FILL NG STEP1
                        // $('#btnStep2').click(function (e) {
                        //     e.preventDefault();
                        //     var drpcate = document.getElementById('drpcat');
                        //     var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                        //     var drpcatcode = drpcate.options[drpcate.selectedIndex].value;
                        //     if (drpcatname == 'Academic Organization') {
                        //         $.ajax({
                        //             type: 'post',
                        //             url: 'Organization/OrganizationProfile/pre_Step2.php',
                        //             data: {
                        //                 _appcode: latcode
                        //             },
                        //             success: function (response) {},
                        //             error: function (response) {
                        //                 swal(response, "Please try again", "error");
                        //             }
                        //         });
                        //         $('#e9 option:selected').each(function (index, brand) {
                        //             $.ajax({
                        //                 type: 'post',
                        //                 url: 'Organization/OrganizationProfile/Step2.php',
                        //                 async: true,
                        //                 data: {
                        //                     _appcode: latcode,
                        //                     _catcode: drpcatcode,
                        //                     _coucode: brand.value
                        //                 },
                        //                 success: function (response) {
                        //                 },
                        //                 error: function (response) {
                        //                     swal(response, "Please try again", "error");
                        //                 }
                        //             });
                        //         });
                        //         swal("Woaah, that's neat!", "The organization category is saved", "success");
                        //         $('#next2').click();
                        //     } else {
                        //         $.ajax({
                        //             type: 'post',
                        //             url: 'Organization/OrganizationProfile/pre_Step2.php',
                        //             data: {
                        //                 _appcode: latcode
                        //             },
                        //             success: function (response) {},
                        //             error: function (response) {
                        //                 swal(response, "Please try again", "error");
                        //             }
                        //         });
                        //         $.ajax({
                        //             type: 'post',
                        //             url: 'Organization/OrganizationProfile/Step2-b.php',
                        //             async: true,
                        //             data: {
                        //                 _appcode: latcode,
                        //                 _catcode: drpcatcode
                        //             },
                        //             success: function (response) {
                        //             },
                        //             error: function (response) {
                        //                 swal(response, "Please try again", "error");
                        //             }
                        //         });
                        //         swal("Woaah, that's neat!", "The organization category is saved", "success");
                        //         $('#next2').click();
                        //     }
                        // });
                        //DITO NASGSTART YUNG PAGFILL SA STEP2
                        //                        if (curstep > 2) {
                        //                            $.ajax({
                        //                                type: 'GET',
                        //                                url: 'Organization/OrganizationProfile/fillSteps.php',
                        //                                dataType: 'json',
                        //                                async: true,
                        //                                cache: false,
                        //                                data: {
                        //                                    _appcode: latcode
                        //                                },
                        //                                success: function (step) {
                        //                                    if (step.catname != 'Academic Organization') {
                        //                                        $('#course').addClass('hidden');
                        //                                    } else {
                        //                                        $('#course').removeClass('hidden');
                        //                                    }
                        //                                    $('#drpcat option').each(function (index, brand) {
                        //                                        if (brand.value == step.catcode) {
                        //                                            fillcat = fillcat + '<option value="' + step.catcode + '" selected >' + step.catname + '</option>';
                        //
                        //                                        } else {
                        //                                            fillcat = fillcat + '<option value="' + brand.value + '" >' + brand.text + '</option>';
                        //                                        }
                        //
                        //
                        //
                        //                                    });
                        //
                        //                                    var item = [];
                        //                                    var i = 0;
                        //                                    $.ajax({
                        //                                        type: 'GET',
                        //                                        url: 'Organization/OrganizationProfile/fillCourse.php',
                        //                                        dataType: 'json',
                        //                                        async: true,
                        //                                        cache: false,
                        //                                        data: {
                        //                                            _appcode: latcode
                        //                                        },
                        //                                        success: function (data2) {
                        //                                            $.each(data2, function (key, val) {
                        //                                                item.push(val.course);
                        //                                            });
                        //                                            $("#e9").select2("val", item);
                        //
                        //                                        },
                        //                                        error: function (response2) {
                        //                                            swal(response2, "Please try again", "error");
                        //                                        }
                        //
                        //                                    });
                        //
                        //                                    document.getElementById('drpcat').innerHTML = fillcat;
                        //
                        //                                },
                        //                                error: function (errorfill) {
                        //                                    swal(errorfill, "Please try again", "error");
                        //                                }
                        //
                        //                            });
                        //
                        //                        }
                        //END NG FILL NG STEP2
                        //DITO NASGSTART YUNG PAGFILL SA STEP3
                        if (curstep >= 3) {
                            $.ajax({
                                type: 'GET'
                                , url: 'Organization/OrganizationProfile/fillSteps.php'
                                , dataType: 'json'
                                , async: true
                                , cache: false
                                , data: {
                                    _appcode: latcode
                                }
                                , success: function (step) {
                                    document.getElementById('txtmission').value = step.mission;
                                    document.getElementById('txtvision').value = step.vision;
                                }
                                , error: function (response2) {
                                    swal(response2, "Please try again", "error");
                                }
                            });
                        }
                        //END NG FILL NG STEP3
                        //DITO NASGSTART YUNG PAGFILL SA STEP4
                        if (curstep >= 4) {
                            fillstep5();
                            $.ajax({
                                type: "GET"
                                , url: 'Organization/OrganizationProfile/FillStep5c.php'
                                , dataType: 'json'
                                , data: {
                                    _code: latcode
                                }
                                , success: function (data2) {
                                    oTable3.fnClearTable();
                                    $.each(data2, function (key, val) {
                                        var aiNew = oTable3.fnAddData(["<span posID='" + val.posID + "' studno='" + val.studno + "'>" + val.pos + "</span>", val.studno + " - " + val.name, '<center><a class="btn btn-danger delete" href="javascript:;"><i class="fa fa-trash-o" ></i></a></center>', ]);
                                        var nRow = oTable3.fnGetNodes(aiNew[0]);
                                    });
                                }
                                , error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }
                            });
                        }
                        //END NG FILL NG STEP4
                        //DITO NASGSTART YUNG PAGFILL SA STEP5
                        if (curstep == 5) {
                            $('#updaccreqlist tr ').each(function (index, brand) {
                                index++;
                                var reqcode = document.getElementById('updcode' + index).innerText;
                                $.ajax({
                                    type: 'GET'
                                    , url: 'Organization/OrganizationProfile/FillAccreditationTable.php'
                                    , async: true
                                    , cache: false
                                    , data: {
                                        _appcode: latcode
                                        , _reqcode: reqcode
                                    }
                                    , success: function (data2) {
                                        if (data2 == '1') {
                                            $('#chkupdstat' + index).prop('checked', true);
                                        }
                                        else {
                                            $('#chkupdstat' + index).prop('checked', false);
                                        }
                                    }
                                    , error: function (response2) {
                                        swal(response2, "Please try again", "error");
                                    }
                                });
                            });
                        }
                        //END NG FILL NG STEP5
                    }
                    , error: function (response) {
                        swal(response, "Please try again", "error");
                    }
                });
                $(".fileupload-new .thumbnail").find("img").attr("src", "../avatar/" + latcode + ".png");
                $("#fileupload").val("../avatar/" + latcode + ".png");
            });
            $('#editable-sample a.delete').on('click', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
                swal({
                    title: "Are you sure?"
                    , text: "The record will be save and will be use for Semester"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#DD6B55'
                    , confirmButtonText: 'Yes, do it!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post'
                            , url: 'Organization/OrganizationProfile/Delete-ajax.php'
                            , data: {
                                _code: getval
                            }
                            , success: function (response) {
                                swal("Record Deleted!", "The data is successfully deleted!", "success");
                                oTable.fnDeleteRow(nRow);
                            }
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                oTable.fnDeleteRow(nRow);
                            }
                        });
                    }
                    else swal("Cancelled", "The transaction is cancelled", "error");
                });
            });
            $('#editable-sample a.cancel').on('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }
                else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
            $('#editable-sample a.edit').on('click', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                document.getElementById('txtgetid').value = $(this).closest('tr').children('td:first').text();
                $.ajax({
                    type: "GET"
                    , url: 'Organization/OrganizationProfile/GetData-ajax.php'
                    , dataType: 'json'
                    , data: {
                        _id: id
                    }
                    , success: function (data) {
                        document.getElementById('txtupdcode').value = data.code;
                        document.getElementById('txtupdname').value = data.name;
                        document.getElementById('txtupddesc').value = data.desc;
                        if (data.accstat == 'Accredited') document.getElementById("chkupdacc").checked = true;
                        else document.getElementById("chkupdacc").checked = false;
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
        }
    };
}()
var EditableTable2 = function () {
    return {
        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }
                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 3, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="btn btn-success edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnDraw();
            }
            var oTable = $('#editable-sample2').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1]
                    , [5, 15, 20, "All"] // change per page values here
                ]
                , // set the initial value
                "iDisplayLength": 5
                , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                , "sPaginationType": "bootstrap"
                , "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                    , "oPaginate": {
                        "sPrevious": "Prev"
                        , "sNext": "Next"
                    }
                }
                , "aoColumnDefs": [{
                        'bSortable': false
                        , 'aTargets': [0]
                    }
                ]
            });
            jQuery('#editable-sample2_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample2_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var nEditing = null;
            $('#tblpos').on('click', 'a.delete', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getcode = $(this).closest('tr').children('td:first').text();
                swal({
                    title: "Are you sure?"
                    , text: "The record will be save and will be use for transaction"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#DD6B55'
                    , confirmButtonText: 'Yes, do it!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post'
                            , url: 'Organization/OrganizationProfile/DeletePosition.php'
                            , data: {
                                _orgcode: latcode
                                , _code: getcode
                            }
                            , success: function (response) {
                                swal("Record Deleted!", "The data is successfully deleted!", "success");
                                oTable.fnDeleteRow(nRow);
                            }
                            , error: function (response) {
                                swal(response + "Error encountered while adding data", "Please try again", "error");
                                oTable.fnDeleteRow(nRow);
                            }
                        });
                    }
                    else swal("Cancelled", "The transaction is cancelled", "error");
                });
            });
            $('#editable-sample2 a.cancel').on('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }
                else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
        }
    };
}();
var EditableTable3 = function () {
    return {
        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }
                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 3, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate('<a class="btn btn-success edit" href="">Edit</a>', nRow, 3, false);
                oTable.fnDraw();
            }
            var oTable = $('#editable-sample3').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1]
                    , [5, 15, 20, "All"] // change per page values here
                ]
                , // set the initial value
                "iDisplayLength": 5
                , "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>"
                , "sPaginationType": "bootstrap"
                , "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page"
                    , "oPaginate": {
                        "sPrevious": "Prev"
                        , "sNext": "Next"
                    }
                }
                , "aoColumnDefs": [{
                        'bSortable': false
                        , 'aTargets': [0]
                    }
                ]
            });
            jQuery('#editable-sample3_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample3_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var nEditing = null;
            $('#tbloff').on('click', 'a.delete', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var id = $(this).closest('tr').children('td:first').find("span").attr("posID");
                var studno = $(this).closest('tr').children('td:first').find("span").attr("studno");
                swal({
                    title: "Are you sure?"
                    , text: "The record will be save and will be use for transaction"
                    , type: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: '#DD6B55'
                    , confirmButtonText: 'Yes, do it!'
                    , cancelButtonText: "No!"
                    , closeOnConfirm: false
                    , closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post'
                            , url: 'Organization/OrganizationProfile/DeleteOfficer.php'
                            , data: {
                                _studno: studno
                                , _posid: id
                            }
                            , success: function (response) {
                                swal("Record Deleted!", "The data is successfully deleted!", "success");
                                $('#editable-sample3').dataTable({}).fnDeleteRow(nRow);
                            }
                            , error: function (response) {
                                swal(response + "Error encountered while adding data", "Please try again", "error");
                            }
                        });
                    }
                    else swal("Cancelled", "The transaction is cancelled", "error");
                });
            });
            $('#editable-sample3 a.cancel').on('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }
                else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
        }
    };
}();
