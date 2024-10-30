(function( $ ) {
  'use strict';

window.revert=revert;
 window.change=change;
 window.lockunlock=lockunlock;
 window.lockrow=lockrow;
 window.unlockrow=unlockrow;
 window.deleterow=deleterow;
window.edittitle=edittitle;
window.confirmtitle=confirmtitle;
window.hiddenshow = hiddenshow;
window.hiderow = hiderow;
window.showrow = showrow;
window.activefull = activefull;
window.activetablet = activetablet;
window.activemob = activemob;
window.decodejson = decodejson;
window.in_array = in_array;

  jQuery(document).ready(function($) {

    var active = false,
        sorting = false;

    $( "#accordion" )
    .accordion({
        header: "> div > h3",
        collapsible: true,
        active: false,
        heightStyle: "content",
        activate: function( event, ui){
            //this fixes any problems with sorting if panel was open 
            //remove to see what I am talking about
            if(sorting)
                $(this).sortable("refresh");   
        }
    })
    .sortable({
        handle: "h3",
        placeholder: "ui-state-highlight",
        start: function( event, ui ){
            //change bool to true
            sorting=true;

            //find what tab is open, false if none
            active = $(this).accordion( "option", "active" ); 

            //possibly change animation here (to make the animation instant if you like)
            $(this).accordion( "option", "animate", { easing: 'swing', duration: 0 } );

            //close tab
            $(this).accordion({ active:false });
        },
        stop: function( event, ui ) {
            ui.item.children( "h3" ).triggerHandler( "focusout" );

            //possibly change animation here; { } is default value
            $(this).accordion( "option", "animate", { } );

            //open previously active panel
            $(this).accordion( "option", "active", active );

            //change bool to false
            sorting=false;
        }
    });


    /*$( "#accordion" )
      collapsible: true
      .accordion({
        header: "> div > h3"
      })

      .sortable({
        axis: "y",
        handle: "h3",
        stop: function( event, ui ) {
          // IE doesn't register the blur when sorting
          // so trigger focusout handlers to remove .ui-state-focus
          ui.item.children( "h3" ).triggerHandler( "focusout" );
 
          // Refresh accordion to handle new order
          $( this ).accordion( "refresh" );
        }
      });
*/
  });


   function revert(n) {
    
    var datagroup = $(n).data('row');
  $('[data-rowinput]').each(function(){
   var fulldataid = $(this).data('rowinput');
        if (datagroup == fulldataid) {
           var fulldata = $(this).val();
           var objJSON = eval("(function(){return " + fulldata + ";})()");

var revertarray = [];
$(".activeel").each(function(){

var columnid2 = $(this).attr('id');
revertarray['id'] = columnid2.substr(2);
revertarray[columnid2] = $(this).val();
        var reversedata = $(this).data('row');
        var content2 = $(this).val();
        $(".editon").removeClass("editon").addClass("editoff");
 if ($(this).attr('data-sizefield')) {
        var sizefieldval = $(this).data('sizefield');
          $( this ).replaceWith( "<p id='" + columnid2 + "' class='tblelement' data-row='" + reversedata + "' data-sizefield='" + sizefieldval + "' onclick='change(this)' >" + content2 + "</p>" );

}else{
          $( this ).replaceWith( "<p id='" + columnid2 + "' class='tblelement' data-row='" + reversedata + "' onclick='change(this)' >" + content2 + "</p>" );

}

});
var revertid = revertarray['id']


var sizechecke = 'sd'+revertid;
var sizechecki = 'si'+revertid;
var sizecheckh = 'sh'+revertid;
console.log(revertid);
if('sd'+revertid in revertarray){
var savecontent = '{"id": "'+ revertid +'","rowhidden": "'+ objJSON.rowhidden +'","pageid": "'+ objJSON.pageid +'","objectname": "'+ revertarray['sa'+revertid] +'", "effect":"'+ revertarray['sb'+revertid] +'", "eventlength": "'+ revertarray['sc'+revertid]  +'", "pagelocation" : "'+ revertarray['sd'+revertid] +'", "pagelocationm" : "'+ objJSON.pagelocationm +'", "pagelocations" : "'+ objJSON.pagelocations +'", "lockwith" : "'+ revertarray['se'+revertid] +'","lockstatus": "'+ objJSON.lockstatus +'"}';
}
if('sh'+revertid in revertarray){
var savecontent = '{"id": "'+ revertid +'","rowhidden": "'+ objJSON.rowhidden +'","pageid": "'+ objJSON.pageid +'","objectname": "'+ revertarray['sa'+revertid] +'", "effect":"'+ revertarray['sb'+revertid] +'", "eventlength": "'+ revertarray['sc'+revertid]  +'", "pagelocation" : "'+ objJSON.pagelocation +'", "pagelocationm" : "'+ revertarray['sh'+revertid] +'", "pagelocations" : "'+ objJSON.pagelocations +'", "lockwith" : "'+ revertarray['se'+revertid] +'","lockstatus": "'+ objJSON.lockstatus +'"}';

}
if('si'+revertid in revertarray){
var savecontent = '{"id": "'+ revertid +'","rowhidden": "'+ objJSON.rowhidden +'","pageid": "'+ objJSON.pageid +'","objectname": "'+ revertarray['sa'+revertid] +'", "effect":"'+ revertarray['sb'+revertid] +'", "eventlength": "'+ revertarray['sc'+revertid]  +'", "pagelocation" : "'+ objJSON.pagelocation +'", "pagelocationm" : "'+ objJSON.pagelocationm +'", "pagelocations" : "'+ revertarray['si'+revertid] +'", "lockwith" : "'+ revertarray['se'+revertid] +'","lockstatus": "'+ objJSON.lockstatus +'"}';
}
$('#fullrow'+ revertid ).val(savecontent);


}
});
     
    
    };

    function change(n) {


    
     var datagroup = $(n).data('row');

    revert(n);

    var elem = $(n).text().length;

$('[data-row]').each(function(){


    var individualdata = $(this).data('row');
    
if(individualdata == datagroup){
      if($(n).hasClass("locked")){      
      }else{


      var content = $(this).text();
      var columnid = $(this).attr('id');

      if ($(this).attr('data-sizefield')) {
        var sizefieldval = $(this).data('sizefield');
        $( this ).replaceWith( "<textarea id='" + columnid + "' class='tblelement activeel' data-row='" + individualdata + "' data-sizefield='" + sizefieldval + "'>" + content + "</textarea>" );
        
}else{
  if ($(this).attr('data-editrow')) {
    $(this).removeClass("editoff").addClass("editon");
}else{
        $( this ).replaceWith( "<textarea id='" + columnid + "' class='tblelement activeel' data-row='" + individualdata + "'>" + content + "</textarea>" );
      }  
}



        if(this == n){
            $("textarea").prop("selectionStart", elem).focus();
        }  

}
}
});

};

$('textarea').live("keydown", function(e) {
    if(e.keyCode == 13){
      
        revert(this);
    }
});

function hiddenshow(n){
  
  if($(n).hasClass("eyevisable")){
    hiderow(n);
  }else{

    showrow(n);
  }
}


function hiderow(n){
 var hiderow = $(n).data('btnhrow');
 var hiderowid = hiderow.substr(3);
 console.log(hiderowid);
 var obj = [decodejson(hiderowid)];

      $(n).removeClass("genericon-show").addClass("genericon-hide");
      $(n).removeClass("eyevisable").addClass("hiddenrow");


var hidejson = '{"id": "'+ obj[0].id +'","rowhidden": "0","pageid": "'+ obj[0].pageid +'","objectname": "'+ obj[0].objectname +'", "effect":"'+ obj[0].effect +'", "eventlength": "'+ obj[0].eventlength  +'", "pagelocation" : "'+ obj[0].pagelocation +'", "pagelocationm" : "'+ obj[0].pagelocationm +'", "pagelocations" : "'+ obj[0].pagelocations +'", "lockwith" : "'+  obj[0].lockwith +'","lockstatus": "'+ obj[0].lockstatus +'"}';
    $('#fullrow'+ hiderowid ).val(hidejson)

};

function showrow(n){
 var showrow = $(n).data('btnhrow');
 var showrowid = showrow.substr(3);
 console.log(showrowid );

 var obj = [decodejson(showrowid)];

      $(n).removeClass("genericon-hide").addClass("genericon-show");
      $(n).removeClass("hiddenrow").addClass("eyevisable");


    var showjson = '{"id": "'+ obj[0].id +'","rowhidden": "1","pageid": "'+ obj[0].pageid +'","objectname": "'+ obj[0].objectname +'", "effect":"'+ obj[0].effect +'", "eventlength": "'+ obj[0].eventlength  +'", "pagelocation" : "'+ obj[0].pagelocation +'", "pagelocationm" : "'+ obj[0].pagelocationm +'", "pagelocations" : "'+ obj[0].pagelocations +'", "lockwith" : "'+  obj[0].lockwith +'","lockstatus": "'+ obj[0].lockstatus +'"}';
    $('#fullrow'+ showrowid ).val(showjson)



};

function lockunlock(n){
  var result = $(n).hasClass("locked");
  if($(n).hasClass("locked")){
    unlockrow(n);
  }else{

    lockrow(n);
  }


};


    function lockrow(n) {
  
     var lockgroup = $(n).data('btnrow');
      $('[data-row]').each(function(){
      var rowid = $(this).data('row');

          if(lockgroup == rowid){
            $(this).addClass("locked");            
          };        

      $(n).removeClass("genericon-key").addClass("genericon-lock");
      $(n).removeClass("unlocked").addClass("locked");
      });

      $('[data-binbtnrow]').each(function(){
      var binid = $(this).data('binbtnrow');

          if(lockgroup == binid){
            $(this).removeClass("binunlocked").addClass("binlocked");
          }; 
      }); 

    var lockrowid = lockgroup.substr(4);
    var obj = [decodejson(lockrowid)];

    var lockjson = '{"id": "'+ obj[0].id +'","rowhidden": "'+ obj[0].rowhidden +'","pageid": "'+ obj[0].pageid +'","objectname": "'+ obj[0].objectname +'", "effect":"'+ obj[0].effect +'", "eventlength": "'+ obj[0].eventlength  +'", "pagelocation" : "'+ obj[0].pagelocation +'", "pagelocationm" : "'+ obj[0].pagelocationm +'", "pagelocations" : "'+ obj[0].pagelocations +'", "lockwith" : "'+  obj[0].lockwith +'","lockstatus": "locked"}';
                        
    $('#fullrow'+ lockrowid ).val(lockjson)

};

    function unlockrow(n) {
    var unlockgroup = $(n).data('btnrow');

      $('[data-row]').each(function(){
      var rowid = $(this).data('row');

          if(unlockgroup == rowid){
            $(this).removeClass("locked");
          };       

      $(n).removeClass("locked").addClass("unlocked");
      $(n).removeClass("genericon-lock").addClass("genericon-key");

      });

      $('[data-binbtnrow]').each(function(){
      var binid = $(this).data('binbtnrow');

          if(unlockgroup == binid){
            $(this).removeClass("binlocked").addClass("binunlocked");
          }; 
      }); 

    var unlockrowid = unlockgroup.substr(4);
    var obj = [decodejson(unlockrowid)];

    var unlockjson = '{"id": "'+ obj[0].id +'","rowhidden": "'+ obj[0].rowhidden +'","pageid": "'+ obj[0].pageid +'","objectname": "'+ obj[0].objectname +'", "effect":"'+ obj[0].effect +'", "eventlength": "'+ obj[0].eventlength  +'", "pagelocation" : "'+ obj[0].pagelocation +'", "pagelocationm" : "'+ obj[0].pagelocationm +'", "pagelocations" : "'+ obj[0].pagelocations +'", "lockwith" : "'+  obj[0].lockwith +'","lockstatus": "unlocked"}'; 
    
    $('#fullrow'+ unlockrowid ).val(unlockjson)

};


    function deleterow(n){
      var deleterowid = $(n).data('binbtnrow');

      $('[data-tablerow]').each(function(){
        var delrowid = $(this).data('tablerow');

          if(deleterowid == delrowid){
            $(this).remove();

          }


      });      
    }



    function edittitle(n){
     var edittitleid = $(n).data('titleedit');

      $(n).removeClass("genericon-edit").addClass("genericon-checkmark");
            $(n).attr("onClick", "confirmtitle(this);" );

      $('[data-titlelist]').each(function(){
        var tlistid = $(this).data('titlelist');

          if(edittitleid == tlistid){
            $(this).removeClass("hiddennames");

            $('[data-titlen]').each(function(){
            var titlen = $(this).data('titlen');

              if(edittitleid == titlen){
               $(this).addClass("hiddennames");

              }
            });  
          }
      });     
    }

    function confirmtitle(n){
        var edittitleid = $(n).data('titleedit');

      $(n).removeClass("genericon-checkmark").addClass("genericon-edit");
            $(n).attr("onClick", "edittitle(this);" );



      $('[data-titlelist]').each(function(){
        var tlistid = $(this).data('titlelist');

          if(edittitleid == tlistid){

            var valueofbtn = $(this).val();
            var textofbtn = $(this).find("option:selected").text();//$(this).text();
            $(this).addClass("hiddennames");

            $('[data-pageid]').each(function(){
                var pageid = $(this).data('pageid'); 
                if(edittitleid == pageid){

                        var titlerowid = $(this).data('rowinput');
                        var trowid = titlerowid.substr(3);
                        var obj = [decodejson(trowid)];
                        var titlejson = '{"id": "'+ obj[0].id +'","rowhidden": "'+ obj[0].rowhidden +'","pageid": "'+ valueofbtn +'","objectname": "'+ obj[0].objectname +'", "effect":"'+ obj[0].effect +'", "eventlength": "'+ obj[0].eventlength  +'", "pagelocation" : "'+ obj[0].pagelocation +'", "pagelocationm" : "'+ obj[0].pagelocationm +'", "pagelocations" : "'+ obj[0].pagelocations +'", "lockwith" : "'+  obj[0].lockwith +'","lockstatus": "'+ obj[0].lockstatus +'"}';                        $('#fullrow'+ trowid).val(titlejson);

                 }
            });

            $('[data-titlen]').each(function(){
            var titlen = $(this).data('titlen');

              if(edittitleid == titlen){
               $(this).removeClass("hiddennames");
               
                $(this).text(textofbtn);
              }
            });  
            $('[data-titlehead]').each(function(){
            var titleh = $(this).data('titlehead');

              if(edittitleid == titleh){
              
                $(this).text(textofbtn);
              }
            });  





          }
      });

}

function activemob(n){
  
  $('[data-sizefield]').each(function(){
      var fieldrowid = $(this).data('sizefield');
      var newfieldid = "si"+fieldrowid;
      var sizevalue;
      $(this).attr("id", newfieldid );
          $('[data-screensize]').each(function(){
              var screensizeid = $(this).data('screensize');
              var matchid = screensizeid.substr(2);
              matchid = "si" + matchid;
              
              if(newfieldid == matchid){
                
                        var mobrowid = screensizeid.substr(2);
                      
                        var obj = [decodejson(mobrowid)];
                        sizevalue = obj[0].pagelocations;
                        

                $('#'+newfieldid).text(sizevalue);
              }

          });
  });
    $('.screensize').removeClass().addClass('screensize genericon genericon-phone');
}

function activetablet(n){
    $('[data-sizefield]').each(function(){
      var fieldrowid = $(this).data('sizefield');
      var newfieldid = "sh"+fieldrowid;
    var sizevalue;
    

      $(this).attr("id", newfieldid );
          $('[data-screensize]').each(function(){
              var screensizeid = $(this).data('screensize');
              var matchid = screensizeid.substr(2);
              matchid = "sh" + matchid;
              
              if(newfieldid == matchid){
                        var tabletsrowid = screensizeid.substr(2);
                    
                        var obj = [decodejson(tabletsrowid)];
                        sizevalue = obj[0].pagelocationm;
                   

                $('#'+newfieldid).text(sizevalue);
              }

          });
  });

  $('.screensize').removeClass().addClass('screensize genericon genericon-tablet');
}

function activefull(n){
  
  $('[data-sizefield]').each(function(){
      var fieldrowid = $(this).data('sizefield');
      var newfieldid = "sd"+fieldrowid;
      var sizevalue;

      $(this).attr("id", newfieldid );
          $('[data-screensize]').each(function(){
              var screensizeid = $(this).data('screensize');

              if(newfieldid == screensizeid){


                        var fullsrowid = screensizeid.substr(2);
                        var obj = [decodejson(fullsrowid)];
                        sizevalue = obj[0].pagelocation;

                $('#'+newfieldid).text(sizevalue);
              }
 
 
          });
  });
    $('.screensize').removeClass().addClass('screensize genericon genericon-fullscreen');
}


function decodejson(n){

  var objJSON; 
  var idfield = 'fulldata' + n;
  
  $('[data-fulldata]').each(function(){
   var fulldataid = $(this).data('fulldata');
        if (idfield == fulldataid) {
           var fulldata = $(this).val();
           objJSON = eval("(function(){return " + fulldata + ";})()");
        };
});
  return (objJSON);
}

function in_array(needle, haystack, argStrict) {

  var key = '',
    strict = !! argStrict;

  if (strict) {
    for (key in haystack) {
      if (haystack[key] === needle) {
        return true;
      }
    }
  } else {
    for (key in haystack) {
      if (haystack[key] == needle) {
        return true;
      }
    }
  }
  return false;
}


})( jQuery );
