 $( function() {
    $( "#sortable1, #user1, #user2, #user3" ).sortable({
      connectWith: ".connectedSortable",
      update: function(event, ui) {
        
        // var postData = $(this).sortable('serialize');
        // console.log(postData);

        // Get each user state
        var user1 = $("#user1").sortable('serialize');
        var user2 = $("#user2").sortable('serialize');
        var user3 = $("#user3").sortable('serialize');

        // AJAX
        $.post('/save-changes', {user1: user1, user2: user2, user3: user3}, function(o) {
          if (o.status === 'ok') {
            
            console.log(o);

          } else {
            alert(o.message);
          }
        }, 'json')
        .fail(function() {
          alert('Sth wrong with AJAX');
        })

      },
      // change: function() {
      //   console.log('inny');
      // }
    }).disableSelection();
  } );