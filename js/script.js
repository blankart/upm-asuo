var dateFiled, orgName, stay, years, category, adviserName, pos, college, 
	contactPreson, contactPos, address, tel, mob, email, other, obj, desc;
function _(x){
	return document.getElementById(x);
}

function processPhase1(){
	_("progressBar").value = 16.67;
	_("phase1").style.display = "none";
	_("phase2").style.display = "block";
	_("status").innerHTML = "Phase 2 of 6";
}

function processPhase2(){
	_("progressBar").value = 33.34;
	_("phase2").style.display = "none";
	_("phase3").style.display = "block";
	_("status").innerHTML = "Phase 3 of 6";
}

function back1(){
	_("phase1").style.display = "block";
	_("phase2").style.display = "none";
	_("progressBar").value = 0;
	_("status").innerHTML = "Phase 1 of 6";
}

function processPhase3(){
	_("progressBar").value = 50.01;
	_("phase3").style.display = "none";
	_("phase4").style.display = "block";
	_("status").innerHTML = "Phase 4 of 6";
}

function back2(){
	_("phase2").style.display = "block";
	_("phase3").style.display = "none";
	_("progressBar").value = 16.67;
	_("status").innerHTML = "Phase 2 of 6";
}

function processPhase4(){
	_("progressBar").value = 66.68;
	_("phase4").style.display = "none";
	_("phase5").style.display = "block";
	_("status").innerHTML = "Phase 5 of 6";
}

function back3(){
	_("phase3").style.display = "block";
	_("phase4").style.display = "none";
	_("progressBar").value = 33.34;
	_("status").innerHTML = "Phase 3 of 6";
}

function processPhase5(){
	_("progressBar").value = 83.35;
	_("phase5").style.display = "none";
	_("phase6").style.display = "block";
	_("status").innerHTML = "Phase 6 of 6";
}

function back4(){
	_("phase4").style.display = "block";
	_("phase5").style.display = "none";
	_("progressBar").value = 50.01;
	_("status").innerHTML = "Phase 4 of 6";
}

function processPhase6(){
	_("progressBar").value = 100;
	_("phase6").style.display = "none";
	_("show_all_data").style.display = "block";
	_("status").innerHTML = "Data Overview";

}

function back5(){
	_("phase5").style.display = "block";
	_("phase6").style.display = "none";
	_("progressBar").value = 66.68;
	_("status").innerHTML = "Phase 5 of 6";
}

function back6(){
	_("phase6").style.display = "block";
	_("show_all_data").style.display = "none";
	_("progressBar").value = 83.35;
	_("status").innerHTML = "Phase 6 of 6";
}

function submitForm(){
	_("multiphase").method = "post";
	//_("multiphase").action = "my_parser.php";
	_("multiphase").submit();
	
}

/**form C**/
function processcPhase1(){
	_("progressBar").value = 33;
	_("cphase1").style.display = "none";
	_("cphase2").style.display = "block";
	_("status").innerHTML = "Phase 2 of 3";
}

function processcPhase2(){
	_("progressBar").value = 66;
	_("cphase2").style.display = "none";
	_("cphase3").style.display = "block";
	_("status").innerHTML = "Phase 3 of 3";
}

function backc1(){
	_("cphase1").style.display = "block";
	_("cphase2").style.display = "none";
	_("progressBar").value = 0;
	_("status").innerHTML = "Phase 1 of 3";
}

function processcPhase3(){
	_("progressBar").value = 100;
	_("cphase3").style.display = "none";
	_("show_all_data").style.display = "block";
	_("status").innerHTML = "Phase 3 of 3";
}

function backc2(){
	_("cphase2").style.display = "block";
	_("cphase3").style.display = "none";
	_("progressBar").value = 33;
	_("status").innerHTML = "Phase 2 of 3";
}

function backc3(){
	_("cphase3").style.display = "block";
	_("show_all_data").style.display = "none";
	_("progressBar").value = 66;
	_("status").innerHTML = "Phase 3 of 3";
}
