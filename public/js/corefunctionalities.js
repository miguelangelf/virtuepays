
$(document).ready(function() {
	var options = { 
		beforeSubmit:  showRequest,
		success:       showResponse,
		dataType: 'json' 
	}; 
	$('body').delegate('#image','change', function(){
		$('#upload').ajaxForm(options).submit();  		
	}); 
});		

// Carga el menu de la izquierda
$(document).ready(function(){
	$(".button-collapse").sideNav();
});



//Carga el visualizador de imagenes
$(document).ready(function(){
	$('.materialboxed').materialbox();
});

//carga el parallex
$(document).ready(function(){
	$('.parallax').parallax();
});


$(document).ready(function(){

	$('#star-rating').rating(function(vote, event){
        //alert(vote);
        $("#therate").ajaxSubmit({url: 'setrate', type: 'post'});
       

    })
});




function showRequest(formData, jqForm, options) { 
	$("#validation-errors").hide().empty();
	$("#output").css('display','none');
	return true; 
} 



function showResponse(response, statusText, xhr, $form)  { 
	if(response.success == false)
	{
		var arr = response.errors;
		$.each(arr, function(index, value)
		{
			if (value.length != 0)
			{
				alert("Error");
				$("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
			}
		});
		$("#validation-errors").show();
	} else {
		//alert(response.file);
		$("#output").html("<img class='laimagen'  src='"+response.file+"' />");
		$("#imgtoupload").val(response.name);
		$("#output").css('display','block');
	}
}




