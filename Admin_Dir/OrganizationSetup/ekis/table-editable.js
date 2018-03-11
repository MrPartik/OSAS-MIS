var getcode = '';
var getname = '';
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
				if (getcode != '')
				{
					
					jqTds[0].innerHTML = '<input type="text" class="form-control small " value="' + aData[0] + '" disabled>';
					jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
					jqTds[2].innerHTML = '<input type="text" class="form-control small" value="' + aData[2] + '">';
					jqTds[3].innerHTML = '<a class="btn btn-success  edit" href="">Save</a> <a class="btn btn-danger cancel" href="">Cancel</a>';
					
				}
				else
				{
					
					jqTds[0].innerHTML = '<input type="text" class="form-control small " value="OFFXXXXX" disabled>';
					jqTds[1].innerHTML = '<input type="text" class="form-control small" value="' + aData[1] + '">';
					jqTds[2].innerHTML = '<input type="text" class="form-control small" value="' + aData[2] + '">';
					jqTds[3].innerHTML = '<a class="btn btn-success  edit" href="">Save</a> <a class="btn btn-danger cancel" href="">Cancel</a>';
					
				}
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
				if(jqInputs[0].value != 'OFFXXXXX')
				{
					
					oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
					oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
					oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
					oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 3, false);
					oTable.fnDraw();
				}
				else
				{
					oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
					oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
					oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
					oTable.fnUpdate('<center><a class="btn btn-success edit" href="">Edit</a> <a class="btn btn-danger delete" href="">Delete</a></center>', nRow, 3, false);
					oTable.fnDraw();
					
				}
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
                var aiNew = oTable.fnAddData(['', '', '', '',
                        '<a class="btn btn-success edit" href="">Edit</a>', '<a class="btn btn-danger cancel" data-mode="new" href="">Cancel</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
            });

            $('#editable-sample a.delete').live('click', function (e) {
                e.preventDefault();

                if (confirm("Are you sure to delete this row ?") == false) {
                    return;
                }

                var nRow = $(this).parents('tr')[0];
                oTable.fnDeleteRow(nRow);
                alert("Deleted! Do not forget to do some ajax to sync with backend :)");
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

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "Save") {
                    /* Editing this row and want to save it */
					
					var jqInputs = $('input', nRow);
					if(jqInputs[1].value.length < 100 && jqInputs[1].value.length > 5 && jqInputs[2].value.length < 100 && jqInputs[2].value.length > 5 )
					{
						
						if(jqInputs[0].value != 'OFFXXXXX')
						{
							
							$.ajax
							({
								type: 'post',
								url: 'DesignatedOffice/Update-ajax.php',
								data: 
							{
								_name:jqInputs[1].value,
								_desc:jqInputs[2].value,
								_code:jqInputs[0].value

								
							},
								success: function (response) 
								{
									swal("Record Updated!", "The data is successfully updated!", "success");
									saveRow(oTable, nEditing);
									nEditing = null;
								},
								error: function (response) 
								{
									swal("Error encountered while adding data", "Please try again", "error");
									saveRow(oTable, nEditing);
									nEditing = null;					  
								}
								
							});							
							
						}
						else
						{
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
							function(isConfirm)
							{
								if (isConfirm)
								{
									$.ajax
									({
										type: 'post',
										url: 'DesignatedOffice/Add-ajax.php',
										data: 
									{
										_name:jqInputs[1].value,
										_desc:jqInputs[2].value

										
									},
										success: function (response) 
										{
											swal("Record Added!", "The data is successfully added!", "success");
											saveRow(oTable, nEditing);
											nEditing = null;
										},
										error: function (response) 
										{
											swal("Error encountered while adding data", "Please try again", "error");
											saveRow(oTable, nEditing);
											nEditing = null;					  
										}
										
									});	
									
								}
								else 
									swal("Cancelled", "The transaction is cancelled", "error");
							
							});
							
							
							
							
						}
						
					}
					else if (jqInputs[1].value.length > 100)
					{
						
						swal("Error", "The Office name must be less than 100 characters", "error");						
						
					}
					else if (jqInputs[1].value.length < 5)
					{
						
						swal("Error", "Please enter a valid Office name", "error");						
						
					}					
					else if (jqInputs[2].value.length > 100)
					{
						
						swal("Error", "The Office description must be less than 100 characters", "error");						
						
					}
					else if (jqInputs[2].value.length < 5)
					{
						
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