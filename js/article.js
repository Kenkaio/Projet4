$('.edit').click(function(){
	var id=this.value;
	$('#editTextarea'+id).css({
		"display": 'block'
	});
	$('#auteur'+id).css({
		"display": 'none'
	});
	$('#contenuCom'+id).css({
		"display": 'none'
	});
});

$('.editRep').click(function(){
	var id=this.value;

	$('#editRepTextarea'+id).css({
		"display": 'block'
	});
	$('#auteurRep'+id).css({
		"display": 'none'
	});
	$('#contenuRep'+id).css({
		"display": 'none'
	});
});