function _(x){
	return document.getElementById(x);
}

function processPhase1(){
	_("progressBar").value = 20;
	_("phase1").style.display = "none";
	_("phase2").style.display = "block";
}

function processPhase2(){
	_("progressBar").value = 40;
	_("phase2").style.display = "none";
	_("phase3").style.display = "block";
}

function back1(){
	_("phase1").style.display = "block";
	_("phase2").style.display = "none";
	_("progressBar").value = 0;
}

function processPhase3(){
	_("progressBar").value = 60;
	_("phase3").style.display = "none";
	_("phase4").style.display = "block";
}

function back2(){
	_("phase2").style.display = "block";
	_("phase3").style.display = "none";
	_("progressBar").value = 20;
}
////////////////////////////////////////////
function incomplete1() {
	if (document.getElementById("adviser").value===""){
    	document.getElementById('phase4but').disabled = true;
    } else if (document.getElementById("adviserPos").value===""){
    	document.getElementById('phase4but').disabled = true;
    } else if(document.getElementById("adviserUnit").value==="") { 
        document.getElementById('phase4but').disabled = true; 
    } else { 
        document.getElementById('phase4but').disabled = false;
    }
}

///////////////////////////////////////////
function processPhase4(){
	if (document.getElementById('phase4but').disabled == false){
		_("progressBar").value = 80;
		_("phase4").style.display = "none";
		_("phase5").style.display = "block";
	} else {
		_("progressBar").value = 60;
		_("phase3").style.display = "none";
		_("phase4").style.display = "block";
	}
}

function back3(){
	_("phase3").style.display = "block";
	_("phase4").style.display = "none";
	_("progressBar").value = 40;
}

function incomplete2() {
	if(document.getElementById("contactPerson").value==="") { 
        document.getElementById('phase5but').disabled = true; 
    } else if (document.getElementById("contactPos").value===""){
    	document.getElementById('phase5but').disabled = true; 
    } else if (document.getElementById("contactMail").value===""){
    	document.getElementById('phase5but').disabled = true;
    } else if (document.getElementById("contactAddress").value===""){
    	document.getElementById('phase5but').disabled = true;
    } else if (document.getElementById("contactPhone").value===""){
    	document.getElementById('phase5but').disabled = true;
    } else if (document.getElementById("contactMobile").value===""){
    	document.getElementById('phase5but').disabled = true;
    }
    else { 
        document.getElementById('phase5but').disabled = false;
    }
}
/////////////////////////////////////////////////////////////////////

function processPhase5(){
	if (document.getElementById('phase5but').disabled == false){
		_("progressBar").value = 100;
		_("phase5").style.display = "none";
		_("phase6").style.display = "block";
	} else {
		_("progressBar").value = 80;
		_("phase4").style.display = "none";
		_("phase5").style.display = "block";		
	}
}

function back4(){
	_("phase4").style.display = "block";
	_("phase5").style.display = "none";
	_("progressBar").value = 60;
}

function processPhase6(){
	_("progressBar").value = 100;
	_("phase6").style.display = "none";
	_("preview_file").style.display = "block";

}

function back5(){
	_("phase5").style.display = "block";
	_("phase6").style.display = "none";
	_("progressBar").value = 80;
}


function back6(){
	_("phase6").style.display = "block";
	_("preview_file").style.display = "none";
	_("progressBar").value = 83.35;
}

function submitForm(){
	_("multiphase").method = "post";

	//open new tab to view form
	swal({title: "Success!", text: "Form has been uploaded! You can preview your forms on the Checklist tab on your menu.", type: "success"},
        function(){ 
          _("multiphase").submit();
        }
    );
	
}

/**form C**/
function processcPhase1(){
	_("progressBar").value = 50;
	_("cphase1").style.display = "none";
	_("cphase2").style.display = "block";
}

function processcPhase2(){
	_("progressBar").value = 100;
	_("cphase2").style.display = "none";
	_("cphase3").style.display = "block";
}

function backc1(){
	_("cphase1").style.display = "block";
	_("cphase2").style.display = "none";
	_("progressBar").value = 0;
}

function backc2(){
	_("cphase2").style.display = "block";
	_("cphase3").style.display = "none";
	_("progressBar").value = 50;
}

function backc3(){
	_("cphase3").style.display = "block";
	_("show_dataPrev").style.display = "none";
	_("progressBar").value = 100;
}

function processcPhase3(){
	_("progressBar").value = 100;
	_("cphase3").style.display = "none";
	_("preview_fileC").style.display = "block";
}

function backc3(){
	_("preview_fileC").style.display = "block";
	_("cphase3").style.display = "none";
	_("progressBar").value = 100;
}