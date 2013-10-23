       <script type="text/javascript">
        $(document).ready(function(){
						  var currentPosition = 0;     //posicion actual
							var slideWidth = 180;      //ancho cada slide
							var slides = $('.slide');     //seleccion todos los .slide
							var numberOfSlides = slides.length;      //cuenta la cantidad de slides
							var dir; //direction clicked
							// Remove scrollbar in JS
  						$('#slidesContainer').css('overflow', 'hidden');
							// Wrap all .slides with #slideInner div    
							slides
								.wrapAll('<div id="slideInner"></div>')
								// Float left to display horizontally, readjust .slides width
							.css({
									'float' : 'left',
									'width' : slideWidth
								});
							 // Set #slideInner width equal to total width of all slides
  						$('#slideInner').css('width', slideWidth * numberOfSlides);

                 });
        </script>
        <div class="slide">
        <img title="1" src="img/audioprv1.jpg" />
        </div>
        <div class="slide">
        <img title="2" src="img/audioprv1.jpg" />
        </div>
        <div class="slide">
        <img title="3" src="img/audioprv1.jpg" />
        </div>
        <div class="slide">  
        <img title="4" src="img/audioprv1.jpg" /> 
        </div>
          <div class="slide">  
        <img title="5" src="img/audioprv1.jpg" /> 
        </div>
        <div class="slide">  
        <img title="6" src="img/audioprv1.jpg" /> 
        </div>
        <div class="slide">  
        <img title="7" src="img/audioprv1.jpg" /> 
        </div>
      

              
              
              
              
              
              
              
              
              
              