var getcode = '';
var getname = '';
var latcode = '';
var getlatcode = '';
var codeforupdate = '';


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
                //.substring(aData[0].indexOf("*") + 5, aData[0].length)
                codeforupdate = aData[0];
                jqTds[0].innerHTML = '<input type="text" class="form-control small " value="' + aData[0] + '"  style="width:100%" >';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '" style="width:100%">';
                jqTds[2].innerHTML = "<center><a class='btn btn-success edit' href='javascript:;'><i class='fa fa-save'></i></a> <a class='btn btn-danger cancel' href='javascript:;'><i class='fa fa-ban'></i></a></center>";

            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);

                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                oTable.fnUpdate("<center> <a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center>", nRow, 2, false);
                oTable.fnDraw();


            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
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




            $('#editable-sample_new').live('click', function (e) {
                e.preventDefault();
                if (getlatcode == '') {

                    swal("Please select first an Organization", "Please try again", "error");

                } else {

                    $('#Add').modal('toggle');

                }
            });
            $('#selOrg').change(function () {

                //PINAKAIMPORTANTEST HAHAHAH GUMANAAMPU
                var _selOrg = document.getElementById('selOrg');
                var selOrg = _selOrg.options[_selOrg.selectedIndex].value;

                var oTable = $('#editable-sample').dataTable();
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationPosition/GetPositionCount.php',
                    dataType: 'json',
                    data: {
                        _code: getlatcode
                    },
                    success: function (data) {
                        for (z = 0; z < data.cou; z++) {
                            oTable.fnDeleteRow(0);

                        }

                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationPosition/GetPosition.php',
                    dataType: 'json',
                    data: {
                        _code: selOrg
                    },
                    success: function (data) {
                        $.each(data, function (key, val) {
                            //                            alert(val.name);
                            var aiNew = oTable.fnAddData([val.pos, val.desc, "<center> <a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center>"]);
                            var nRow = oTable.fnGetNodes(aiNew[0]);
                        });


                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });
                getlatcode = selOrg;


            });
            $('#submit-data').live('click', function (e) {
                e.preventDefault();
                var pos = document.getElementById('txtcode').value;
                var desc = document.getElementById('txtdesc').value;
                $("#close").click();
                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for Semester",
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
                                url: 'Organization/OrganizationPosition/AddPosition.php',
                                data: {
                                    _code: getlatcode,
                                    _pos: pos,
                                    _desc: desc
                                },
                                success: function (response) {
                                    swal("Record Added!", "The data is successfully Added!", "success");
                                    var aiNew = oTable.fnAddData([pos, desc, "<center> <a class='btn btn-success edit' href='javascript:;'><i class='fa fa-edit'></i></a> <a class='btn btn-danger delete' href='javascript:;'><i class='fa fa-trash-o'></i></a></center>"]);
                                    var nRow = oTable.fnGetNodes(aiNew[0]);

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

                var getval = $(this).closest('tr').children('td:first').text();;
                var nRow = $(this).parents('tr')[0];

                swal({

                        title: "Are you sure?",
                        text: "The record will be save and will be use for Semester",
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
                                url: 'Organization/OrganizationPosition/DeletePosition.php',
                                data: {
                                    _orgcode: getlatcode,
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
                var nRow = $(this).parents('tr')[0];

                /* Get the row as a parent of the link that was clicked on */
                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerText == "") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[1].value.length > 0 && jqInputs[1].value.length > 0) {
                        $.ajax({
                            type: 'post',
                            url: 'Organization/OrganizationPosition/UpdatePos.php',
                            data: {
                                _pos: jqInputs[0].value,
                                _desc: jqInputs[1].value,
                                _orgcode: getlatcode,
                                _code: codeforupdate

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

                    } else if (jqInputs[1].value.length < 1) {

                        swal("Error", "Please enter a valid Position", "error");

                    } else if (jqInputs[0].value.length < 1) {

                        swal("Error", "Please enter a valid Description", "error");

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
