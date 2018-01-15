(function($) {
  var Search = {
    init: function() {
      $('#search').on('keydown', this.getResultsOnEnter);
      $('#search').on('keyup', this.getResultsOnKeypress);
      $('#random').on('click', this.showRandomResult);
      
      // When logo is clicked, focus on input
      $('.Search__logo').on('click', this.logoClickEvent);
      // Add focus state on search icon
      $('#search').on('click', this.toggleSearchIconColor);
    },
    
    results: {},
    
    getResultsOnEnter: function(key) {
        if ( key.keyCode === 13 ) {
          Search.getResults();
        } 
    },
    
    getResultsOnKeypress: function(key) {
      if ( key.keyCode === 13 || $('#search').val().length < 3 ) return;
      
      // Delay api query for 4ms after each keypress because I'm nice
      clearTimeout($.data(this, 'delay'));
      $(this).data('delay', setTimeout(Search.getResults, 400));
    },
    
    getResults: function() {
      var userInput = $('#search').val();
      
      $.getJSON('https://en.wikipedia.org/w/api.php?action=query&generator=search&gsrnamespace=0&gsrlimit=10&prop=extracts&exintro&explaintext&exsentences=1&exlimit=max&format=json&callback=?&gsrsearch=' + userInput, function(data) {
        var s = Search;
        
        if ( data.query ) { // We have results
          s.results = data.query.pages;
          console.log(s.results);
          s.showResults();
        } else {
          // No results
          s.results = '<p class="no-article">Sorry, no articles found.</p>';
          $('#output').html(s.results);
        }
      });
    },
    
    showResults: function() {
      var s = Search;
      
      // Clear previous results
      $('#output').html('');
      
      // Return results
      for ( var obj in s.results ) {
        if ( s.results.hasOwnProperty(obj) ) {
          $('#output').append(
            '<a href="https://en.wikipedia.org/?curid=' 
             + s.results[obj].pageid + '" target="_blank" class="Search__output-result">' +
              '<h4>' + s.results[obj].title + '</h4>' +
              '<p>' + s.results[obj].extract + '</p>' +
              '<i class="fa fa-external-link"></i>' +
            '</a>'
          );
        } 
      }
    },
    
    showRandomResult: function() {
      // Clear previous results
      $('#output').html('');
      // Clear search bar
      $('#search').val('');
      
      $.getJSON('https://en.wikipedia.org/w/api.php?action=query&generator=random&grnnamespace=0&prop=extracts&explaintext&exsentences=3&format=json&callback=?', function(data) {
        var result = data.query.pages; 
      
        $.map(result, function(obj) {
          $('#output').append(
            '<a href="https://en.wikipedia.org/?curid=' 
             + obj.pageid + '" target="__blank" class="Search__output-result">' +
              '<h4>' + obj.title + '</h4>' +
              '<p>' + obj.extract + '</p>' +
              '<i class="fa fa-external-link"></i>' +
            '</a>' 
          );
        });
      });
    },
    
    logoClickEvent: function(e) {
      e.stopPropagation();
      $('#search').focus();
      $('#search-icon').addClass('toggle');
    },
    
    toggleSearchIconColor: function(e) {
      e.stopPropagation();
        $('#search-icon').addClass('toggle');
      // Remove focus state on search icon
      $('body').on('click', function(){$('#search-icon').removeClass('toggle')});
    }
  }
  
  Search.init();
  
})(jQuery);