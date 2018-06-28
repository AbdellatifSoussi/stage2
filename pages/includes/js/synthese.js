$(function() {
		$( "#draggableBar" ).draggable();

		$('#pause').hide();

		$('#play').on('click', function(){
			$('#play').hide();
			$('#pause').show();
		});

		$('#pause').on('click', function(){
			$('#pause').hide();
			$('#play').show();
			pause();
		});

});

	/* Pour la tooltip quand l'utilisateur clique sur le texte dns la bulle*/
	$('#text').on('click', function(){
		var text = $(this).text();
		read(text);
	});

	/*					*
	*					*
	*  SYNTHESE VOCALE  *
	*					*
	*					*/

	/* Cette variable sert à savoir si nous somme en pause ou non.*/
	var isPaused = '0';

	/*	-- Edited and created by: @IR3B00T --
	*	Cette fonction permet de lire un texte.
	*	Elle peu être utilisée de 3 façons:
	*
	*	1: Elle peu lire le contenu d'une div qui à comme id 'texttospeech'
	*	2: Elle peu lire un texte sélectionner dans la page 
	*		( en dehors d'un textarea).
	*	3: On peu lui passé en paramêtre le texte qui doit être lu
	*/

	function read(text){

		var GetText = getSelectionText();
		var texttotel = '';

		if(isPaused == '0'){
			if(text == '' && GetText ==''){
				console.log('On lis le paragraphe');
				var texttotel = $('#texttospeech').text();
			}else if(text =='' && GetText != ''){
				console.log('on lis le texte select');
				var texttotel = GetText;	
			}else if(text!= '' && GetText == ''){
				var texttotel = text;
			}
		}else{
			if(GetText != ''){
				console.log('on lis le texte select apres une pause');
				var texttotel = GetText;
				isPaused = 0;
			}else{
				console.log('on reprend la lecture');
				speechSynthesis.resume();
				isPaused = 0;
			}
		}
			var msg = new SpeechSynthesisUtterance();
			var voices = window.speechSynthesis.getVoices();
			if (typeof webkitSpeechRecognition !== 'undefined') msg.voice = voices[10];
			msg.voiceURI = 'native';
			msg.volume = 1;
			msg.rate = 0.9;
			msg.pitch = 1;
			msg.text = texttotel;
			msg.onend = function(e) { 
				isPaused = 0;
				$('#pause').hide();
				$('#play').show();
			};
			speechSynthesis.speak(msg); 
	}

	/* 	-- Edited and created by: @IR3B00T --
	*
	*	Fonction Pause
	*	Elle permet de mettre la lecture d'un texte sur pause 
	*	est passe la variable 'isPaused' à 1.
	*
	*/
	function pause(){
		speechSynthesis.pause();
		isPaused = 1;
	}

	/*	-- Edited and created by: @IR3B00T --
	*
	*	Fonction qui permet de récupérer le texte sélectionner
	*	Dans un textarea et le lis dès que la souris est
	*	relâchée.
	 */
	function getTextareaSelection(field){        
        var startPos = field.selectionStart; 
        var endPos = field.selectionEnd;          
        var selectedText = field.value.substring(startPos,endPos); 
        read(selectedText); /* <-- ici on demande de lire le texte sélectionner */
    } 

    /* -- Edited and created by: @IR3B00T --
    *
    *	Fonction qui permet de récupérer le contenu sélectionner partout 
    *	sur une page sauf dans un textarea ou un input.
    *	elle retourne le texte sélectionner qui est ensuite lu après 
    *	un appuis sur le bouton PLAY.
    */
	function getSelectionText(){
		   var text = "";
		   speechSynthesis.cancel();
           if (window.getSelection) {
               text = window.getSelection().toString();
           } else if (document.selection && document.selection.type != "Control") {
               text = document.selection.createRange().text;
           }
           return text;
       }


