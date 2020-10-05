$(document).ready(function() {

  $('.assignbook').click(function(e){
  			e.preventDefault();

        $.get('create',function(data){
        $('#assignbook').modal('show')
        .find('#assignbookContent')
		 		// .load($(this).attr('value'));
        .html(data);

      });

  	});

    $('.addauthor').click(function(e){
          e.preventDefault();

          $.get('addauthor',function(data){
          $('#addauthor').modal('show')
          .find('#addauthorContent')
          // .load($(this).attr('value'));
          .html(data);

        });

      });

});
