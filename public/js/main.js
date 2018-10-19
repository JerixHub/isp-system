$(document).ready(function(){
	$('.apply-select2').select2();

	$('.apply-select2-multiple').select2({
		multiple: true
	});

	$('.check-all').change(function(){
		var checker = $(this).closest('table').find('.checker');
		if($(this).is(":checked")){
			checker.each(function(){
				$(this).prop('checked',true);
				$(this).addClass('ready');
				$('.action-delete').fadeIn(150);
			});
		}else{
			checker.each(function(){
				$(this).prop('checked',false);
				$(this).removeClass('ready');
				$('.action-delete').fadeOut(150);
			});
		}
		
	});

	$(document).on('change', '.checker', function(){
		if($(this).is(':checked')){
			$(this).addClass('ready');
		}else{
			$(this).removeClass('ready');
		}
		if($('.checker.ready').length != 0){
			$('.action-delete').fadeIn(150);
		}else{
			$('.action-delete').fadeOut(150);
		}
	});

	


});