export default {
  init() {
    // JavaScript to be fired on all pages
    
    //var count = $('.event').length;
    //console.log(ajax_url['ajax_url']);

    $(".archive-event").click(function () {
      var count = $('.event').length;
      //console.log(count);
      //console.log('/wp-json/wpc/v1/event/' + count);
      $.ajax({
        url: '/wp-json/wpc/v1/event/' + count,
        type: 'GET',
        success : function(data) {
          //console.log(data);
          if(data !== null ) {
            $.each(data, function(i, event) {

              var str = '<article>'
              str += '<a href="' + event.link + '" class="group event">'
              str += '<div class="group-hover:opacity-75 md:flex md:p-4 lg:shadow lg:shadow-md lg:p-0 lg:m-4 lg:mb-4 xl:mb-8 xl:mx-0">'
              str += '<div class="relative md:w-1/2">'
              str += '<img class="w-full h-full xl:object-cover xl:object-center xl:h-66" src="' + event.img + '" alt="">'
              str += '<div class="absolute top-0 left-0">'
              str += '<div class="flex flex-col bg-l-orange py-2 px-3 lg:px-4 lg:py-3">'
              str += '<span class="text-white text-center uppercase font-semibold tracking-wider lg:text-xl">' + event.day + '</span>'
              str += '<span class="text-white text-center text-2xl font-bold leading-none lg:text-3xl">' + event.month + '</span>'
              str += '</div>'
              str += '</div>'
              str += '</div>'
              str += '<div class="p-4 bg-l-gray text-sm text-black md:w-1/2 lg:text-base lg:tracking-wide lg:p-8 xl:text-lg xl:pr-16">'
              str += '<h3 class="font-semibold text-lg text-l-blue group-hover:text-l-orange lg:pb-4 lg:text-2xl">' + event.name + '</h3>'
              if(event.start) {
                str += '<p class=""><span class="text-l-blue font-semibold text-base">DATE:</span> ' + event.date + ', ' + event.start + ' - ' + event.end + '</p>'
              }
              else {
                str += '<p class=""><span class="text-l-blue font-semibold text-base">DATE:</span> ' + event.date + '</p>'
              }
              if(event.location) { 
                str += '<p class="mb-2"><span class="text-l-blue font-semibold text-base">LOCATION:</span> ' + event.location + ', ' + event.address + '</p>'
              }
              else {
                str += '<p class="mb-2"><span class="text-l-blue font-semibold text-base">LOCATION:</span> ' + event.address + '</p>'
              }
              str += '<p class="uppercase font-semibold text-base text-l-orange lg:text-lg">Learn More ></p>'
              str += '</div>'    
              str += '</div>'
              str += '</a>'
              str += '</article>'

              $('.event-container').append(str);

              if(Object.keys(data).length < 6) {
                $(".event-btn-container").hide();
              }
            //console.log(data);
            })
          }
          else {
            $(".event-btn-container").hide();
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
