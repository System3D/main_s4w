$(document).ready(function() {
    var table = $('#lotPointer').DataTable();
 
    $('#formButton').click( function() {
        var data = table.$('input, select').serialize();
     /*   alert(
            "The following data would have been submitted to the server: \n\n"+
            data.substr( 0, 120 )+'...'
        ); */
         jQuery.ajax({
                type: "POST",
                data: {dados:data},
               url: "http://localhost/new_s4w/saas/estagio/teste",
                dataType: "html",
                success: function(e){
                    $('#herehtml').html(result);
                }
            });
        return false;
    } );

 //  $.fn.editable.defaults.mode = 'inline';

            $('.username').editable({
           url: 'http://localhost/new_s4w/saas/estagio/teste',
           type: 'html',
            mode: 'inline',
           pk: 1,
           title: 'Enter username',
           success: function(result){
           	alert(result);
           	var myArray = result.split('&');
           	for (var i = 0; i < myArray.length; ++i) {
           			
           	
           $('#inputEtapa').append($('<option>', {
			    value: 1,
			    text: myArray[i]
			}));
           };
        }
    });

      $('.dob').editable({
      	 url: 'http://localhost/new_s4w/saas/estagio/teste',
           type: 'html',
           name: 'data',
        format: 'YYYY-MM-DD',    
        viewformat: 'DD.MM.YYYY',    
        template: 'D / MMMM / YYYY',    
        combodate: {
                minYear: 2000,
                maxYear: 2016,
                minuteStep: 1
        },
        success: function(d){
                    $('#herehtml').html(result);
                }
    });

      $('#inputObra').change(function() {
      	
      	var dados = $('#inputObra').val();
      	jQuery.ajax({
                type: "POST",
                data: {id:dados},
               url: "http://localhost/new_s4w/saas/estagio/teste",
                dataType: "html",
                success: function(result){
             var myArray = result.split('&x&');
             var temp;
             $('#inputEtapa').find('option').remove().end();
           	for (var i = 0; i < myArray.length; ++i) {
           		temp = myArray[i].split('&');
           $('#inputEtapa').append($('<option>', {
			    value: temp[0],
			    text: temp[1]
			}));
           temp = null;
           };
                }
            });
        $('.inputetapa').removeClass('hidden');
      });
  
    
} );