function hideCustomPath(optionsValue){
	if(optionsValue.value == "1"){
		document.getElementById("custom_path").style.display = "";
	} else {
		document.getElementById("custom_path").style.display = "none";
	}
}
Joomla.submitbutton = function(pressbutton){
	var submitForm = document.adminForm;
	
	if(pressbutton=="help"){
		submitForm.task.value=pressbutton;
		submitForm.submit();
	}
	
	if(!alphanumeric(submitForm.key.value)){
		submitForm.key.value="";
		alert("Secret Key should not have special characters. Please enter Alpha-Numeric Key");
		submitForm.key.focus();
		return false;
	}
	if(pressbutton=="save"){
		submitForm.task.value='saveBasic';
		submitForm.submit();
		return true;
	}	
	
 
	submitForm.task.value=pressbutton;
	submitForm.submit();
}

function alphanumeric(keyValue){
	
	var numaric = keyValue;
	for(var j=0; j<numaric.length; j++){
		  var alphaa = numaric.charAt(j);
		  var hh = alphaa.charCodeAt(0);
		  if(!((hh > 47 && hh<58) || (hh > 64 && hh<91) || (hh > 96 && hh<123))){
		  	return false;
		  }
	}
	return true;
}
function isNumeric(val)
{
	val.value=val.value.replace(/[^0-9*]/g, '');
	if (val.value.indexOf('*') != '-1')
		val.value = '*';
}

var j = jQuery.noConflict();
 j(document).ready(function()
 { 
  j('#options1').css({'opacity':'0','outline':'0'});
  j('#options0').css({'opacity':'0','outline':'0'});

  if (j('#options0').attr('checked'))
  {
      j('#custom_path').hide();
   j("label[for='"+j('#options0').attr('id')+"']").attr('class', 'btn active btn-danger');
   j("label[for='"+j('#options1').attr('id')+"']").attr('class', 'btn active');
  }
  
  if (j('#options1').attr('checked'))
  {
      j('#custom_path').show();
   j("label[for='"+j('#options0').attr('id')+"']").attr('class', 'btn active');
   j("label[for='"+j('#options1').attr('id')+"']").attr('class', 'btn active btn-success');
  }  
  
  j('#options1').bind('click', function()
  {
   j('#custom_path').show();
   j("label[for='"+j('#options1').attr('id')+"']").attr('class', 'btn active btn-success');
   j("label[for='"+j('#options0').attr('id')+"']").attr('class', 'btn active');
   
     });
 
  j('#options0').bind('click', function()
  {
   j('#custom_path').hide();
   j("label[for='"+j('#options0').attr('id')+"']").attr('class', 'btn active btn-danger');
   j("label[for='"+j('#options1').attr('id')+"']").attr('class', 'btn active');
     });
 
   });