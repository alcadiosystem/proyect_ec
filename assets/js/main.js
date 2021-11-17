$(document).ready(()=>{
    $('#btn_').click(function(){
        $('#modal_c').modal('show');
    })
    
    $("#txtCad").keyup(()=>{
        var pv = $('#txtPV').val()
        var c = $("#txtCad").val()
        var st = $('#txtStock').val()

        console.log("ST ==> " + st + " C ==> " + c);

        if(c>st){
            alert("La cantidad no puede ser mayor que el stock")
            return;
        }
        $("#txtTotal").val(pv*c)
    })

    $('#frm_add_cart').submit((e)=>{
        e.preventDefault();
        
        console.log($('#frm_add_cart').serialize());
        $.ajax({
            url: $('#frm_add_cart').attr('action'),
            type: $('#frm_add_cart').attr('method'),
            data:  $('#frm_add_cart').serialize(),
            dataType: "json",
            success: function(d){              
                console.log(d);
                if(!d.response){                    
                    alert(d.Men)
                    window.setTimeout("location.reload()", 2000);
                }else{
                alert(d.Men)
                }
            },
            error: function(err){
                console.log(JSON.stringify(err, null, 2));
                alert("ERROR " + JSON.stringify(err, null, 2))
            }
        });
    })

    $('#frm_fin_v').submit((e)=>{
        e.preventDefault();
        
        console.log($('#frm_fin_v').serialize());
        $.ajax({
            url: $('#frm_fin_v').attr('action'),
            type: $('#frm_fin_v').attr('method'),
            data:  $('#frm_fin_v').serialize(),
            dataType: "json",
            success: function(d){              
                console.log(d);
                if(!d.response){                    
                    alert(d.Men)
                    //window.setTimeout("location.reload()", 2000);
                }else{
                alert(d.Men)
                }
            },
            error: function(err){
                console.log(JSON.stringify(err, null, 2));
                alert("ERROR " + JSON.stringify(err, null, 2))
            }
        });
    })
})

function modal_add_cart_idex(id) {
    $('#_id').val(id)
    $('#dato').val(2)
    $.ajax({
        url: $('#frm_add_cart').attr('action'),
        type: $('#frm_add_cart').attr('method'),
        data:  $('#frm_add_cart').serialize(),
        dataType: "json",
        success: function(d){         
           if(d.response){
               $('#dato').val(1)
               $('#_id').val(d.Men.ID)
               console.log(d);
               $('#txtCod').val(d.Men.COD)
               $('#txtNom').val(d.Men.NOM)
               $('#txtStock').val(d.Men.ST)
               $('#txtPV').val(d.Men.PV)
              $('#modal_c').modal('show');
           }else{
              alert(d.Men)
           }
        },
        error: function(err){
            console.log(JSON.stringify(err, null, 2));
           alert("ERROR " + JSON.stringify(err, null, 2))
        }
     });    
}

function modal_delete_cart(id) {
    
}

function modal_fin_vent(id) {
    $('#_id_').val(id);
    $('#_dato').val(4);
           
    console.log($('#frm_fin_v').serialize());
    $.ajax({
        url: $('#frm_fin_v').attr('action'),
        type: $('#frm_fin_v').attr('method'),
        data:  $('#frm_fin_v').serialize(),
        dataType: "json",
        success: function(d){              
            console.log(d);
            if(!d.response){                    
                console.log(d.Men);
                $('#_dato').val(5);
                $('#isClient').empty();
                $('#isClient').append(
                    '<option value="0">- Seleccione una opción -</option>'
                  );
          
                 $.each(d.Men, function (i,item) {
                    $("#isClient").append(
                       "<option value=" + item.ID_C + ">" + item.NOM+' - '+item.NOM + "</option>"
                     );
                 })
            }else{
            alert(d.Men)
            }
        },
        error: function(err){
            console.log(JSON.stringify(err, null, 2));
            alert("ERROR " + JSON.stringify(err, null, 2))
        }
    });
    $('#modal_v').modal('show');
}