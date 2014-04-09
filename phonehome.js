$( document ).ready(function() {

	if (!is_admin)
	{
		$(".block_phonehome").css("display", "none");
	}

	phonehome();
	
    window.setInterval(function(){phonehome();}, (timer * 1000));

});

function phonehome()
{
	$.post( $("#phonehome_form").attr("action"),
			 $("#phonehome_form :input").serializeArray()
		);
}