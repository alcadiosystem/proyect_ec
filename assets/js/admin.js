$(document).ready(function () {    
   $('#table_id').DataTable();
   $('#tabled').DataTable();
   $('#btnAddProc').click(()=>{    
    $('#modal_p').modal('show');
   });
   $('#btnAddCat').click(()=>{    
      $('#modal_c').modal('show');
     });
});