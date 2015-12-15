$(document).ready(function() {

	$(document).ajaxStart(function() {
  		$('#tunggu').show();
  		$('#hasil').hide();
  	}).ajaxStop(function() {
  		$('#tunggu').hide();
  		$('#hasil').fadeIn('slow');
  	});

	$("#bnc").submit(function(e){
		e.preventDefault();
		dataString = $("#bnc").serialize();

		$.ajax({
		type: "POST",
		url:  $("#bnc").attr('action'),
		data: $("#bnc").serialize(),
		//dataType: "json",
		success: function(data) {
		  $('#hasil').html(data);

		}

		});
	});
});