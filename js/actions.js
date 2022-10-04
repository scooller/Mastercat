var scroll;
var md;
$(function() {
  md = new MobileDetect(window.navigator.userAgent);
	//     
  $owl = $(".owl-carr").owlCarousel({
    loop:true,
      margin:0,
      dots: false,
      items:1,
      autoplay:true,
      autoplayTimeout:5500,
      smartSpeed:450,
      navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
      responsive:{
          0:{
              nav:false
          },
          600:{
              nav:true
          }
      }
  });
  $( window ).scroll(function() {
    console.log('scroll');
    var docViewTop = $(window).scrollTop();
    var docViewBottom = docViewTop + $(window).height();
    if(docViewTop){
      $('header.menu-header').css('background-color','#fff');
    }else{
      $('header.menu-header').css('background-color','transparent');
    }    
    
  });
  //contact form7
  document.addEventListener( 'wpcf7mailsent', msj_gracias, false );
  document.addEventListener( 'wpcf7mailfailed', function( event ) {
  	alerta( "<div class='stroke'><h2>Error,</h2><p>Tenemos un problema al enviar el Email,<br>intenta mas tarde</p></div>" );
  }, false );
});

function msj_gracias(){
	alerta( "<div class='stroke'><h2>Gracias,<span><br>hemos recibido tu consulta.</span></h2><p>Pronto nos comunicaremos contigo</p></span>" );
}

function loadOk(){
    $('.owl-item.cloned').find('.fancybox').attr('data-fancybox', ' ');
    //new WOW().init();
    //RUT   
    $("input[name='rut']").rut({
        validateOn: 'blur',
        formatOn: 'keyup blur',
        minimumLength: 7,
        useThousandsSeparator : false
    });
    $("input[name='rut']").rut().on('rutInvalido', function(e) {
        var formato=$.formatRut($(this).val(), false);
        console.warn("El rut " + $(this).val() + " es inválido");
        alerta("<div class='stroke'>El rut " + $(this).val() + " es inválido</div>");
        $(this).val(formato);
    });
    $("input[name='rut']").rut().on('rutValido', function(e, rut, dv) {
        console.warn("El rut " + $(this).val() + " es valido");
        var formato=$.formatRut($(this).val(), false);
        $(this).val(formato);
    });

    if(md.mobile()){
        scroll = new SmoothScroll('a[href*="#"]',{
            topOnEmptyHash: true,
            easing: 'easeInOutCubic',
            speed: 200,
            speedAsDuration: true
        });
    }else{
        scroll = new SmoothScroll('a[href*="#"]',{
            header:'#menu',
            topOnEmptyHash: true,
            easing: 'easeInOutCubic',
            speed: 200,
            speedAsDuration: true
        });        
    }
    if($from_page){
      $( window ).resize(function() {
        cambiarTam();
      });
      cambiarTam();
    }
}
function cambiarTam(){
  var $tam = $(window).height()-$('.square.prefooter-nav').height();
  if(md.mobile()){
    $('#sliders').height('auto');
  }else{
    if($tam < 728){
      $('#sliders').height($tam);
    }else{
      $('#sliders').height('auto');
    }
  }
}
$( window ).on( "load",function() {
    $('#load').remove();
    var mySVGsToInject = document.querySelectorAll('img.svg');
    SVGInjector(mySVGsToInject);        
    loadOk();
});
function alerta($msj){
    console.log($msj);
    $.fancybox.open($msj);
}

function currencyFormat(num, fix) {
	return (
	    parseFloat(num)
	      .toFixed(fix) // always two decimal digits
	      .replace('.', ',') // replace decimal point character with ,
	      .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
	)
}
