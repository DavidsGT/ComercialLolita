$("#vendedor").keyup(function() {
	var codvend = $(this).val();
	console.log(codvend);
	if(codvend.length == 5){
		$.get(`codigo/${codvend}`,function(res,sta){
			$("#nombreVendedor").empty();
			$("#nombreVendedor").append(': &nbsp;<font id="cd" color="green">'+res[0].nombre+'</font>');
			$("#idvendedor").val(res[0].id);
		});
	}else if(codvend.length == 0){
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
	}else if(codvend.length != 10){
		$("#nombreVendedor").empty();
		$("#idvendedor").val(0);
		$("#nombreVendedor").append(': &nbsp;<font id="cd" color="red">X</font>');
		$(this).focus();
	}
});