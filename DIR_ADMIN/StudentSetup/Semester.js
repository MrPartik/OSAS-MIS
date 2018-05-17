var getcode = '';
var getname = '';
var latcode = '';


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

                getcode = aData[0];
                if (getcode != '') {

                    jqTds[0].innerHTML = '<input type="text" class="form-control small " value="' + aData[0] + '" style="width:100%" >';
                    jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '" style="width:100%">';
                    jqTds[2].innerHTML = '<center><a class="btn btn-success  edit" href=""><i class="fa fa-save"></i></a> <a class="btn btn-danger cancel" href=""><i class="fa fa-ban"></i></a></center>';

                }
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);

                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate("<center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a></center>", nRow, 2, false);
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
                        'aTargets': [2]
                    }
                ]
            });

            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            //            $('#editable-sample_new').click(function (e) {
            //                e.preventDefault();
            //                var aiNew = oTable.fnAddData(['', '', '', '',
            //                        '<a class="btn btn-success edit" href="">Edit</a>', '<a class="btn btn-danger cancel" data-mode="new" href="">Cancel</a>'
            //                ]);
            //                var nRow = oTable.fnGetNodes(aiNew[0]);
            //                editRow(oTable, nRow);
            //                nEditing = nRow;
            //            });

            $('#submit-data').click(function (e) {
                e.preventDefault();
                /*
                if (addflag == 0) {

                    var aiNew = oTable.fnAddData(['', '', '', '', '']);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow);
                    nEditing = nRow;

                }*/
                var txtname = document.getElementById("txtname").value;
                var txtdesc = document.getElementById("txtdesc").value;


                $("#close").click();
                if(txtname.length != 0){
                    if(txtdesc.length != 0){
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
                                    url: 'StudentSetup/Semester/Add-ajax.php',
                                    data: {
                                        _name: txtname,
                                        _desc: txtdesc
                                    },
                                    success: function (response) {
                                        swal("Record Added!", "The data is successfully added!", "success");
                                        var aiNew = oTable.fnAddData([ txtname, txtdesc, "<center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a></center>", '']);
                                        var nRow = oTable.fnGetNodes(aiNew[0]);
                                        document.getElementById("form-data").reset();
                                    },
                                    error: function (response) {
                                        swal("Error encountered while adding data", "Please try again", "error");
                                        $("#editable-sample_new").click();
                                    }

                                });

                            } else {

                                swal("Cancelled", "The transaction is cancelled", "error");
                                $("#editable-sample_new").click();
                            }

                        });
                    
                    }
                    else{
                        swal({
                            title: "Please enter a valid description",
                            text: "Please check your description field",
                            type: "error",
                            confirmButtonColor: '#88A755',
                            confirmButtonText: 'Okay',
                            closeOnConfirm: true
                        }, function (isConfirm) {
                            $("#editable-sample_new").click();

                        });
                    }
                    
                }
                else{
                    swal({
                        title: "Please enter a valid name",
                        text: "Please check your name field",
                        type: "error",
                        confirmButtonColor: '#88A755',
                        confirmButtonText: 'Okay',
                        closeOnConfirm: true
                    }, function (isConfirm) {
                        $("#editable-sample_new").click();
                        
                    });
                }
                
            });
            $('#editable-sample a.delete').live('click', function (e) {
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
                                url: 'StudentSetup/Semester/Delete-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal({

                                            title: "Record Deleted!",
                                            text: "The data is successfully deleted!",
                                            type: "success",
                                            confirmButtonColor: '#86CCEB',
                                            confirmButtonText: 'Okay',
                                            closeOnConfirm: false
                                        },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.reload();

                                            } else
                                                swal("Cancelled", "The transaction is cancelled", "error");

                                        });
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });

            $('#editable-sample a.retrieve').live('click', function (e) {
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
                                url: 'StudentSetup/Semester/Retrieve-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal({

                                            title: "Record Retrieve!",
                                            text: "The data is successfully retrieve!",
                                            type: "success",
                                            confirmButtonColor: '#86CCEB',
                                            confirmButtonText: 'Okay',
                                            closeOnConfirm: false
                                        },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.reload();

                                            } else
                                                swal("Cancelled", "The transaction is cancelled", "error");

                                        });


                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });

                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });
            });


            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });



            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];
                //						alert(this.innerHTML);

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerText == "") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[0].value.length < 100 && jqInputs[0].value.length > 0 && jqInputs[1].value.length < 100 && jqInputs[1].value.length > 0) {
                        $.ajax({
                            type: 'post',
                            url: 'StudentSetup/Semester/Update-ajax.php',
                            data: {
                                _name: jqInputs[0].value,
                                _desc: jqInputs[1].value,
                                _code: getcode

                            },
                            success: function (response) {
                                swal("Record Updated!", "The data is successfully updated!", "success");
                                saveRow(oTable, nEditing);
                                nEditing = null;
                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                saveRow(oTable, nEditing);
                                nEditing = null;
                            }

                        });

                    } else if (jqInputs[1].value.length > 100) {

                        swal("Error", "The name must be less than 100 characters", "error");

                    } else if (jqInputs[1].value.length < 1) {

                        swal("Error", "Please enter a valid name", "error");

                    } else if (jqInputs[0].value.length > 100) {

                        swal("Error", "The description must be less than 100 characters", "error");

                    } else if (jqInputs[0].value.length < 1) {

                        swal("Error", "Please enter a valid description", "error");

                    }
                } else if (nEditing == nRow && this.innerHTML == "Add") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[1].value.length < 100 && jqInputs[1].value.length > 5 && jqInputs[2].value.length < 100 && jqInputs[2].value.length > 5) {
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
                                        url: 'StudentSetup/Semester/Add-ajax.php',
                                        data: {
                                            _name: jqInputs[1].value,
                                            _desc: jqInputs[2].value


                                        },
                                        success: function (response) {
                                            alert(jqInputs[1].value, );
                                            swal("Record Added!", "The data is successfully added!", "success");
                                            saveRow(oTable, nEditing);
                                            nEditing = null;
                                        },
                                        error: function (response) {
                                            swal("Error encountered while adding data", "Please try again", "error");
                                            saveRow(oTable, nEditing);
                                            nEditing = null;
                                        }

                                    });

                                } else
                                    swal("Cancelled", "The transaction is cancelled", "error");

                            });


                    } else if (jqInputs[1].value.length > 100) {

                        swal("Error", "The Office name must be less than 100 characters", "error");

                    } else if (jqInputs[1].value.length < 5) {

                        swal("Error", "Please enter a valid Office name", "error");

                    } else if (jqInputs[2].value.length > 100) {

                        swal("Error", "The Office description must be less than 100 characters", "error");

                    } else if (jqInputs[2].value.length < 5) {

                        swal("Error", "Please enter a valid Office description", "error");

                    }
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();
