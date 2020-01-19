import "../map.js";

export default {
  init() {
    let stateLongName = { 'AL' : 'Alabama', 'AK' : 'Alaska', 'AZ' : 'Arizona', 'AR' : 'Arkansas', 'CA' : 'California', 'CO' : 'Colorado', 'CT' : 'Connecticut', 'DE' : 'Delaware', 'FL' : 'Florida', 'GA' : 'Georgia', 'HI' : 'Hawaii', 'ID' : 'Idaho', 'IL' : 'Illinois', 'IN' : 'Indiana', 'IA' : 'Iowa', 'KS' : 'Kansas', 'KY' : 'Kentucky', 'LA' : 'Louisiana', 'ME' : 'Maine', 'MD' : 'Maryland', 'MA' : 'Massachusetts', 'MI' : 'Michigan', 'MN' : 'Minnesota', 'MS' : 'Mississippi', 'MO' : 'Missouri', 'MT' : 'Montana', 'NE' : 'Nebraska', 'NV' : 'Nevada', 'NH' : 'New Hampshire', 'NJ' : 'New Jersey', 'NM' : 'New Mexico', 'NY' : 'New York', 'NC' : 'North Carolina', 'ND' : 'North Dakota', 'OH' : 'Ohio', 'OK' : 'Oklahoma', 'OR' : 'Oregon', 'PA' : 'Pennsylvania', 'RI' : 'Rhode Island', 'SC' : 'South Carolina', 'SD' : 'South Dakota', 'TN' : 'Tennessee', 'TX' : 'Texas', 'UT' : 'Utah', 'VT' : 'Vermont', 'VA' : 'Virginia', 'WA' : 'Washington', 'WV' : 'West Virginia', 'WI' : 'Wisconsin', 'WY' : 'Wyoming', 'DC' : 'Washington DC' };

    $('#map').usmap({
      // The click action
      click: function(event, data) {

        var state = data.name;
        $.ajax({
          url: window.location.href + 'wp-json/wpc/v1/story/?state=' + data.name + '&count=4',
          type: 'GET',
          success : function(data) {
            //console.log(state);
            if(data) {
              var str = '<div class="home-story">'
              $.each(data, function(i, story) {
                if(story.img) {
                  str +='<a class="transform hover:scale-101" href="' + story.link + '">';
                  str +='<img src="' + story.img + '"/>';
                  str +='</a>';
                  if(data.length > 2) {
                    $('.story-btn').addClass('md:-mt-10 lg:-mt-12');
                  }
                }
                else {
                  $('.story-btn').removeClass('md:-mt-10 lg:-mt-12');
                }
              })
              str += '</div>';
              $('#story-container').html(str);
              $('#story-subtitle').html('Stories from <a class="hover:text-l-orange" href="/stories/?state=' + state + '">' + stateLongName[state] + '</a>');
            }
            else {
              $('#story-subtitle').html('Share your story from <a href="#">' + stateLongName[state] + '</a>');
              $('.story-btn').removeClass('md:-mt-10 lg:-mt-12');
              $('#story-container').html("");
            }

          },
          error: function (req, e) {
            console.log(JSON.stringify(req));
          } 
        });

        //$('#story-subtitle').html('Stories from <a href="#">' + stateLongName[data.name] + '</a>');

          $("#map > svg > path").each(function(){
            $(this).css('fill', '');
          });
          $('#' + data.name).css('fill', '#f68e3c');
      }
    });

    //Highlight default state and set data
    $('#map > svg').attr("height", '200');
    $('#map').css('width', '100%').css('height', 'auto');
    $('#' + acf_data.default_state.value).css('fill', '#f68e3c');
    $('#story-subtitle').html('Stories from <a class="hover:text-l-orange" href="/stories/?state=' + acf_data.default_state.value +'">' + acf_data.default_state.label + '</a>');

    //Set state stories initially from default state field
    //console.log(window.location.href + 'wp-json/wpc/v1/story/?state=' + acf_data.default_state.value + '&count=4');
    $.ajax({
      url: window.location.href + 'wp-json/wpc/v1/story/?state=' + acf_data.default_state.value + '&count=4',
      type: 'GET',
      success : function(data) {
        //console.log(data);
        var str = '<div class="home-story">'
        $.each(data, function(i, story) {
          if(story.img) {
            str +='<a class="transform hover:scale-101" href="' + story.link + '">';
            str +='<img src="' + story.img + '"/>';
            str +='</a>';
            if(data.length > 2) {
              $('.story-btn').addClass('md:-mt-10 lg:-mt-12');
            }
          }
          else {
            $('.story-btn').removeClass('md:-mt-10 lg:-mt-12');
          }
        })
        str += '</div>';
        $('#story-container').html(str);

      },
      error: function (req, e) {
        console.log(JSON.stringify(req));
      } 
    });

  },

    
  
  finalize() {
    // JavaScript to be fired on the home page, after the init JS

  },
};
