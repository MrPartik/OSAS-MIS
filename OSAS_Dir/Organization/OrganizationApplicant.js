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
                },aaSorting:[[0,"desc"]]
            });
            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var nEditing = null;
            $('#submit-data').click(function (e) {
                e.preventDefault();
                //                var code = document.getElementById('txtcode').value;
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var year = $('#editable-sample').attr('batch-year');
                var e = document.getElementById("drpcat");
                var getcat = e.options[e.selectedIndex].text;
                var getcatval = e.options[e.selectedIndex].value;
                if (document.getElementById("nonacad") != null) {
                    var f = document.getElementById("nonacad");
                    var nonacad = f.options[f.selectedIndex].value;
                }
                var accstat = '';
                var chkstat = '';
                var chkcode = '';
                var stat = 0;
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
                            , url: 'Organization/Applicant/Add-ajax.php'
                            , data: {
                                _name: name
                                , _desc: desc
                                , _catcode: getcatval
                                , _year: year
                            }
                            , success: function (compcode) {
                                if (getcatval == 'ACAD_ORG') {
                                    $('#e9 option:selected').each(function (index, brand) {
                                        $.ajax({
                                            type: 'post'
                                            , url: 'Organization/Applicant/AcadOrg.php'
                                            , async: true
                                            , data: {
                                                _appcode: compcode
                                                , _catcode: getcatval
                                                , _coucode: brand.value
                                            }
                                            , success: function (response) {
                                                swal("Record Added!", "The data is successfully Added!", "success");
                                                document.getElementById("form-data").reset();
                                            }
                                            , error: function (response) {
                                                swal(response, "Please try again", "error");
                                            }
                                        });
                                    });
                                }
                                else if (getcatval == 'NONACAD_ORG') {
                                    $.ajax({
                                        type: 'post'
                                        , url: 'Organization/Applicant/NonAcadOrg.php'
                                        , async: true
                                        , data: {
                                            _appcode: compcode
                                            , _catcode: nonacad
                                        }
                                        , success: function (response) {
                                            swal("Record Added!", "The data is successfully Added!", "success");
                                            document.getElementById("form-data").reset();
                                        }
                                        , error: function (response) {
                                            swal(response, "Please try again", "error");
                                        }
                                    });
                                }
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
            });
            $('#updsubmit-data').click(function (e) {
                e.preventDefault();
                var code = document.getElementById('txtupdcode').value;
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var e = document.getElementById("drpcat");
                var getcat = e.options[e.selectedIndex].text;
                var getcatval = e.options[e.selectedIndex].value;
                var f = document.getElementById("nonacad");
                var nonacad = f.options[f.selectedIndex].value;
                var accstat = '';
                var getid = document.getElementById('txtgetid').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;
                $("#updclose").click();
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
                            , url: 'Organization/Applicant/Update-ajax.php'
                            , data: {
                                _id: getid
                                , _code: code
                                , _name: name
                                , _desc: desc
                                , _catcode: getcatval
                                , _accstat: accstat
                            }
                            , success: function (response) {}
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openModalupd").click();
                            }
                        });
                        $.ajax({
                            type: 'GET'
                            , url: 'Organization/Applicant/Pre_acad.php'
                            , data: {
                                _appcode: code
                            }
                            , success: function (data2) {}
                            , error: function (response2) {
                                swal("error", "Please try again", "error");
                            }
                        });
                        if (getcatval == 'ACAD_ORG') {
                            $.ajax({
                                type: 'post'
                                , url: 'Organization/Applicant/Pre_acad.php'
                                , data: {
                                    _appcode: code
                                }
                                , success: function (response) {}
                                , error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    $("#openAddmodal").click();
                                }
                            });
                            $('#e9 option:selected').each(function (index, brand) {
                                $.ajax({
                                    type: 'post'
                                    , url: 'Organization/Applicant/UpdAcadOrg.php'
                                    , async: true
                                    , data: {
                                        _appcode: code
                                        , _catcode: getcatval
                                        , _coucode: brand.value
                                    }
                                    , success: function (response) {
                                        swal({
                                            title: "Record Updated!"
                                            , text: "The data is successfully Added!"
                                            , type: "success"
                                            , confirmButtonColor: '#88A755'
                                            , confirmButtonText: 'Okay'
                                            , closeOnConfirm: false
                                        }, function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.reload();
                                            }
                                        });
                                    }
                                    , error: function (response) {
                                        swal(response, "Please try again", "error");
                                    }
                                });
                            });
                        }
                        else if (getcatval == 'NONACAD_ORG') {
                            $.ajax({
                                type: 'post'
                                , url: 'Organization/Applicant/NonAcadOrg.php'
                                , async: true
                                , data: {
                                    _appcode: code
                                    , _catcode: nonacad
                                }
                                , success: function (response) {
                                    swal({
                                        title: "Record Updated!"
                                        , text: "The data is successfully Added!"
                                        , type: "success"
                                        , confirmButtonColor: '#88A755'
                                        , confirmButtonText: 'Okay'
                                        , closeOnConfirm: false
                                    }, function (isConfirm) {
                                        if (isConfirm) {
                                            window.location.reload();
                                        }
                                    });
                                }
                                , error: function (response) {
                                    swal(response, "Please try again", "error");
                                }
                            });
                        }
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                    }
                });
            });
            $('#editable-sample a.delete').on('click', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
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
                            , url: 'Organization/Applicant/Delete-ajax.php'
                            , data: {
                                _code: getval
                            }
                            , success: function (response) {
                                swal({
                                    title: "Record Deleted!"
                                    , text: "The data is successfully Deleted!"
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
                                oTable.fnDeleteRow(nRow);
                            }
                        });
                    }
                    else swal("Cancelled", "The transaction is cancelled", "error");
                });
            });
            $('#editable-sample a.retrieve').on('click', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
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
                            , url: 'Organization/Applicant/Retrieve-ajax.php'
                            , data: {
                                _code: getval
                            }
                            , success: function (response) {
                                swal({
                                    title: "Record Retrieve!"
                                    , text: "The data is successfully Retrieved!"
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
                $('#updsubmit-data').show();
                $('#submit-data').hide();
                var id = $(this).closest('tr').children('td:first').text();
                document.getElementById('txtgetid').value = $(this).closest('tr').children('td:first').text();
                $('#formcode').show();
                $.ajax({
                    type: "GET"
                    , url: 'Organization/Applicant/GetData-ajax.php'
                    , dataType: 'json'
                    , data: {
                        _id: id
                    }
                    , success: function (data) {
                        document.getElementById('txtupdcode').value = data.code;
                        document.getElementById('txtname').value = data.name;
                        document.getElementById('txtdesc').value = data.desc;
                        document.getElementById('drpcat').value = data.catcode;
                        if (data.catcode == 'ACAD_ORG') {
                            $('#drpnon').hide();
                            $('#course').show();
                            var item = [];
                            var i = 0;
                            $.ajax({
                                type: 'GET'
                                , url: 'Organization/Applicant/fillcourse.php'
                                , dataType: 'json'
                                , async: true
                                , cache: false
                                , data: {
                                    _appcode: data.code
                                }
                                , success: function (data2) {
                                    //                                    alert(data2)
                                    $.each(data2, function (key, val) {
                                        item.push(val.course);
                                        //                                        alert(val.course)
                                    });
                                    $("#e9").select2("val", item);
                                }
                                , error: function (response2) {
                                    swal("error", "Please try again", "error");
                                }
                            });
                        }
                        else if (data.catcode == 'NONACAD_ORG') {
                            $('#drpnon').show();
                            $('#course').hide();
                        }
                        else {
                            $('#drpnon').hide();
                            $('#course').hide();
                        }
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
        }
    };
}()
