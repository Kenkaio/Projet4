i = 40;
y = 5;
z = 45;
on=false;
active=false;
var menuOn = false;
var ajoutArticleMenu = false;
canvas = document.getElementById("menu"); 
context = canvas.getContext('2d');

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
});

$('#ajoutArticle').on('click', function(){
	if (!active) {
		if (!ajoutArticleMenu) {
			$('#sommaire').toggle();
			$('#formArticle').show(1000);
			ajoutArticleMenu=true;
			$('#menu').css("transform","translate(0,0)");
			$('.menu').hide(1000);		
			drawLine();	
			active=true;
	  		on=false;
			menuOn=false;
		}
		else{
			$('#formArticle').hide();
			ajoutArticleMenu=false;
		}	
	}
});

$('#allArticles').on('click', function(){
	$('#sommaire').toggle();
	$('#mesArticles').show(1000);
});

$('#menu').mouseover(function(){
	$('hr').css({
		"width": "0"
	});
});

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
  	if (!on) {
  		setInterval(function(){ 
			if (i > 0) { 
			  	drawLineAfter();
			  	i--;
			}
	  	}, 20);
	  	i = 40;
		y = 5;
		z = 45;
	  	on=true;
  	}
  	else{
  		drawLine();	
  		on=false;
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
