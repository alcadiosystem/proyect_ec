$(document).ready(function(){    
   //$('#table_id').DataTable();
   //$('#tabled').DataTable();
   $('#btnAddProc').click(()=>{    
      $.ajax({
         url: $('#reg_new_prod').attr('action'),
         type: $('#reg_new_prod').attr('method'),
         data: {dato: 5},
         dataType: "json",
         success: function(d){

            $('#slCat').append(
               '<option value="0">- Seleccione una opción -</option>'
             );
     
            $.each(d.Men, function (i,item) {
               $("#slCat").append(
                  "<option value=" + item.ID + ">" + item.NOM + "</option>"
                );
            })
            $('#modal_p').modal('show');
         },        
         error: function(err){
            alert("ERROR ==> " + JSON.stringify(err, null, 2))
         }
      });
   });

   $('#btnAddCat').click(()=>{    
      $('#modal_c').modal('show');
     });
   $('#btnAddEmp').click(()=>{
      $('#modal_p').modal('show');
   })

     //Formularios
     $('#reg_new_cat').submit(function(e){
      e.preventDefault();
      console.log($('#reg_new_cat').attr('action'));
        $.ajax({
           url: $('#reg_new_cat').attr('action'),
           type: $('#reg_new_cat').attr('method'),
           data:  $('#reg_new_cat').serialize(),
           dataType: "json",
           success: function(d){              
              if(d.response){                 
                 alert(d.Men)
                 window.setTimeout("location.reload()", 2000);
              }else{
               alert(d.Men)
              }
           },
           error: function(){
              alert("ERROR")
           }
        });
     }); 

     $('#delete_cat').submit(function(e){
      e.preventDefault();
        $.ajax({
           url: $('#delete_cat').attr('action'),
           type: $('#delete_cat').attr('method'),
           data: $('#delete_cat').serialize(),
           dataType: "json",
           success: function(d){              
              if(d.response){                 
                 alert(d.Men)
                 window.setTimeout("location.reload()", 2000);
              }else{
               alert(d.Men)
              }
           },
           xhr: function(){
            var xhr = new window.XMLHttpRequest();
            xhr.addEventListener("error", function(evt){
                alert("an error occured");
            }, false);
            xhr.addEventListener("abort", function(){
                alert("cancelled");
            }, false);
    
            return xhr;
        },
           error: function(err){
              alert("ERROR ==> " + JSON.stringify(err, null, 2))
           }
        });
     });

     $('#reg_new_prod').submit((evt)=>{
        evt.preventDefault();
        $.ajax({
         url: $('#reg_new_prod').attr('action'),
         type: $('#reg_new_prod').attr('method'),
         data:  $('#reg_new_prod').serialize(),
         dataType: "json",
         success: function(d){              
            if(d.response){                 
               alert(d.Men)
               window.setTimeout("location.reload()", 2000);
            }else{
             alert(d.Men)
            }
         },
         error: function(err){
            alert("ERROR + " + err)
         }
      });
     })

     $('#delete_pro').submit((evt)=>{
      evt.preventDefault();

      $.ajax({
       url: $('#delete_pro').attr('action'),
       type: $('#delete_pro').attr('method'),
       data:  $('#delete_pro').serialize(),
       dataType: "json",
       success: function(d){              
          if(d.response){                 
             alert(d.Men)
             window.setTimeout("location.reload()", 2000);
          }else{
           alert(d.Men)
          }
       },
       error: function(err){
         alert("ERROR " + JSON.stringify(err, null, 2))
       }
    });
   })
});


function showModalCategoria(id) {

   $('#txtC').val("3");
   $('#txtIDC').val(id);

   $.ajax({
      url: $('#reg_new_cat').attr('action'),
      type: $('#reg_new_cat').attr('method'),
      data:  $('#reg_new_cat').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){            
            $('#txtC').val("2");
            $('#txtIDC').val(d.Men.ID);
            $('#txtCategoria').val(d.Men.NOM);
            $('#modal_c').modal('show');
         }else{
            alert(d.Men)
         }
      },
      error: function(){
         alert("ERROR")
      }
   });
   
}

function showModalDeleteCategoria(id){
   
   $('#txtC').val("4");
   $('#txtIDCC').val(id);
   $('#modal_del').modal('show');   
}

function btn_prod_up(id) {
   $('#dato').val("3");
   $('#_id_').val(id);

   $.ajax({
      url: $('#reg_new_prod').attr('action'),
      type: $('#reg_new_prod').attr('method'),
      data:  $('#reg_new_prod').serialize(),
      dataType: "json",
      success: function(d){         
         if(d.response){
            $('#slCat').empty();
            $('#dato').val("2");
            $('#_id_').val(id);
            
            $('#txtCod').val(d.Men.COD);
            $('#txtNom').val(d.Men.NOM);
            $('#txtDescripcion').val(d.Men.DES);
            $('#txtPV').val(d.Men.PV);
            $('#txtPC').val(d.Men.PC);
            $('#txtStock').val(d.Men.STO);
            $('#txtImagen').val(d.Men.IMG);
            
            $('#slCat').append(
               '<option value="0">- Seleccione una opción -</option>'
             );

             $.each(d.MenCT, function (i,item) {

               var select = "";
               if(item.ID == d.Men.CT){
                  select = "selected";
               }                  
               $("#slCat").append(
                  "<option "+select+" value=" + item.ID + ">" + item.NOM + "</option>"
                );
            })

            $('#modal_p').modal('show');
         }else{
            alert(d.Men)
         }
      },
      error: function(err){
         alert("ERROR " + JSON.stringify(err, null, 2))
      }
   });
}

function btn_prod_del(id) {
   $('#_id').val(id);
   $('#modal_del_p').modal('show');
}