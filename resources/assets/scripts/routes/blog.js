export default {
  init() {
    // JavaScript to be fired on all pages
    var count = $('.news-post').length; 
    if(count < 8 ) {
      $(".post-load-btn").hide();
    }

    function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, '\\$&');
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }


    $(".post-load-btn").click(function () {
      var count = $('.news-post').length;
      var url = window.location.origin + '/wp-json/wpc/v1/posts/?trim=15&count=8&offset=' + count;
      var cat = getParameterByName('cat');
      if(cat !== null) {
        url += '&cat=' + cat;
      }

      console.log(url);
      $.ajax({
        url: url,
        type: 'GET',
        success : function(data) {
          //console.log(data);
          if(data !== null ) {
            $.each(data, function(i, post) {

            var str = '<a class="group news-post" href="' + post.link + '">'
            str += '<div class="flex">'
            str += '<div class="relative hidden md:block md:w-1/3 lg:w-1/2">'
            str +=  '<img class="h-full w-full object-cover object-center absolute" src="' + post.img + '" alt="">'
            str += '</div>'
            str += '<div class="bg-white w-full p-4 text-black md:w-2/3 md:h-48 md:overflow-auto lg:w-1/2 lg:h-56 xl:h-64 xl:p-8">'
            str += '<p class="text-xs uppercase text-l-gray-dark xl:pb-2">' + post.date + '</p>'
            str += '<h3 class="font-semibold pb-2 leading-tight text-lg xl:text-xl">' + post.name + '</h3>'
            str += '<p class="hidden md:block md:text-sm md:pb-2 xl:text-base">' + post.content + '</p>'
            str += '<p class="text-l-orange uppercase text-xs xl:text-sm">Read More ></p>'
            str += '</div>'
            str += '</div>'
            str += '</a>' 

              $('.new-container').append(str);
            //console.log(data);
            })
            if(Object.keys(data).length < 8) {
              $(".post-load-btn").hide();
            }
          }
          else {
            $(".post-load-btn").hide();
          }
          //console.log(Object.keys(data).length);
          
        },
        error: function (req, e) {
          console.log(JSON.stringify(req));
        } 
      });
    })
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
