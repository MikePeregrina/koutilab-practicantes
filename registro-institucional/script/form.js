$(document).ready(function(){  
  var form_count = 1, previous_form, next_form, total_forms;
  total_forms = $("fieldset").length;  
  $(".next-form").click(function(){
    previous_form = $(this).parent();
    next_form = $(this).parent().next();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(++form_count);
  });  
  $(".previous-form").click(function(){
    previous_form = $(this).parent();
    next_form = $(this).parent().prev();
    next_form.show();
    previous_form.hide();
    setProgressBarValue(--form_count);
  });
  setProgressBarValue(form_count);  
  function setProgressBarValue(value){
    var percent = parseFloat(100 / total_forms) * value;
    percent = percent.toFixed();
    $(".progress-bar")
      .css("width",percent+"%")
      .html(percent+"%");   
  } 
  // Handle form submit and validation
  $( "#register_form" ).submit(function(event) {    
	var error_message = '';
	if(!$("#nombre_r").val()) {
		error_message+="Por favor complete nombre del responsable";
	}
	if(!$("#cargo").val()) {
		error_message+="<br>Por favor complete cargo";
	}
  if(!$("#contacto").val()) {
		error_message+="<br>Por favor complete WhatsApp de contacto";
	}
  if(!$("#email").val()) {
		error_message+="<br>Por favor complete correo electrónico";
	}
  if(!$("#nombre_e").val()) {
		error_message+="<br>Por favor complete nombre de la escuela";
	}
  if(!$("#clave").val()) {
		error_message+="<br>Por favor complete clave centro del trabajo";
	}
  if(!$("#pais").val()) {
		error_message+="<br>Por favor complete país";
	}
  if(!$("#estado").val()) {
		error_message+="<br>Por favor complete estado";
	}
  if(!$("#grado").val()) {
		error_message+="<br>Por favor complete grado escolar";
	}
  if(!$("#numero_a").val()) {
		error_message+="<br>Por favor complete número de alumnos para iniciar";
	}

	// Display error if any else submit form
	if(error_message) {
		$('.alert-success').removeClass('hide').html(error_message);
		return false;
	} else {
		return true;	
	}    
  });  
});