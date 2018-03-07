$(document).ready(function() {
  var table = $('#example').DataTable({
    dom: 'Bfrtip',
    buttons: [
    {
      extend: 'excel',
      text: 'Export excel',
      className: 'exportExcel',
      filename: 'Export excel',
      exportOptions: {
        modifier: {
          page: 'all'
        }
      }
    }, 
    {
      extend: 'copy',
      text: '<u>C</u>opie presse papier',
      className: 'exportExcel',
      key: {
        key: 'c',
        altKey: true
      }
    }, 
    {
      text: 'Alert Js',
      className: 'exportExcel',
      action: function(e, dt, node, config) {
        alert('Activated!');
        // console.log(table);

        // new $.fn.dataTable.Buttons(table, {
        //   buttons: [{
        //     text: 'gfdsgfsd',
        //     action: function(e, dt, node, config) {
        //       alert('ok!');
        //     }
        //   }]
        // });
      }
    }]
  });

});