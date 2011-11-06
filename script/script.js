
home = {}; 

home.filter = function() {	
	 
 	if (self.document.location.hash){ 
			$("#options a").attr('class', ''); 
			home.filter_class = "."+self.document.location.hash;
			home.filter_class = home.filter_class.replace('#', "");
			$('#isotope_container').isotope({filter: home.filter_class});
			$('#options [href="'+self.document.location.hash+'"]').attr('class', 'selected');
	}
	else {
		$('#isotope_container').isotope({filter: '.isotope-item'});		
	}
	
	$('#isotope_container').isotope({ layoutMode : 'masonry' });
};
	
home.sort = function() {
	
	$('#isotope_container').isotope({
	  getSortData : {
	    conservative : function ( $elem ) {
	      return parseInt($elem.find('.conservative').html());
	    },
	    labour : function ( $elem ) {
	      return parseInt($elem.find('.labour').html());
	    }	
	  }
	});


	$('#isotope_container').isotope({ 
	  sortBy : 'conservative',
	  sortAscending : true
	});

	
	
}
	
	
$(document).ready(function() {
	home.filter(); 
	//When I'm not in a hurry I'll implement this with http://isotope.metafizzy.co/demos/hash-history.html#filter=.post-transition
	hashChangeEventListener = setInterval("home.filter()", 50);
});

