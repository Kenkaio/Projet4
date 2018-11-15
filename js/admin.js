/* ----- Variables d'animation logo menu ----- */
i = 40;
y = 5;
z = 45;

/* ----- Déclaration varialbe si menu actif ou non ----- */
logoMenuActif=false;
var menuOn = false;
var ajoutArticleMenu = false;

/* ----- Création + animation logo menu en canvas ----- */
canvas = document.getElementById("menu"); 
context = canvas.getContext('2d');

function drawLine(){
	context.clearRect(0,0,50,50);
	context.beginPath();
	context.strokeStyle='black';
	context.lineWidth=4; 
	context.moveTo(5, 12);
	context.lineTo(45, 12);
	context.stroke(); 

	context.beginPath();
	context.strokeStyle='black';
	context.lineWidth=4; 
	context.moveTo(5, 24);
	context.lineTo(45, 24);
	context.stroke(); 

	context.beginPath();
	context.strokeStyle='black';
	context.lineWidth=4; 
	context.moveTo(5, 36);
	context.lineTo(45, 36);
	context.stroke(); 
} 

function drawLineAfter(){
	context.clearRect(0, 0, 50, 50);
	context.beginPath();
	
	
	context.clearRect(0, 0, 50, 50);
	context.beginPath();
	context.strokeStyle='black';
	context.lineWidth=4; 
	context.moveTo(5, 5);
	context.lineTo(45, y);
	context.stroke(); 
	
	context.strokeStyle='black';
	context.lineWidth=4; 
	context.moveTo(5, 45);
	context.lineTo(45, z);
	context.stroke(); 
	z--;
	y++;
}

drawLine();
$('#menu').on('click', function() {
  	if (!logoMenuActif) {
  		setInterval(function(){ 
			if (i > 0) { 
			  	drawLineAfter();
			  	i--;
			}
	  	}, 20);
	  	i = 40;
		y = 5;
		z = 45;
	  	logoMenuActif=true;
  	}
  	else{
  		drawLine();	
  		logoMenuActif=false;
  	}  		
});

$('#menu').on('click', function(){
	if (!menuOn) {
		$('#menu').css("transform","translate(-160px,0)");
		$('.menu').show(1000);
		menuOn=true;
	}
	else{
		$('#menu').css("transform","translate(0,0)");
		$('.menu').hide(1000);
		menuOn=false;
	}
})

/* ---- Différentes animation en fonction de la séction du menu choisit ---- */

$('#formArticle').hide();
$('#mesArticles').hide();
$('.menu').hide();

$('.lienAdmin').mouseover(function(){
	$('.lienAdmin').css({
		"cursor":"pointer"
	});
});

$('#addArticle').on('click', function(){
	$('#sommaire').toggle();
	$('#formArticle').show(1000);
	ajoutArticleActif=true;
});

$('#ajoutArticle').on('click', function(){
	$('#mesArticles').hide();
	$('#sommaire').hide();
	$('#formArticle').show(1000);
	ajoutArticleMenu=true;
	$('#menu').css("transform","translate(0,0)");
	$('.menu').hide(1000);		
	drawLine();	
	ajoutArticleActif=true;
	logoMenuActif=false;
	menuOn=false;
});

$('#administration').on('click', function(){	
	$('#formArticle').hide();
	$('#sommaire').hide();
	$('#mesArticles').show(1000);
	allArticle=true;
	$('#menu').css("transform","translate(0,0)");
	$('.menu').hide(1000);		
	drawLine();	
	ajoutArticleActif=false;
		logoMenuActif=false;
	menuOn=false;
});

$('#allArticles').on('click', function(){
	$('#sommaire').toggle();
	$('#mesArticles').show(1000);
	allArticle = true;
});