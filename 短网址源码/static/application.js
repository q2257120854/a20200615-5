/**
 *  某某短域名系统 jQuery Application
 *  Copyright @domain.com - All rights Reserved 
 */
$(function() {
    if($('[data-toggle="datepicker"]').length > 0){
      $('[data-toggle="datepicker"]').datepicker({
        autoPick: true,
        format: "mm/dd/yyyy",
        startDate: new Date()
      }).val("");    
    }
    $(".tabbed").hide();
    $(".tabbed").filter(":first").fadeIn();
    $(".tabs a").click(function(e){
      if($(this).attr("data-link")){
        return;
      }
      e.preventDefault();
      var id = $(this).attr("href");
      $(".tabs li").removeClass("active");
      $(this).parent("li").addClass("active");
      $(".tabbed").hide();
      $(id).fadeIn();
      update_sidebar();
    });
 /**
  * Hide advanced option + Toggle on click
  */
  $(".slideup").slideUp();
  $(".advanced").click(function(e){
    e.preventDefault();
    $(".main-advanced").slideToggle("medium", function(){
      update_sidebar();
    });
  });  
  /**
   * Add & Delete Location Field
   */
  var html=$(".country").html();
  $(".add_geo").click(function(){
    if($(this).attr("data-home")){
      $(".geo-input").append("<div class='row'>"+html+"</div><p><a href='#' class='btn btn-danger btn-xs delete_geo' data-holder='div.row'>"+lang.del+"</a></p>");
    }else{
      $('#geo').append("<div class='form-group'>"+html+"</div><p><a href='#' class='btn btn-danger btn-xs delete_geo'>"+lang.del+"</a></p>");      
    }
    update_sidebar();
    if($().chosen) {
      $("select").chosen({disable_search_threshold: 5});
    }
    return false;
  }); 
  $(document).on('click',".delete_geo",function(e){
    e.preventDefault();
    var t=$(this);
    $(this).parent('p').prev($("this").attr("data-holder")).slideUp('slow',function(){
      $(this).remove();
      t.parent('p').remove();
    });
    return false;
  });  
  // Add more devices
  var dhtml=$(".devices").html();
  $(".add_device").click(function(){
    if($(this).attr("data-home")){
      $(".device-input").append("<div class='row'>"+dhtml+"</div><p><a href='#' class='btn btn-danger btn-xs delete_device' data-holder='div.row'>"+lang.del+"</a></p>");
    }else{
      $('#device').append("<div class='form-group'>"+dhtml+"</div><p><a href='#' class='btn btn-danger btn-xs delete_device'>"+lang.del+"</a></p>");      
    }
    update_sidebar();
    if($().chosen) {
      $("select").chosen({disable_search_threshold: 5});
    }
    return false;
  }); 
  $(document).on('click',".delete_device",function(e){
    e.preventDefault();
    var t=$(this);
    $(this).parent('p').prev($("this").attr("data-holder")).slideUp('slow',function(){
      $(this).remove();
      t.parent('p').remove();
    });
    return false;
  });    
  /**
   * Call Neo
   **/
  if($().chosen) {
    $("select").chosen({disable_search_threshold: 5});  
  }   
  /**
   * Custom Radio Box
   **/
  $(document).on('click','.form_opt li a',function(e) {
    
    var href=$(this).attr('href');
    var name = $(this).parent("li").parent("ul").attr("data-id");
    var to = $(this).attr("data-value");
    var callback=$(this).parent("li").parent("ul").attr("data-callback");
    if(href=="#" || href=="") e.preventDefault();

    $("input#" + name).val(to);
    $(this).parent("li").parent("ul").find("a").removeClass("current");
    $(this).addClass("current");
    if(callback !==undefined){
      window[callback](to);
    }
  });
  /**
   * Show forgot password form
   **/
   $(document).on('click','#forgot-password',function(){
      show_forgot_password();
   });
   if(location.hash=="#forgot"){
      show_forgot_password();
   }   
   $(document).on('click',"div.alert",function(){
    $(this).fadeOut();
   }); 
  /**
   * Open share window
   */
   $(document).on('click',"a.u_share",function(e){
    e.preventDefault();
    window.open($(this).attr("href"), '', 'left=50%, top=100, width=550, height=450, personalbar=0, toolbar=0, scrollbars=1, resizable=1')    
   });  
  /**
   * Back to top
   */
  $(window).scroll(function(){   
    if(window.pageYOffset>300){
      $("#back-to-top").fadeIn('slow');
    }else{
      $("#back-to-top").fadeOut('slow');
    }
  });
  $("a#back-to-top,.scroll").smoothscroll(); 
  //
  $(document).on('click',".clear-search",function(e){
    e.preventDefault();
    $(".return-ajax").slideUp('medium',function(){
      $(this).html('');
      $("#search").find("input[type=text]").val('');
      $(".url-container").slideDown('medium');
    });
  });  
  // Select All
  $(document).on('click','#selectall',function(e) {
    e.preventDefault();   
    $('input').iCheck('toggle');            
  }); 
  /**
   * Delete All
   */
  $(document).on('click','#deleteall',function(e) {
    e.preventDefault();
    $('form#delete-all-urls').submit();
  });  
  /**
   * Active Menu
   **/
  var path = location.pathname.substring(1);  
  if (path) {
    $('.nav-sidebar a').removeClass("active");
    $('.nav-sidebar a[href$="' + path + '"]').addClass('active'); 
  }   
  // Alert Modal
  $(document).on("click",".delete",function(e){
    e.preventDefault();
    $(this).modal();    
  });
  /**
   * OnClick Select
   **/
   $(".onclick-select").on('click',function(){
    $(this).select();
   })
  /**
   * Show Languages
   **/
  $("#show-language").click(function(e){
    e.preventDefault();
    $(".langs").fadeToggle();
  });
  if($().chosen) {
    $('select.filter').chosen().change(function(e,v){
        var href=document.URL.split("?")[0].split("#")[0];
        window.location=href+"?"+$(this).attr("data-key")+"="+v.selected;
    });   
  }
  $(".tooltip").tooltip();
  // Load all
  loadall();
  function format_date(time){
    var d=new Date(time);
    var list=new Array();
    list[0]="January";list[1]="February";list[2]="March";list[3]="April";list[4]="May";list[5]="June";list[6]="July";list[7]="August";list[8]="September";list[9]="October";list[10]="November";list[11]="December";       
    var month = list[d.getMonth()];
    return d.getDate()+" "+ month +", "+d.getFullYear();
  }  
  // Charts
  if($(".chart").length > 0){
    function showTooltip(x, y, c, d) {
      $('<div id="tooltip" class="chart-tip"><strong>' + c + '</strong><br>'+format_date(d)+'</div>').css( {
          position: 'absolute',
          display: 'none',
          top: y - 40,
          left: x - 30,
          color: '#fff',
          opacity: 0.80
      }).appendTo("body").fadeIn(200);
    }

    var previousPoint = null;
    var previousSeries = null;
    $(".chart").bind("plothover", function (event, pos, item) {
      if(item){
        if(previousSeries != item.seriesIndex || previousPoint != item.dataIndex){
          previousPoint = item.dataIndex;
          previousSeries = item.seriesIndex; 
          $("#tooltip").remove();
          showTooltip(item.pageX, item.pageY, item.datapoint[1]+" Clicks", item.datapoint[0]);          
        }                      
      }
    });     
  }  
  if(typeof Clipboard == "function"){
    new Clipboard('.copy');  
  }  

  $(".copy").click(function(e){
    e.preventDefault();  
    $(this).text(lang.copied);
    $(this).prev("a").addClass("float-away");
    setTimeout(function() {
      $("a").removeClass('float-away');
    }, 400);    
  });  

  $(".stripe-button-el span").on("click", function(e){
    
    $(".form-group").removeClass("has-danger");
    
    var $error = 0;

    var $name = $("#name");
    if ($name == "" || $name.val().length < 2) {
        $name.parents(".form-group").addClass("has-danger");
        $error = 1;
    }    

    var $address = $("#address");
    if ($address == "" || $address.val().length < 2) {
        $address.parents(".form-group").addClass("has-danger");
        $error = 1;
    }   

    var $city = $("#city");
    if ($city == "" || $city.val().length < 2) {
        $city.parents(".form-group").addClass("has-danger");
        $error = 1;
    }     

    var $state = $("#state");
    if ($state == "" || $state.val().length < 2) {
        $state.parents(".form-group").addClass("has-danger");
        $error = 1;
    } 

    var $zip = $("#zip");
    if ($zip == "" || $zip.val().length < 2) {
        $zip.parents(".form-group").addClass("has-danger");
        $error = 1;
    }                 
    if($error) return false;
  });
  if(typeof cookieconsent == "object"){
    window.cookieconsent.initialise({
      "palette": {
        "popup": {
          "background": "#2148b1"
        },
        "button": {
          "background": "#fff",
          "color": "#2148b1"
        }
      },
      "theme": "classic",
      "position": "bottom-right",
      "content": {
        "message": lang.cookie,
        "dismiss": lang.cookieok,
        "link": lang.cookiemore,
        "href": appurl + "/page/privacy"
      }
    });    
  }
}); // End jQuery Ready
/**
 * iCheck Load Function
 **/
function icheck_reload(){
  if(typeof icheck !== "undefined"){
    var c=icheck;
  }else{
    if($("input[type=checkbox],input[type=radio]").attr("data-class")){
      var c="-"+$("input[type=checkbox],input[type=radio]").attr("data-class");
    }else{
      var c="";
    }    
  }
  if($().iCheck){
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat'+c,
      radioClass: 'iradio_flat'+c
    }); 
  }
}

/**
 * Show Password Field Function
 **/
function show_forgot_password(){
  $("#login_form").slideUp("slow");
  $("#forgot_form").slideDown("slow");  
  return false  
}
/**
 * Custom Radio Box Callback
 **/
function update_sidebar(){
  // Sidebar Height
  if(!is_mobile() && !is_tablet()){
    var h1 = $(".content").height();
    $(".sidebar").height(h1 - 57); 
  }    
}
/**
 * Load zClip
 **/
function zClipload(){
 
}
/**
 * Load Some Functions
 **/
function loadall(){
  zClipload();
  icheck_reload();
  update_sidebar();
}
// Switch Forms
window.form_switch= function(e){
  if(e == 0){
    $("#multiple").slideUp();
    $("#single").slideDown();
    $(".advanced").fadeIn();    
  }else{
    $("#multiple").slideDown();
    $("#single").slideUp();  
    $(".main-advanced").slideUp();
    $(".advanced").fadeOut();
  }
}