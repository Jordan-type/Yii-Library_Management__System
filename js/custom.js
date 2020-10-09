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

    $('.requestbook').click(function(e){
          e.preventDefault();

          var id = $(this).attr("val");
          $.get('requestbook?id='+id,function(data){
          $('#requestbook').modal('show')
          .find('#requestbookContent')
          .html(data);
        });

      });

    $('.returnbook').click(function(e){
			e.preventDefault();
			var id = $(this).attr("val");
	       $.get('returnbook?id='+id,function(data){
				$('#returnbook').modal('show')
			 		.find('#returnbookContent')
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
      $('.borrowbook').click(function(e){
            e.preventDefault();

            $.get('borrowbook',function(data){
            $('#borrowbook').modal('show')
            .find('#borrowbookContent')
            // .load($(this).attr('value'));
            .html(data);

          });

        });

});
