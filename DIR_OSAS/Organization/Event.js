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
                , "aoColumnDefs": [{
                        'bSortable': false
                        , 'aTargets': [0]
                    }
                ]
            });
            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var oTable2 = $('#editable-sample2').dataTable({});
            var nEditing = null;
            $('#submit-data').click(function (e) {
                e.preventDefault();
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var date = document.getElementById('txtdate').value;
                var e = document.getElementById("drporg");
                var getcat = e.options[e.selectedIndex].text;
                var getcatval = e.options[e.selectedIndex].value;
                var file_data = $('#docFile').prop('files')[0];
                if (name.length && desc.length && date.length && $('#docFile').val().length && getcatval.length) {
                    var formdata = new FormData();
                    formdata.append("_name", name);
                    formdata.append("_desc", desc);
                    formdata.append("_org", getcatval);
                    formdata.append("_date", date);
                    formdata.append("file", file_data);
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
                                , url: 'Organization/Event/Add-ajax.php'
                                , data: formdata
                                , cache: false
                                , contentType: false
                                , processData: false
                                , success: function (response) {
                                    swal({
                                        title: "Record Added!"
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
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    $("#openAddmodal").click();
                                }
                            });
                        }
                        else {
                            swal("Cancelled", "The transaction is cancelled", "error");
                            document.getElementById("form-data").reset();
                        }
                    });
                }else
                    {
                            swal("Please complete your inputs", "The transaction is cancelled, please try again", "error");
                    }
            });
            $('#updsubmit-data').click(function (e) {
                e.preventDefault();
                var date = document.getElementById('txtupddate').value;
                var name = document.getElementById('txtupdname').value;
                var desc = document.getElementById('txtupddesc').value;
                var e = document.getElementById("drupdporg");
                var getcat = e.options[e.selectedIndex].text;
                var getcatval = e.options[e.selectedIndex].value;
                $("#updclose").click();
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
                            , url: 'Organization/Event/Update-ajax.php'
                            , data: {
                                _code: latcode
                                , _name: name
                                , _desc: desc
                                , _date: date
                                , _org: getcatval
                            }
                            , success: function (response) {
                                swal({
                                    title: "Record Updated!"
                                    , text: "The data is successfully Updated!!"
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
                                swal("Error encountered while adding data", "Please try again", "error");
                            }
                        });
                    }
                    else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                    }
                });
            });
            $('#updappsubmit-data').click(function (e) {
                e.preventDefault();
                var name = document.getElementById('txtappupdname').value;
                var date = document.getElementById('txtappupddate').value;
                var desc = document.getElementById('txtappupddesc').value;
                $("#updappclose").click();
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
                            , url: 'Organization/Event/Update2-ajax.php'
                            , data: {
                                _code: latcode
                                , _name: name
                                , _desc: desc
                                , _date: date
                            }
                            , success: function (response) {
                                swal({
                                    title: "Record Updated!"
                                    , text: "The data is successfully Updated!!"
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
                                swal("Error encountered while adding data", "Please try again", "error");
                            }
                        });
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
                            , url: 'Organization/Event/Delete-ajax.php'
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
                            , url: 'Organization/Event/Retrieve-ajax.php'
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
                var id = $(this).closest('tr').children('td:first').text();
                latcode = id;
                $.ajax({
                    type: "GET"
                    , url: 'Organization/Event/GetData-ajax.php'
                    , dataType: 'json'
                    , data: {
                        _id: id
                    }
                    , success: function (data) {
                        document.getElementById('txtupddate').value = data.date;
                        document.getElementById('txtupdname').value = data.name;
                        document.getElementById('txtupddesc').value = data.desc;
                        document.getElementById('drupdporg').value = data.orgname;
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
            $('#editable-sample a.ApproveEdit').on('click', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                latcode = id;
                $.ajax({
                    type: "GET"
                    , url: 'Organization/Event/GetData-ajax.php'
                    , dataType: 'json'
                    , data: {
                        _id: id
                    }
                    , success: function (data) {
                        document.getElementById('txtappupddate').value = data.date;
                        document.getElementById('txtappupdname').value = data.name;
                        document.getElementById('txtappupddesc').value = data.desc;
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
            $('#editable-sample').on('click', 'a.info', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                latcode = id;
                $.ajax({
                    type: "POST"
                    , url: 'Organization/Event/Info.php'
                    , data: {
                        event: id
                    }
                    , success: function (data) {
                        //                        alert(data)
                        document.getElementById('InfoBody').innerHTML = data
                    }
                    , error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }
                });
            });
            $('#editable-sample2').on('click', 'a.btnApprove', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                swal({
                    title: "Are you sure?"
                    , text: id + " will be approved, please make sure that you are aware on what you're doing ;)"
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
                            , url: 'Organization/Event/Approved.php'
                            , data: {
                                item: id
                            }
                            , success: function (response) {
                                swal({
                                    title: id + " Approved!"
                                    , text: "The data is successfully added!"
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
            $('#editable-sample2').on('click', 'a.btnReject', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                swal({
                    title: "Are you sure?"
                    , text: id + " will be reject, please make sure that you are aware on what you're doing ;)"
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
                            , url: 'Organization/Event/Rejected.php'
                            , data: {
                                item: id
                            }
                            , success: function (response) {
                                swal({
                                    title: id + " Rejected!"
                                    , text: "The data is successfully Rejected!"
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
        }
    };
}()
