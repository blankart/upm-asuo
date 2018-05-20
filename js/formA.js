	function nameFormatCheck(input) {  
    var regex_num = new RegExp('^[0-9]*$');
    var regex = new RegExp("^[a-zA-Z]+( [a-zA-Z]+)*$");
    var value =  input.value;
    
    if( regex_num.test(value) )
       input.setCustomValidity("Numbers are not allowed!");   
    else if( !regex.test(value) )
      input.setCustomValidity("Special characters are not allowed!");   
    else 
      input.setCustomValidity("");      
  }

  function noSpecialCharactersAndExtraSpacesCheck(input){

        var regex = new RegExp("^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$");
        var value =  input.value;
        
        if( !regex.test(value) )
          input.setCustomValidity("Special characters and extra spaces are not allowed!");   
        else 
          input.setCustomValidity("");    
    }

	function inStay(){
      var inStay = "<?php echo $stay; ?>"

      if(inStay == "new")
         document.getElementById("new").checked = true;
      else if(inStay == "old"){
         document.getElementById("old").checked = true; 
      }
   }
   function activateText(value){
      var textbox = document.getElementById("years");

      if(value == "old"){
         textbox.disabled = false;
      } else {
         textbox.disabled = true;
      }
   }

   window.onload = inStay;