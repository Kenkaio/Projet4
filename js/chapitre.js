$('.repondre').on('click', function(){
	id = this.id.substr(10);
	$('#editTextarea'+id).fadeIn(1000);
});


$('#ajoutCommentaire').fadeOut();

var nom = document.getElementById('auteurCom');
nom.value = "Nom";
nom.style.color = "grey";
nom.style.fontStyle = "italic";
nom.addEventListener("focus", function(){
    if (this.value=="Nom"){
        nom.value = "";
        nom.style.color = "black";
        nom.style.fontStyle = "normal";
    }
});
nom.addEventListener("blur", function(){
    if (this.value==''){
        nom.value = "Nom";
        nom.style.color = "grey";
        nom.style.fontStyle = "italic";
    }
});


var pseudo = document.getElementById('auteurRepCom');
pseudo.value = "Nom";
pseudo.style.color = "grey";
pseudo.style.fontStyle = "italic";
pseudo.addEventListener("focus", function(){
    if (this.value=="Nom"){
        pseudo.value = "";
        pseudo.style.color = "black";
        pseudo.style.fontStyle = "normal";
    }
});
pseudo.addEventListener("blur", function(){
    if (this.value==''){
        pseudo.value = "Nom";
        pseudo.style.color = "grey";
        pseudo.style.fontStyle = "italic";
    }
});

$('h2').on('click', function(){	
	$('#ajoutCommentaire').fadeIn(1000);
	element = document.getElementById('ajoutCommentaire');
	element.scrollTop = '1000px'; 
	
});