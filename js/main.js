$(document).ready(function(){

/*-----------------------------------------------------------------------------------------------------------------
 -------------------------------------------------HEADER---------------------------------------------------------- */

    $( "#header-evento .activa_level1").change(function(e){
        var $field = $(this);
        $field.css('background-color','#F3F3F3');

        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit_header.php",
            dataType: "json",
            data: 'value='+ $field.attr('value') + '&field=' + $field.attr('name') + '&id_eve=' + $field.attr('mm'),
            success: function(data) {
                if(data.status == true){
                    console.log(data);
                    // deselect all checkbox
                    $('#header-evento .activa_level1').prop('checked', false);
                    // select current checkbox
                    $field.prop('checked', true);
                    refreshPrueba($field.attr('mm'));
                }
            }
        });

    });



/*-----------------------------------------------------------------------------------------------------------------
 -------------------------------------------------INICIO----------------------------------------------------------- */

    initPrueba();

});


/*-----------------------------------------------------------------------------------------------------------------
 -------------------------------------------------PRUEBA----------------------------------------------------------- */
initPrueba = function(){
    console.log('initPrueba');
    $('#header-evento .activa_level1').each(function(){
        if($(this).prop('checked')) {
            var id_eve = $(this).attr('mm');
            refreshPrueba(id_eve);
        }
     });
}


refreshPrueba = function(id_evento){
    $.ajax({
        type: "POST",
        url: "https://softecuestre.com.ar/src/sistema/pheader.php",
        dataType: "html",
        data: 'id_evento='+id_evento,
        success: function(data) {
            $('#div_pheader').html(data);
            scriptPrueba();
        }
    });

}

scriptPrueba = function(){

    //solo checkbox
    $('#header-prueba .activa').click(function(){
        $field = $(this);
        var value = $(this)[0].checked;
        var id_prueba = $(this).parent().parent().attr('data-id');
        var dataString = 'value=' + value + '&field=' + $(this).attr('name') + '&id=' + id_prueba;
        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit_pheader.php",
            dataType: "json",
            data: dataString,
            success: function(data) {
                // deselect all checkbox
                $('#header-prueba .activa').prop('checked', false);
                // select current checkbox
                $field.prop('checked', true);
                refreshForm(id_prueba);
                //refreshForm(1);
            }
        });
    });


    $('#header-prueba input:text').focus(function() {
        $(this).css('background-color','#ffffff');
    });

    $('#header-prueba input:text').blur(function() {
        $(this).css('background-color','#F3F3F3');
    });


$(document).ready(function () {
    
    /*-----------------------------------------------------------------------------------------------------------------
 -------------------------------------------------PRUEBA INICIADA--------------------------------------------- */





    $('select[id^="iniciada"]').change(function(){
        var id_prueba = this.id.replace('iniciada', ''); // Obtener el ID de la prueba
        var valor_seleccionado = $(this).val(); // Obtener el valor seleccionado
        
        
         $.ajax({
            url: 'https://softecuestre.com.ar/src/sistema/edit_pheader.php',
            type: 'POST',
            dataType: 'json',
            data: {
                value: valor_seleccionado,
                field:'iniciada',
                id:id_prueba, 
            },
            success: function(response) {
                // Manejar la respuesta del servidor si es necesario
                console.log(response);
                console.log('Se ha cambiado el valor de iniciada para la prueba con ID ' + id_prueba + ' a ' + valor_seleccionado);
            },
            error: function(xhr, status, error) {
                // Manejar errores si es necesario
                console.error(xhr.responseText);
            }
        });
    });

    


/*-----------------------------------------------------------------------------------------------------------------
 -------------------------------------------------CALCULO LOS TIEMPOS--------------------------------------------- */


    $('.long-RI').on('change', function () {
        var fila = $(this).closest('.cfila'); // Referencia a la fila actual
        var id_prueba = fila.attr('data-id'); // ID de la fila, si lo necesitas
        var longRI = parseFloat($(this).val());
        var velRI = parseFloat(fila.find('.velo-ta').val());
        var velTO = parseFloat(fila.find('.velo-to').val());
        
        if (!isNaN(longRI) && longRI > 0 &&
        !isNaN(velRI) && velRI > 0) {
            
            // Realiza el cálculo que desees aquí. 
            var tiempoAcordado = Math. ceil((longRI * 60)/velRI);
            var tiempoOptimo = Math. ceil((longRI * 60)/velTO);
            var tiempoLimite = Math. ceil(tiempoAcordado*2);
            
            // Actualiza el campo Tiempo_Acordado con el nuevo valor calculado.
            fila.find('.Tiempo-Acordado').val(tiempoAcordado);
            fila.find('.Tiempo-Optimo').val(tiempoOptimo);
            fila.find('.Tiempo-Limite').val(tiempoLimite);
            
            // Llama a la función que actualiza la base de datos
            //debería llamar a la función function()
            //actualizarBaseDeDatos() es obsoleta
            //actualizarBaseDeDatos($(this), tiempoAcordado, 'Tiempo_Acordado');
            //actualizarBaseDeDatos($(this), tiempoOptimo, 'Tiempo_Optimo');
            //actualizarBaseDeDatos($(this), tiempoLimite, 'Tiempo_Limite');
        
            
        } else {
            console.warn("Datos inválidos para el cálculo: longRI, velRI o velTO");
            console.log("Prueba:", id_prueba, "Fila:", fila, "longRI:", longRI, "velRI:", velRI, "velTO:", velTO);
           

            // Limpia los campos de salida si ya tenían datos
            fila.find('.Tiempo-Acordado').val('');
            fila.find('.Tiempo-Optimo').val('');
            fila.find('.Tiempo-Limite').val('');
        }
    });
});    


    $('#header-prueba input:text').change(function(){
        var field = $(this);
        var parent = field.parent().attr('id');
        var id_prueba = $(this).parent().parent().attr('data-id');
        var dataString = 'value=' + $(this).val() + '&field=' + $(this).attr('name') + '&id=' + id_prueba;
        console.log($(this).attr('name'));
        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit_pheader.php",
            dataType: "json",
            data: dataString,
            success: function(data) {


            }
        });
    });
    
    
/*    function actualizarBaseDeDatos(fila, valor, campo) {
    var id_prueba = fila.attr('data-id');
    var dataString = 'value=' + valor + '&field=' + campo + '&id=' + id_prueba;

    $.ajax({
        type: "POST",
        url: "https://softecuestre.com.ar/src/sistema/edit_pheader.php",
        dataType: "json",
        data: dataString,
        success: function(data) {
            console.log('Actualización exitosa en campo', campo);
        },
        error: function(xhr, status, error) {
            console.error('Error al actualizar campo', campo, error);
        }
    });
}

    
    
//    function actualizarBaseDeDatos(element) {
        // Extrae la información necesaria del elemento
//        var longRI = parseFloat(element.val());
//        var id_prueba = element.closest('.cfila').attr('data-id');

        // Realiza una llamada AJAX para actualizar la base de datos con el nuevo valor de Tiempo-Acordado
//        var dataString = 'value=' + longRI + '&field=Tiempo_Acordado&id=' + id_prueba;
//        $.ajax({
//            type: "POST",
//            url: "https://softecuestre.com.ar/src/sistema/edit_pheader.php",
//            dataType: "json",
//            data: dataString,
//            success: function(data) {
                // Aquí puedes manejar la respuesta de la base de datos, si es necesario.
//            }
//        });
//    }
*/

}
  
  
  
  
  
    


/*-----------------------------------------------------------------------------------------------------------------
-------------------------------------------------FORM-------------------------------------------------------------- */
initForm = function(){
    console.log('refreshForm');

}

refreshForm = function(id_prueba){
    console.log('refreshForm');
    $.ajax({
        type: "POST",
        url: "https://softecuestre.com.ar/src/sistema/form.php",
        dataType: "html",
        data: 'id_prueba='+id_prueba,
        success: function(data) {
            $('#div_form').html(data);
            scriptForm();
        }
    });
}

scriptForm = function(){
    $('#content_name_form input').focus(function() {
        $(this).css('background-color','#ffffff');
    });

    $('#content_name_form input').blur(function(){
        $(this).css('background-color','#F3F3F3');
    });

    $('#content_name_form input').change(function(){
        var field = $(this);
        var parent = field.parent().parent().attr('data-id');
        var campeonato = field.parent().parent().attr('data-id-campeonato');
        var dataString = 'value='+$(this).val()+'&field='+$(this).attr('name') +'&id_concurso='+ parent+'&id_campeonato='+ campeonato
        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit.php",
            dataType: "json",
            data: dataString,
            success: function(data) {


            }
        });
    });

/* $('#content_name_form .estado').toggle( function() {
        $(this).addClass();
    },function(){
        $(this).addClass("green-cell");
    });*/

    $('#content_name_form .estado').click(function(){
        console.log($(this));
        var inicio = 0;
        var fin = 0 ;
        var field = $(this);
        var parent = field.parent().attr('data-id');

        if($(this).hasClass('neutro-cell')){
            $(this).removeClass("neutro-cell");
            $(this).addClass("green-cell");
            inicio = 1;
            fin = 0;

        }
        else if($(this).hasClass('green-cell')){
            $(this).addClass("red-cell");
            $(this).removeClass("green-cell");
            inicio = 0;
            fin = 1;
        }
        else if($(this).hasClass('red-cell')){
            $(this).addClass("neutro-cell");
            $(this).removeClass("red-cell");
            inicio = 0;
            fin = 0;
        }


        var dataString = 'value='+inicio+'&field=Inicia'+ '&id_concurso='+ parent;
        var dataString1 = 'value='+fin+'&field=finaliza'+ '&id_concurso='+ parent;
        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit.php",
            dataType: "json",
            data: dataString,
            success: function(data) {


            }
        });
        $.ajax({
            type: "POST",
            url: "https://softecuestre.com.ar/src/sistema/edit.php",
            dataType: "json",
            data: dataString1,
            success: function(data) {


            }
        });
    });
}