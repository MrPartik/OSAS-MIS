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
                if (document.getElementById('chkupdacc').checked)
                    oTable.fnUpdate('Accredited', nRow, 3, false);
                else
                    oTable.fnUpdate('This application is ready for accreditation', nRow, 3, false);

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
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ records per page",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;


            $('#submit-data').click(function (e) {
                e.preventDefault();

                //                var code = document.getElementById('txtcode').value;
                var name = document.getElementById('txtname').value;
                var desc = document.getElementById('txtdesc').value;
                var date = document.getElementById('txtdate').value;

                $("#close").click();

                swal({
                    title: "Are you sure?",
                    text: "This data will be saved and used for further transaction",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post',
                            url: 'Event/Add-ajax.php',
                            data: {
                                _name: name,
                                _desc: desc,
                                _date: date

                            },
                            success: function (response) {
                                swal({
                                    title: "Request Send!",
                                    text: "The request is successfully send!",
                                    type: "success",
                                    confirmButtonColor: '#88A755',
                                    confirmButtonText: 'Okay',
                                    closeOnConfirm: false
                                }, function (isConfirm) {
                                    window.location.reload();

                                });                                
                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openAddmodal").click();
                            }
                        });
                    } else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                        //                        $("#openAddmodal").click();
                        document.getElementById("form-data").reset();
                    }
                });

            });

            $('#updsubmit-data').click(function (e) {
                e.preventDefault();
                var date = document.getElementById('txtupddate').value;
                var name = document.getElementById('txtupdname').value;
                var desc = document.getElementById('txtupddesc').value;
                $("#updclose").click();

                swal({
                    title: "Are you sure?",
                    text: "This data will be saved and used for further transaction",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes!',
                    cancelButtonText: "No!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: 'post',
                            url: 'Event/Update-ajax.php',
                            data: {
                                _code: latcode,
                                _name: name,
                                _desc: desc,
                                _date: date


                            },
                            success: function (response) {
                                swal({
                                    title: "Record Updated!!",
                                    text: "The data is successfully updated!",
                                    type: "success",
                                    confirmButtonColor: '#88A755',
                                    confirmButtonText: 'Okay',
                                    closeOnConfirm: false
                                }, function (isConfirm) {
                                    window.location.reload();

                                });


                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                $("#openModalupd").click();
                            }
                        });
                    } else {
                        swal("Cancelled", "The transaction is cancelled", "error");
                    }
                });



            });

            $('#editable-sample a.delete').on('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();

                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for further transaction",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'Event/Delete-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal({
                                        title: "Record Deleted!",
                                        text: "The data is successfully Deleted!",
                                        type: "success",
                                        confirmButtonColor: '#88A755',
                                        confirmButtonText: 'Okay',
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        window.location.reload();

                                    });
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    oTable.fnDeleteRow(nRow);
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });

            $('#editable-sample a.retrieve').on('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();

                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for further transaction",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'Event/Retrieve-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal({
                                        title: "Record Retrieve!",
                                        text: "The data is successfully Retrieved!",
                                        type: "success",
                                        confirmButtonColor: '#88A755',
                                        confirmButtonText: 'Okay',
                                        closeOnConfirm: false
                                    }, function (isConfirm) {
                                        window.location.reload();

                                    });
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                    oTable.fnDeleteRow(nRow);
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });

            $('#editable-sample a.cancel').on('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });



            $('#editable-sample a.edit').on('click', function (e) {
                e.preventDefault();
                var id = $(this).closest('tr').children('td:first').text();
                latcode = id;
                $.ajax({
                    type: "GET",
                    url: 'Event/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _id: id
                    },
                    success: function (data) {
//                        alert(data)
                        document.getElementById('txtupddate').value = data.date;
                        document.getElementById('txtupdname').value = data.name;
                        document.getElementById('txtupddesc').value = data.desc;
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


            });
        }

    };

}()
