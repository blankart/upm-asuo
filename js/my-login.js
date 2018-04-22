$(function() {
	$("input[type='password'][data-eye]").each(function(i) {
		let $this = $(this);

		$this.wrap($("<div/>", {
			style: 'position:relative'
		}));
		$this.css({
			paddingRight: 60
		});
		$this.after($("<div/>", {
			html: 'Show',
			class: 'btn btn-danger btn-sm',
			id: 'passeye-toggle-'+i,
			style: 'position:absolute;right:10px;top:50%;transform:translate(0,-50%);padding: 2px 7px;font-size:12px;cursor:pointer;'
		}));
		$this.after($("<input/>", {
			type: 'hidden',
			id: 'passeye-' + i
		}));
		$this.on("keyup paste", function() {
			$("#passeye-"+i).val($(this).val());
		});
		$("#passeye-toggle-"+i).on("click", function() {
			if($this.hasClass("show")) {
				$this.attr('type', 'password');
				$this.removeClass("show");
				$(this).removeClass("btn-outline-danger");
			}else{
				$this.attr('type', 'text');
				$this.val($("#passeye-"+i).val());				
				$this.addClass("show");
				$(this).addClass("btn-outline-danger");
			}
		});
	});
});

$(function() {

    $('#stud-form-link').click(function(e) {
		$("#stud-form").delay(100).fadeIn(100);
 		$("#org-form").fadeOut(100);
		$('#org-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#org-form-link').click(function(e) {
		$("#org-form").delay(100).fadeIn(100);
 		$("#stud-form").fadeOut(100);
		$('#stud-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#stud-reg-link').click(function(e) {
		$("#stud-reg").delay(100).fadeIn(100);
 		$("#org-reg").fadeOut(100);
		$('#org-reg-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#org-reg-link').click(function(e) {
		$("#org-reg").delay(100).fadeIn(100);
 		$("#stud-reg").fadeOut(100);
		$('#stud-reg-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	

});

var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	//activate next step on progressbar using the index of next_fs
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	
	//show the next fieldset
	next_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({
        'transform': 'scale('+scale+')',
        'position': 'absolute'
      });
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});

$(".submit").click(function(){
	return false;
});

$(function () {
                $('.mat-input-outer label').click(function () {
                    $(this).prev('input').focus();
                });
                $('.mat-input-outer input').focusin(function () {
                    $(this).next('label').addClass('active');
                });
                $('.mat-input-outer input').focusout(function () {
                    if (!$(this).val()) {
                        $(this).next('label').removeClass('active');
                    } else {
                        $(this).next('label').addClass('active');
                    }
                });
            });

$( document ).on( 'click', '.faq h2 a', function( e )
{
    e.preventDefault();
    $( this ).parents( 'li' ).toggleClass( 'is-active' );
});

