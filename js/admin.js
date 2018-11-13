$('.lienAdmin').mouseover(function(){
	$('.lienAdmin').css({
		"cursor":"pointer"
	});
});

$('#formArticle').hide();

$('#addArticle').on('click', function(){
	$('#sommaire').toggle();
	$('#formArticle').show(1000);
});

$('#mesArticles').hide();

$('#allArticles').on('click', function(){
	$('#sommaire').toggle();
	$('#mesArticles').show(1000);
});

