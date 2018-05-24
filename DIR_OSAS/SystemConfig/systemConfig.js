var getcode = '';
var getname = '';
var latcode = '';
var addflag = 0;
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
                    jqTds[0].innerHTML = '<input type="text" class="form-control small " value="' + aData[0] + '" disabled style="width:100%" >';
                    jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '" style="width:100%">';
                    jqTds[3].innerHTML = '<center><a class="btn btn-success  edit" href=""><i class="fa fa-save"></i></a> <a class="btn btn-danger cancel" href=""><i class="fa fa-ban"></i></a></center>';
                }
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate("<center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-rotate-right'></i></a></center>", nRow, 3, false);
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
                    [5, 10, 15, 20, -1]
                    , [5, 10, 15, 20, "All"] // change per page values here
                ], // set the initial value
                "iDisplayLength": 10
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
                        , 'aTargets': [3]
                    }
                ]
            });
            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            var nEditing = null;
            $('#editable-sample a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                }
                else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
                addflag = 0;
            });
            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];
                //						alert(this.innerHTML);
                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    //if (addflag == 0)
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
                else if (nEditing == nRow && this.innerText == "") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[1].value.length) {
                        $.ajax({
                            type: 'post'
                            , url: 'SystemConfig/edit.php'
                            , data: {
                                insertt: "asd"
                                , name: jqInputs[0].value
                                , prop: jqInputs[1].value
                            }
                            , success: function (response) {
                                swal({
                                    title: "Record Updated!"
                                    , text: "The data is successfully updated!"
                                    , type: "success"
                                    , showCancelButton: false
                                    , confirmButtonColor: '#86CCEB'
                                    , confirmButtonText: 'Ok'
                                    , closeOnConfirm: false
                                    , closeOnCancel: false
                                }, function (isConfirm) {
                                    location.reload();
                                });
                            }
                            , error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                                saveRow(oTable, nEditing);
                                nEditing = null;
                            }
                        });
                    }
                    else {
                        swal("Error", "Please enter a valid property", "error");
                    }
                }
                else if (nEditing == nRow && this.innerHTML == "Add") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[1].value.length < 100 && jqInputs[1].value.length > 5 && jqInputs[2].value.length < 100 && jqInputs[2].value.length > 5) {
                        swal({
                            title: "Are you sure?"
                            , text: "The record will be save and will be use for further transaction"
                            , type: "warning"
                            , showCancelButton: true
                            , confirmButtonColor: '#86CCEB'
                            , confirmButtonText: 'Yes, do it!'
                            , cancelButtonText: "No!"
                            , closeOnConfirm: false
                            , closeOnCancel: false
                        }, function (isConfirm) {
                            if (isConfirm) {
                                $.ajax({
                                    type: 'post'
                                    , url: 'OrganizationSetup/AccreditationRequirement/Add-ajax.php'
                                    , data: {
                                        _name: jqInputs[1].value
                                        , _desc: jqInputs[2].value
                                    }
                                    , success: function (response) {
                                        swal({
                                            title: "Record Delete!"
                                            , text: "The data is successfully delete!"
                                            , type: "success"
                                            , confirmButtonColor: '#86CCEB'
                                            , confirmButtonText: 'Okay'
                                            , closeOnConfirm: false
                                        }, function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.reload();
                                            }
                                            else swal("Cancelled", "The transaction is cancelled", "error");
                                        });
                                        swal("Record Added!", "The data is successfully added!", "success");
                                        saveRow(oTable, nEditing);
                                        nEditing = null;
                                        addflag = 0;
                                    }
                                    , error: function (response) {
                                        swal("Error encountered while adding data", "Please try again", "error");
                                        saveRow(oTable, nEditing);
                                        nEditing = null;
                                    }
                                });
                            }
                            else swal("Cancelled", "The transaction is cancelled", "error");
                        });
                    }
                    else if (jqInputs[1].value.length > 100) {
                        swal("Error", "The Office name must be less than 100 characters", "error");
                    }
                    else if (jqInputs[1].value.length < 5) {
                        swal("Error", "Please enter a valid Office name", "error");
                    }
                    else if (jqInputs[2].value.length > 100) {
                        swal("Error", "The Office description must be less than 100 characters", "error");
                    }
                    else if (jqInputs[2].value.length < 5) {
                        swal("Error", "Please enter a valid Office description", "error");
                    }
                }
                else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }
    };
}();