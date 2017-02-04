$('#form_validacion').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        email: {
            required: true,
            email: true
        },
        correo: {
            email: true
        },
        password: {
            required: true,
            minlength: 5
        },
        nombre: {
            required: true
        },
        apellido: {
            required: true
        },
        cedula: {
            required: true,
            minlength: 7
        },
        nacionalidad: {
            required: true
        },
        fecha_nacimiento: {
            required: true
        },
        sexo: {
            required: true
        },
        celular: {
            required: true
        },
        estado_civil: {
            required: true
        },
        nivel_instruccion: {
            required: true
        },
        parentesco:{
            required: true
        },
        actividad_economica: {
             required: true
        },
        ingreso_familiar:{
             required: true
        },
        numero_vivienda:{
             required: true
        }
    },
    messages: {
        email: {
            required: "Por favor introduzca su correo electronico",
            email:"Por favor introduzca un correo electronico valido"
        },
        correo: {
            email:"Por favor introduzca un correo electronico valido"
        },
        password: {
            required: 'Por favor ingrese su contraseña',
            minlength: 'Tu contraseña debe tener al menos 5 caracteres'
        },
        nombre: {
            required: 'Por favor ingrese el nombre del habitante'
        },
        apellido: {
            required: 'Por favor ingrese el apellido del habitante'
        },
        cedula: {
            required: 'Por favor ingrese la cedula del habitante',
            minlength: 'la cedula debe tener al menos 7 caracteres'
        },
        nacionalidad: {
            required: 'Por favor seleccione la nacionalidad del habitante'
        },
        fecha_nacimiento: {
            required: 'Por favor ingrese la fecha de nacimiento del habitante'
        },
        sexo: {
            required: 'Por favor seleccione el sexo del habitante'
        },
        celular: {
            required: 'Por favor ingrese el celular del habitante'
        },
        estado_civil: {
            required: 'Por favor seleccione el estado civil del habitante'
        },
        nivel_instruccion: {
            required: 'Por favor seleccione el nivel de instrucción del habitante'
        },
        parentesco: {
            required: 'Por favor seleccione el parentesco'
        },
        actividad_economica: {
             required:'Seleccion si realiza alguna actividad econimica dentro de la vivienda'
        },
        ingreso_familiar:{
             required:'Seleccion el ingreso familiar'
        },
        numero_vivienda:{
             required: 'ingrese el numero de la vivienda'
        }//fin
    }
});
$('#form_validacion_user').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        correo: {
            required: true,
            email: true
        },
        correo_alternativo: {
            required: true,
            email: true
        },
        tipo_usuario: {
            required: true
        },
        clave:{
            minlength: 6
        },
        clave_confirmacion:{
            equalTo: '#clave'
        },
        nombre: {
            required: true,
            minlength: 4
        },
        apellido: {
            required: true,
            minlength: 4
        },
        cedula: {
            required: true,
            minlength: 7
        },
        fecha_nacimiento: {
            required: true
        }
    },
    messages: {
        correo: {
            required: 'Por favor ingrese el correo electronico',
            email: 'Ingrese una direccion de correo electronico valida'
        },
        correo_alternativo: {
            required: 'Por favor ingrese el correo electronico alternativo',
            email: 'Ingrese una direccion de correo electronico valida'
        },
        tipo_usuario: {
            required: 'Por favor seleccione un tipo de usuario'
        },
        clave:{
            minlength: 'el nombre debe tener al menos 7 caracteres'
        },
        clave_confirmacion:{
            equalTo: 'La confirmacion de la contraseña debe ser igual a la de arriba'
        },
        nombre: {
            required: 'Por favor ingrese el nombre del usuario',
            minlength: 'el nombre debe tener al menos 4 caracteres'
        },
        apellido: {
            required: 'Por favor ingrese el apellido del usuario',
            minlength: 'el apellido debe tener al menos 4 caracteres'
        },
        cedula: {
            required: 'Por favor ingrese la cedula del usuario',
            minlength: 'la cedula debe tener al menos 7 caracteres'
        },
        fecha_nacimiento: {
            required: 'Por favor ingrese la fecha de nacimiento del usuario'
        }
    }
});
$('.form_Residencia').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        cedula: {
            required: true,
            minlength: 7
        }
    },
    messages: {
        cedula: {
            required: 'Por favor ingrese la cedula del habitante',
            minlength: 'la cedula debe tener al menos 7 caracteres'
        }
    }
});
$('.form_buenaConducta').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        cedula: {
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_testigo2","#cedula_testigo1"]
        },
        cedula_testigo1:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_buena_conducta","#cedula_testigo2"]
        },
        cedula_testigo2:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_buena_conducta","#cedula_testigo1"]
        }
    },
    messages: {
        cedula: {
            required: 'Por favor ingrese la cedula del habitante',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo1:{
            required: 'Por favor ingrese la cedula del primer testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo2:{
            required: 'Por favor ingrese la cedula del segungo testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        }
    }
});
$('.form_Solteria').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        cedula: {
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_testigo_2","#cedula_testigo_1"]
        },
        cedula_testigo_1:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_solteria","#cedula_testigo_2"]
        },
        cedula_testigo_2:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_solteria","#cedula_testigo_1"]
        }
    },
    messages: {
        cedula: {
            required: 'Por favor ingrese la cedula del habitante',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo_1:{
            required: 'Por favor ingrese la cedula del primer testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo_2:{
            required: 'Por favor ingrese la cedula del segungo testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        }
    }
});
$('.form_NoPoseerVivienda').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        cedula: {
            required: true,
            minlength: 7
        }
    },
    messages: {
        cedula: {
            required: 'Por favor ingrese la cedula del habitante',
            minlength: 'la cedula debe tener al menos 7 caracteres'
        }
    }
});
$('.form_UnionConcubinaria').validate({
    errorClass: 'help-block animation-slideDown', // You can change the animation class for a different entrance animation - check animations page
    errorElement: 'div',
    errorPlacement: function(error, e) {
        e.parents('.form-group').append(error);
    },
    highlight: function(e) {
        $(e).closest('.form-group').removeClass('has-success has-error').addClass('has-error');
        $(e).closest('.help-block').remove();
    },
    success: function(e) {
        // You can use the following if you would like to highlight with green color the input after successful validation!
        e.closest('.form-group').removeClass('has-success has-error'); // e.closest('.form-group').removeClass('has-success has-error').addClass('has-success');
        e.closest('.help-block').remove();
    },
    rules: {
        cedula1: {
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_testigo_2_c","#cedula_testigo_1_c","#cedula2"]
        },
        cedula2: {
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula_testigo_2_c","#cedula_testigo_1_c","#cedula1"]
        },
        cedula_testigo_1_c:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula1","#cedula2","#cedula_testigo_2_c"]
        },
        cedula_testigo_2_c:{
            required: true,
            minlength: 7,
            notEqualTo: ["#cedula1","#cedula2","#cedula_testigo_1_c"]
        }
    },
    messages: {
        cedula1: {
            required: 'Por favor ingrese la cedula del primer concubino',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula2: {
            required: 'Por favor ingrese la cedula del segundo concubino',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo_1_c:{
            required: 'Por favor ingrese la cedula del primer testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        },
        cedula_testigo_2_c:{
            required: 'Por favor ingrese la cedula del segungo testigo',
            minlength: 'la cedula debe tener al menos 7 caracteres',
            notEqualTo: 'ingrese otro numero de cedula, porque el ingresado ya esta en otro campo'
        }
    }
});
if ($('.datepicker').length!=0) {
    $('.datepicker').datepicker({
            format: "yyyy/mm/dd",
            todayBtn: true,
            clearBtn: true,
            language: "es",
    });
    $("input[name='tiempo_comunidad']").datepicker( {
            format: "yyyy-mm-dd",
            minViewMode: 1,
            beforeShowMonth: function (date){
            if (date.getMonth() == 8) {
            return false;
            }
        }
    });
};
numeros("input[name='cedula']");
numeros("input[name='celular']");
numeros("input[name='telefono_oficina']");
numeros("input[name='telefono_habitacion']");
function numeros (name) {
    $(name).keydown(function(event) {
       if(event.shiftKey)
       {
            event.preventDefault();
       }
     
       if (event.keyCode == 46 || 
            event.keyCode == 8 || 
            event.keyCode == 110 || 
            event.keyCode == 37 || 
            event.keyCode == 39 ||
            event.keyCode == 109)    {
       }
       else {
            if (event.keyCode < 95) {
              if (event.keyCode < 48 || event.keyCode > 57) {
                    event.preventDefault();
              }
            } 
            else {
                  if (event.keyCode < 96 || event.keyCode > 105) {
                      event.preventDefault();
                  }
            }
          }
       });
}
jQuery.validator.addMethod("notEqualTo",
function(value, element, param) {
    var notEqual = true;
    value = $.trim(value);
    for (i = 0; i < param.length; i++) {
        if (value == $.trim($(param[i]).val())) { notEqual = false; }
    }
    return this.optional(element) || notEqual;
},
"Please enter a diferent value."
);