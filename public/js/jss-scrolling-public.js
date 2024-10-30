(function( $ ) {
  'use strict';

window.scrolljss=scrolljss;  
var objarray = [];
var scrollobjarray = [];
var yopacity;


function scrolljss(y, pagewidth, pageheight, scrollobjarray){
console.log('scroll effect function called');

jQuery.each( scrollobjarray, function( i, val ) {
var scrollevent = val;

if (pagewidth < 736) {
var responciveloc = scrollevent.pagelocations;

}
if (pagewidth > 756 && pagewidth < 1024) {
var responciveloc = scrollevent.pagelocationm;
}
if (pagewidth > 1024) {
var responciveloc = scrollevent.pagelocation;
}



if(responciveloc == "none"){
  
}else{


      
    
      if(scrollevent.lockwith == "none"){
          var elementname = "." + scrollevent.objectname;
        var originalname = "." + scrollevent.objectname;
          var elementstats = document.getElementById(scrollevent.objectname);
      }else{
        var originalname = "." + scrollevent.objectname;
        var elementname = "." + scrollevent.lockwith;
          var elementstats = document.getElementById(scrollevent.lockwith);
      }

    var currentdistance = $(window).scrollTop();
    var startevent = pageheight * responciveloc;
    var eventlength = pageheight * scrollevent.eventlength;
    var endevent = startevent + eventlength;



    Number.prototype.between  = function (a, b, inclusive) {
        var min = Math.min.apply(Math, [a,b]),
            max = Math.max.apply(Math, [a,b]);
        return inclusive ? this >= min && this <= max : this > min && this < max;
    };




  if(scrollevent.effect == "pageholding"){


      if(currentdistance.between(startevent,endevent, true)){
          $(originalname).css('position','fixed');
          $(originalname).css('margin-top','0px');
          $(originalname).css('top','0px');

      }else{
          $(originalname).css('position','absolute');

        if(currentdistance > endevent){
            $(originalname).css('margin-top',eventlength);

        }
        if(currentdistance < startevent){
            $(originalname).css('margin-top',0);

        }
      }
  };

  if(scrollevent.effect == "fadeeventin"){

      // In the event area or not
      if(currentdistance.between(startevent,endevent, true)){
        
        // The opacity is equal to 0.00 at the start of the event dividing it by the length 
        // of the event means it is equal to 1 at the end of the event
        yopacity = ((y - startevent) / eventlength).toFixed(2);
        $(originalname).css({'opacity':(yopacity)});

      }else{
    

        // After Event Has Finished
        if(currentdistance > endevent){
          //$(originalname).css({'opacity':1});
        }

        // Before Event Has Started
        if(currentdistance < startevent){
          $(originalname).css({'opacity':0});
        }

      }
  }

  if(scrollevent.effect == "fadeeventout"){
    
      // In the event area or not
      if(currentdistance.between(startevent,endevent, true)){
        
        // The opacity is equal to 0.00 at the start of the event dividing it by the length 
        // of the event means it is equal to 1 at the end of the event
        yopacity = ((endevent - y ) / eventlength).toFixed(2);
        $(originalname).css({'opacity':(yopacity)});


      }else{
        // After Event Has Finished
        if(currentdistance > endevent){
          $(originalname).css({'opacity':0});
        }
        // Before Event Has Started
        if(currentdistance < startevent){
        //  $(originalname).css({'opacity':1});         
        }
      }
  }

  if(scrollevent.effect == "infromleft"){
    var eleWidth = $(elementname).outerWidth(true)
    
      // In the event area or not
      if(currentdistance.between(startevent,endevent, true)){
        var transformcalc = ((y - startevent) / eventlength).toFixed(2);
        var transform = (eleWidth * transformcalc) - eleWidth;


          $(originalname).css({
                        '-webkit-transform': 'translateX(' + transform + 'px)',
                        '-moz-transform': 'translateX(' + transform + 'px)',
                        'transform': 'translateX(' + transform + 'px)'
                    });
      }else{
        // After Event Has Finished
        if(currentdistance > endevent){
          $(originalname).css({
                        '-webkit-transform': 'translateX(0px)',
                        '-moz-transform': 'translateX(0px)',
                        'transform': 'translateX(0px)'
                    });
        }
        // Before Event Has Started
        if(currentdistance < startevent){
          $(originalname).css({
                        '-webkit-transform': 'translateX(-' + eleWidth + 'px)',
                        '-moz-transform': 'translateX(-' + eleWidth + 'px)',
                        'transform': 'translateX(-' + eleWidth + 'px)'
                    });

        }
      }


  }
 
  if(scrollevent.effect == "infromright"){
    var eleWidth = $(elementname).outerWidth(true)

      // In the event area or not
      if(currentdistance.between(startevent,endevent, true)){
        var transformcalc = ((y - startevent) / eventlength).toFixed(2);
        var transform = -(eleWidth * transformcalc) + eleWidth;


          $(originalname).css({
                        '-webkit-transform': 'translateX(' + transform + 'px)',
                        '-moz-transform': 'translateX(' + transform + 'px)',
                        'transform': 'translateX(' + transform + 'px)'
                    });
      }else{
        // After Event Has Finished
        if(currentdistance > endevent){
          $(originalname).css({
                        '-webkit-transform': 'translateX(0px)',
                        '-moz-transform': 'translateX(0px)',
                        'transform': 'translateX(0px)'
                    });
        }
        // Before Event Has Started
        if(currentdistance < startevent){
          $(originalname).css({
                        '-webkit-transform': 'translateX(' + eleWidth + 'px)',
                        '-moz-transform': 'translateX(' + eleWidth + 'px)',
                        'transform': 'translateX(' + eleWidth + 'px)'
                    });
        }
      }
  }

  if(scrollevent.effect == "infrombottom"){

      var eleHeight = $(elementname).outerHeight(true)
      // In the event area or not
      if(currentdistance.between(startevent,endevent, true)){

        var transformcalc = ((y - startevent) / eventlength).toFixed(2);
        var transform = -(eleHeight * transformcalc) + eleHeight;


          $(originalname).css({
                        '-webkit-transform': 'translateY(' + transform + 'px)',
                        '-moz-transform': 'translateY(' + transform + 'px)',
                        'transform': 'translateY(' + transform + 'px)'
                    });
      }else{
        // After Event Has Finished
        if(currentdistance > endevent){
          $(originalname).css({
                        '-webkit-transform': 'translateY(0px)',
                        '-moz-transform': 'translateY(0px)',
                        'transform': 'translateY(0px)'
                    });
        }
        // Before Event Has Started
        if(currentdistance < startevent){
          $(originalname).css({
                        '-webkit-transform': 'translateY(' + eleHeight + 'px)',
                        '-moz-transform': 'translateY(' + eleHeight + 'px)',
                        'transform': 'translateY(' + eleHeight + 'px)'
                    });         
        }
      }
  }
};





});
};

})( jQuery );
