var abc = 0; //Declaring and defining global increement variable
var myDefPhoto = 'themes/lte/assets/dist/img/no-photo.jpg';


$(document).ready(function() {

//To add new input file field dynamically, on click of "Add More Files" button below function will be executed
    $('#add_more').click(function() {
        $(this).before($("<div/>", {id: 'filediv'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}),        
                $("<br/><br/>")
                ));
    });

//following function will executes on change event of file input to select different file	
$('body').on('change', '#file', function(){
            if (this.files && this.files[0]) {
                 abc += 1; //increementing global variable by 1
				
				var z = abc - 1;
                var x = $(this).parent().find('#previewimg' + z).remove();
					$('#no-photo').remove();	//Borro mi miniatura por Def
                $(this).before("<div id='abcd"+ abc +"' class='abcd'><img id='previewimg" + abc + "' src='' /></div>");
               
			    var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
               
				//$(this).parent().append($("<input/>", {name: 'file[]', type: 'file', id: 'file'}));	//Se esconde y no re aparece, error
				$(this).append($("<input/>", {name: 'file[]', type: 'file', id: 'file'}));	//Se esconde y no re aparece, error
				//$('.def-photo').append($("<img/>", {id: 'img', src: 'themes/lte/assets/dist/img/no-photo.jpg', alt: 'no-photo', width: '100%', height: '186'  })); //Devolvemos mi foto por default hasta que seleccionen otra
                $("#abcd"+ abc).append($("<img/>", {id: 'img', src: 'themes/lte/assets/plugins/uploader/x.png', alt: 'delete', width: 20, height: 20  }).click(function() {
					$(this).hide();
					//$(this).remove();
					$(this).parent().remove();
					$(this).parent().parent().remove();
					//$(this).append('a');
                }));
            }
        });

//To preview image     
    function imageIsLoaded(e) {
        $('#previewimg' + abc).attr('src', e.target.result);
    };

    $('#upload').click(function(e) {
        var name = $(":file").val();
        if (!name)
        {
            alert("First Image Must Be Selected");
            e.preventDefault();
        }
    });
});