export default {
  init() {
    $("#story-highlight").on("click", "#sub-stories a", function (e) {
      e.preventDefault();
      console.log($(this).attr("data-id"));
      var id = $(this).attr("data-id");
      $.ajax({
          type:"POST",
          url: ajax_url.ajax_url,
          data: {
              action:'get_story', 
              post_id:id
          },
          success:function(data){
            //console.log(data);
            $('#story-highlight').html(' ');
            $('#story-highlight').append(data)
          },
          error: function (req, e) {
            console.log(JSON.stringify(req));
          } 
      });
    });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
