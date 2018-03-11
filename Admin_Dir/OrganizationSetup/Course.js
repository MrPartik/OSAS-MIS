var getcode = '';
var getname = '';
var latcode = '';
var getyear = '';

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
                    //                    jqTds[2].innerHTML = '<input type="text" class="form-control small" value="' + aData[2] + '" style="width:100%">';

                    $.ajax({
                        type: "GET",
                        url: 'OrganizationSetup/Course/GetYear.php',
                        dataType: 'json',
                        data: {
                            _code: aData[2]


                        },
                        success: function (data) {
                            jqTds[2].innerHTML = '<select class="form-control input-sm m-bot15 updselectYear" style="width:100%" id="updselcode"> ' + data.option + '</select>';
                        },
                        error: function (response) {
                            swal("Error encountered while Editing data", "Please try again", "error");
                        }


                    });

                    jqTds[3].innerHTML = '<input type="text" class="form-control small" value="' + aData[3] + '" style="width:100%">';
                    jqTds[4].innerHTML = '<center><a class="btn btn-success  edit" href="">Save</a> <a class="btn btn-danger cancel" href="">Cancel</a></center>';

                }

            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                var jqSel = $('select', nRow);
                //                alert(jqInputs[2].value);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
                oTable.fnUpdate(jqSel[0].value, nRow, 2, false);
                oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 4, false);
                oTable.fnDraw();


            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                oTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                oTable.fnUpdate('<a class="btn btn-success edit" href="">Edit</a>', nRow, 4, false);
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
                /*
                if (addflag == 0) {

                    var aiNew = oTable.fnAddData(['', '', '', '', '']);
                    var nRow = oTable.fnGetNodes(aiNew[0]);
                    editRow(oTable, nRow);
                    nEditing = nRow;

                }*/
                var txtname = document.getElementById("txtname").value;
                var txtdesc = document.getElementById("txtdesc").value;
                var txtcode = document.getElementById("txtcode").value;
                var getsel = document.getElementById("selcode");
                var getyear = getsel.options[getsel.selectedIndex].value;



                $("#close").click();


                swal({
                        title: "Are you sure?",
                        text: "The record will be save and will be use for Designated Office",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'OrganizationSetup/Course/Add-ajax.php',
                                data: {
                                    _name: txtname,
                                    _year: getyear,
                                    _code: txtcode,
                                    _desc: txtdesc
                                },
                                success: function (response) {
                                    swal("Record Added!", "The data is successfully added!", "success");
                                    var aiNew = oTable.fnAddData([txtcode, txtname, getyear, txtdesc, '<center><a class="btn btn-success  edit" href="">Edit</a> <a class="btn btn-danger delete" href="javascript:;">Delete</a>	</center>', '']);
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

            });
            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();;


                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for Semester",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, do it!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'post',
                                url: 'OrganizationSetup/Course/Delete-ajax.php',
                                data: {
                                    _code: getval
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    oTable.fnDeleteRow(nRow);
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
                //                alert(this.innerHTML);

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    var getval = $('.updselectYear').val();

                    alert(getval);
                    if (jqInputs[1].value.length < 100 && jqInputs[1].value.length > 5 && jqInputs[2].value.length < 100 && jqInputs[2].value.length > 5) {
                        $.ajax({
                            type: 'post',
                            url: 'OrganizationSetup/Course/Update-ajax.php',
                            data: {
                                _name: jqInputs[1].value,
                                _desc: jqInputs[2].value,
                                _year: getval,
                                _code: jqInputs[0].value

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

                        swal("Error", "The Office name must be less than 100 characters", "error");

                    } else if (jqInputs[1].value.length < 5) {

                        swal("Error", "Please enter a valid Office name", "error");

                    } else if (jqInputs[3].value.length > 100) {

                        swal("Error", "The Office description must be less than 100 characters", "error");

                    } else if (jqInputs[3].value.length < 5) {

                        swal("Error", "Please enter a valid Office description", "error");

                    }
                } else if (nEditing == nRow && this.innerHTML == "Add") {

                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    var e = document.getElementById(jqInputs[0].value);
                    getyear = e.options[e.selectedIndex].text;
                    $.ajax({
                        type: 'post',
                        url: 'OrganizationSetup/Course/Add-ajax.php',
                        data: {
                            _name: jqInputs[1].value,
                            _year: getyear,
                            _desc: jqInputs[2].value


                        },
                        success: function (response) {
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


                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();
