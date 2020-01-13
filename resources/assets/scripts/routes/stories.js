export default {
  init() {
    // JavaScript to be fired on all pages
    function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    var cat = getParameterByName('state');
    if(cat !== null) {
      $('.state-filter').val(cat);

      var url = '/wp-json/wpc/v1/story/?state=' + cat + '&count=-1';

      $.ajax({
        url: url,
        type: 'GET',
        success : function(data) {
          //console.log(data);
          if(data) {
            //console.log(data);
            $('.story-box-container').html(' ');
            
            $.each(data, function(i, story) {
              var str = "";
              str += '<a class="story-box col-span-1 relative overflow-hidden" href="' + story.link + '">'
              str += '<img class="story-box-image absolute w-full h-full object-cover object-center z-0" src="' + story.img + '" alt=""></img>'
              str += '<div class="story-gradient"></div>'
              str += '<div class="absolute bottom-0 m-4 text-white z-20">'
              str += '<div class="flex items-center">'
              str += '<span><svg class="h-4 w-4 text-l-orange fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>'
              str += '<p class="text-l-peach font-semibold">' + story.state.label + '</p>'
              str += '</div>'
              str += '<p class="font-semibold">'+ story.name +'</p>'
              str += '</div>'
              str += '</a>'

              $('.story-box-container').append(str);
            })
          }
          else {
            console.log('errror');
          }

        },
        error: function (req, e) {
          console.log(JSON.stringify(req));
        } 
      });
    }
    //console.log(cat)
      
    //Get select value on change
    $('.state-filter').on('change', function() {
      // console.log('here');
      var state = this.value;
      //console.log(state);
      if(state === 'ALL') {
        var url = '/wp-json/wpc/v1/story/?all=true'
      }
      else {
        var url = '/wp-json/wpc/v1/story/?state=' + state + '&count=-1';
      }
      //console.log(url)
      $.ajax({
        url: url,
        type: 'GET',
        success : function(data) {
          //console.log(data);
          if(data) {
            //console.log(data);
            $('.story-box-container').html(' ');
            
            $.each(data, function(i, story) {
              var str = "";
              str += '<a class="story-box col-span-1 relative overflow-hidden" href="' + story.link + '">'
              str += '<img class="story-box-image absolute w-full h-full object-cover object-center z-0" src="' + story.img + '" alt=""></img>'
              str += '<div class="story-gradient"></div>'
              str += '<div class="absolute bottom-0 m-4 text-white z-20">'
              str += '<div class="flex items-center">'
              str += '<span><svg class="h-4 w-4 text-l-orange fill-current mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 20S3 10.87 3 7a7 7 0 1 1 14 0c0 3.87-7 13-7 13zm0-11a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/></svg></span>'
              str += '<p class="text-l-peach font-semibold">' + story.state.label + '</p>'
              str += '</div>'
              str += '<p class="font-semibold">'+ story.name +'</p>'
              str += '</div>'
              str += '</a>'

              $('.story-box-container').append(str);
            })
          }
          else {
            console.log('errror');
          }

        },
        error: function (req, e) {
          console.log(JSON.stringify(req));
        } 
      });
    });

    $("#searchsubmit").click(function(e){
      e.preventDefault();
      var search_val=$("#s").val();
      console.log(search_val) 
      $.ajax({
          type:"POST",
          url: ajax_url.ajax_url,
          data: {
              action:'search_stories', 
              search_string:search_val
          },
          success:function(data){
            $('.story-box-container').html(' ');
            $('.story-box-container').append(data)
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
