export default {
  init() {
    $(".post-load-btn").click(function () {
      var count = $('.news-post').length;
      //console.log(count);
      //console.log('/wp-json/wpc/v1/event/' + count);
      //console.log(window.location.origin + '/wp-json/wpc/v1/posts/?count=8&tag=lia&trim=25&offset=' + count)
      $.ajax({
        url: window.location.origin + '/wp-json/wpc/v1/posts/?count=8&tag=lia&trim=25&offset=' + count,
        type: 'GET',
        success : function(data) {
          //console.log(data);
          if(data !== null ) {
            $.each(data, function(i, post) {
            
            var str = '<a class="group news-post md:col-span-4 lg:col-span-2" href="' + post.link + '">'
            str += '<div class="flex flex-col">'
            str += '<div class="h-48 relative md:h-56 lg:h-64 xl:h-72">'
            str += '<img class="h-full w-full object-cover object-center absolute" src="' + post.img + '" alt="">'
            str += '</div>'
            str += '<div class="bg-white p-4 text-black md:h-66 lg:h-70 overflow-auto xl:p-8">'
            str += '<p class="text-sm uppercase text-l-gray-dark">' + post.date + '</p>'
            str += '<h3 class="text-2xl font-semibold leading-tight">' + post.name + '</h3>'
            str += '<p class="py-2">' + post.content + '</p>'
            str += '<p class="text-l-orange uppercase text-sm group-hover:text-l-blue">Read More ></p>'
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
            //console.log('hide');
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
