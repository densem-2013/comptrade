var flex=jQuery.noConflict();
flex(window).load(function(){
	flex('.flexslider').flexslider({
		slideshowSpeed: php_vars.slideshowSpeed,
		animationSpeed: php_vars.animationSpeed,
		animation: 'fade',
        start: function(slider){
          	flex('body').removeClass('loading');
        }
	});
});