var getcode = '';
var getname = '';
var latcode = '';
var appcode = '';

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

            var oTable2 = $('#proftable').dataTable({

            });


            jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#btnsync').click(function (e) {
                e.preventDefault();
                getcode = document.getElementById('orgcode').innerText;

                swal({
                        title: "Are you sure?",
                        text: "You want to sync the data of students into the table",
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
                                type: "GET",
                                url: 'Organization/OrganizationMembers/Syncdata.php',
                                dataType: 'json',
                                data: {
                                    _code: getcode
                                },
                                success: function (data) {
                                    // alert(data.list);
                                    document.getElementById('updaccreqlist').innerHTML = data.list;
                                    swal("Record Synchronize!", "The data is successfully sync!", "success");

                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });



                        } else {

                            swal("Cancelled", "The transaction is cancelled", "error");
                            $("#editable-sample_new").click();
                        }

                    });

            });
            var result = 0;

            function myCallback(response) {
                result = response.getcountlist;
                //                console.log("Inside ajax: " + result);
                // Do whatever you need with result variable
            }
            $('#editable-sample ').on('click', 'a.edit', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getcode = $(this).closest('tr').children('td:first').text();
                latcode = getcode;
                var getname = $(this).closest('tr').children('td:first').next('td').text();
                var getcat = $(this).closest('tr').children('td:first').next('td').next('td').text();
                var stat = 0;
                $('#drpstudent').hide();
                $('#btnstudadd').show();
                var table = $('#proftable').DataTable();
                jQuery(table.fnGetNodes()).each(function () {
                    oTable2.fnDeleteRow(0);

                });

                appcode = $(this).closest('tr').children('td:first').text();
                //alert(appcode);
                if (getcat == 'Academic Organization') {
                    $('#btnsync').show();
                    //                    $('#hideaction').hide();
                    //
                    //stat = 1;
                } else {
                    $('#btnsync').hide();
                    //                    $('#hideaction').show();
                    //stat = 0;
                    //
                }
                //PANSAMANTALA itong nasa baba
                stat = 0;
                var getcountlist = 0;
                document.getElementById('orgname').innerText = getname;
                document.getElementById('orgcode').innerText = getcode;
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/GetData-ajax.php',
                    dataType: 'json',
                    data: {
                        _code: getcode,
                        _stat: stat
                    },
                    success: myCallback,
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });
                var stud = "''";

                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/FillPos.php',
                    dataType: 'json',
                    data: {
                        _code: getcode
                    },
                    success: function (data2) {
                        document.getElementById('drppos').innerHTML = data2.list;
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });

                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/FillTableStud.php',
                    dataType: 'json',
                    data: {
                        _code: getcode
                    },
                    success: function (data2) {

                        $.each(data2, function (key, val) {
                            var aiNew = oTable2.fnAddData([val.num, val.name, val.cas, val.pos, '<center><a class="btn btn-success edit" data-toggle="modal"  href="#EditPos" href="javascript:;"><i class="fa fa-edit"></i></a> <a class="btn btn-danger delete" href="javascript:;"><i class="fa fa-trash-o" ></i></a></center>', ]);
                            var nRow = oTable2.fnGetNodes(aiNew[0]);
                        });
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/FillSelStudent.php',
                    dataType: 'json',
                    data: {
                        _code: getcode
                    },
                    success: function (data) {
                        document.getElementById('drpstud').innerHTML = data.list;

                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


            });

            $('#editable-sample a.i.cancel').click(function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });
            //$('#showimport').hide();





        }

    };

}();

var initproftable = function () {

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


            var oTable = $('#proftable').dataTable({

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


            jQuery('#proftable_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
            jQuery('#proftable_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown

            var nEditing = null;

            $('#btnsync').click(function (e) {
                e.preventDefault();
                getcode = document.getElementById('orgcode').innerText;

                swal({
                        title: "Are you sure?",
                        text: "You want to sync the data of students into the table",
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
                                type: "GET",
                                url: 'Organization/OrganizationMembers/Syncdata.php',
                                dataType: 'json',
                                data: {
                                    _code: getcode
                                },
                                success: function (data) {
                                    // alert(data.list);
                                    document.getElementById('updaccreqlist').innerHTML = data.list;
                                    swal("Record Synchronize!", "The data is successfully sync!", "success");

                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });



                        } else {

                            swal("Cancelled", "The transaction is cancelled", "error");
                            $("#editable-sample_new").click();
                        }

                    });

            });
            $('#btnaddstud').click(function (e) {
                e.preventDefault();

                var _drpstud = document.getElementById('drpstud');
                var drpstud = _drpstud.options[_drpstud.selectedIndex].value;
                var drpname = _drpstud.options[_drpstud.selectedIndex].text;
                var _drppos = document.getElementById('drppos');
                var drppos = _drppos.options[_drppos.selectedIndex].value;
                var drptext = _drppos.options[_drppos.selectedIndex].text;

                $.ajax({
                    type: 'post',
                    url: 'Organization/OrganizationMembers/AddStud.php',
                    data: {
                        _studno: drpstud,
                        _pos: drppos,
                        _appcode: appcode
                    },
                    success: function (response) {

                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });
                //alert(drpstud + '-' + appcode);
                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/GetCourseYS.php',
                    dataType: 'json',
                    data: {
                        _studno: drpstud,
                        _appcode: appcode
                    },
                    success: function (data) {
                        var aiNew = oTable.fnAddData([data.snum, data.sname, data.cas, drptext, '<center><a class="btn btn-danger delete "  href="javascript:;"><i class="fa fa-trash-o" ></i></a></center>']);
                        var nRow = oTable.fnGetNodes(aiNew[0]);
                        var x = document.getElementById("drpstud");
                        x.remove(x.selectedIndex);
                        swal("Record Added!", "The data is successfully added!", "success");
                    },
                    error: function (data) {
                        //alert(data);
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });


            });

            $('#updaccreqlist').on('click', 'a.delete', function (e) {
                e.preventDefault();
                var nRow = $(this).parents('tr')[0];
                var getval = $(this).closest('tr').children('td:first').text();
                var getname = $(this).closest('tr').children('td:first').next().text();

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
                                url: 'Organization/OrganizationMembers/DelStud.php',
                                data: {
                                    _studno: getval,
                                    _appcode: appcode
                                },
                                success: function (response) {
                                    swal("Record Deleted!", "The data is successfully deleted!", "success");
                                    var x = document.getElementById("drpstud");
                                    var option = document.createElement("option");
                                    option.text = getname;
                                    option.value = getval;
                                    x.add(option);

                                    oTable.fnDeleteRow(nRow);
                                },
                                error: function (response) {
                                    swal("Error encountered while adding data", "Please try again", "error");
                                }

                            });



                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });


            });

            $('#updaccreqlist').on('click', 'a.edit', function (e) {
                $('#btnedit').click();
                var getnum = $(this).closest('tr').children('td:first').text();
                var getname = $(this).closest('tr').children('td:first').next().text();
                var getpos = $(this).closest('tr').children('td:first').next().next().next().text();
                var flag = 0;
                document.getElementById('updstudname').innerText = getname;
                document.getElementById('updstudnum').innerText = getnum;

                $.ajax({
                    type: "GET",
                    url: 'Organization/OrganizationMembers/FillPos.php',
                    dataType: 'json',
                    data: {
                        _code: latcode
                    },
                    success: function (data2) {
                        document.getElementById('upddrppos').innerHTML = data2.list;
                        $('#upddrppos option').each(function (index, val) {
                            if (val.text == getpos) {
                                flag = 1;
                                document.getElementById('upddrppos').value = val.value;
                            }
                        });
                        if (flag == 0) {
                            $('#upddrppos').append('<option selected value="old">' + getpos + '</option>');
                        }
                    },
                    error: function (response) {
                        swal("Error encountered while adding data", "Please try again", "error");
                    }

                });
                //$('#AddPos').modal('show');




            });

            $('#updsubmit-data').click(function () {
                var _upddrppos = document.getElementById("upddrppos");
                var upddrppostext = _upddrppos.options[_upddrppos.selectedIndex].text;
                var upddrpposval = _upddrppos.options[_upddrppos.selectedIndex].value;
                var studnum = document.getElementById("updstudnum").innerText;
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
                            if (upddrpposval == 'old') {
                                swal("Record Updated!", "The data is successfully updated!", "success");
                            } else {
                                $.ajax({
                                    type: 'post',
                                    url: 'Organization/OrganizationMembers/AddStud.php',
                                    data: {
                                        _studno: studnum,
                                        _pos: upddrpposval,
                                        _appcode: latcode
                                    },
                                    success: function (response) {
                                        swal("Record Updated!", "The data is successfully updated!", "success");
                                    },
                                    error: function (response) {
                                        swal("Error encountered while adding data", "Please try again", "error");
                                    }

                                });
                            }
                        } else
                            swal("Cancelled", "The transaction is cancelled", "error");

                    });

            });

            $('#proftable a.cancel').click(function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });




        }

    };

}();
