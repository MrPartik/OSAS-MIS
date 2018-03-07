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

            $('#editable-sample_new').click(function (e) {
                e.preventDefault();
            });

            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();

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
                                url: 'OrganizationCompliance/Delete-ajax.php',
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
                var id = $(this).closest('tr').children('td:first').text();
                document.getElementById('updappcode').innerText = id;
                $.ajax({
                    type: "GET",
                    url: 'OrganizationCompliance/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _id: id
                    },
                    success: function (data) {
                        document.getElementById('updtxtadvname').value = data.adv;
                        document.getElementById('upddrpyear').innerHTML = data.year;
                        document.getElementById('upddrpcat').innerHTML = data.selcat;
                        document.getElementById('upddrpcourse').innerHTML = data.selcou;
                        document.getElementById('updtxtvision').value = data.vis;
                        document.getElementById('updtxtmission').value = data.mis;
                        if (data.setstat == '1')
                            $('#updcourse').removeClass('hidden');
                        else
                            $('#updcourse').addClass('hidden');


                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


            });

            $('#updsubmit-data').live('click', function (e) {
                e.preventDefault();

                var accstat = '';
                var compcode = document.getElementById('updappcode').innerText;
                var advname = document.getElementById('updtxtadvname').value;
                var _drpyear = document.getElementById('upddrpyear');
                var drpyear = _drpyear.options[_drpyear.selectedIndex].text;
                var drpcate = document.getElementById('upddrpcat');
                var drpcatname = drpcate.options[drpcate.selectedIndex].text;
                var drpcatcode = drpcate.options[drpcate.selectedIndex].value;
                var drpcourse = document.getElementById('upddrpcourse').value;
                var txtvision = document.getElementById('updtxtmission').value;
                var txtmission = document.getElementById('updtxtvision').value;
                var chkstat = '';
                var chkcode = '';
                var stat = 0;
                alert(drpyear);

                swal({
                    title: "Are you sure?",
                    text: "This data will be saved and used for further transaction",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, Add it!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function (isConfirm) {
                    if (isConfirm) {
                        alert(compcode);
                        $.ajax({
                            type: 'post',
                            url: 'OrganizationCompliance/Update-ajax.php',
                            data: {
                                _accstat: accstat,
                                _compcode: compcode,
                                _advname: advname,
                                _drpyear: drpyear,
                                _drpcatcode: drpcatcode,
                                _drpcatname: drpcatname,
                                _drpcou: drpcourse,
                                _mission: txtmission,
                                _vision: txtvision


                            },
                            success: function (response) {
                                swal("Record Updated!", "The data is successfully Added!", "success");



                            },
                            error: function (response) {
                                swal("Error encountered while adding data", "Please try again", "error");
                            }
                        });





                    } else swal("Cancelled", "The transaction is cancelled", "error");
                });

            });

            $('#editable-sample a.edit').live('click', function (e) {
                e.preventDefault();
                //                alert('1zxxzcx');

                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                //alert('1zxxzcx');
                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */

                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Profile") {
                    /* Editing this row and want to save it */
                    var jqInputs = $('input', nRow);
                    if (jqInputs[1].value.length < 100 && jqInputs[1].value.length > 5 && jqInputs[2].value.length < 100 && jqInputs[2].value.length > 5) {
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
                                        url: 'DesignatedOffice/Add-ajax.php',
                                        data: {
                                            _name: jqInputs[1].value,
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
