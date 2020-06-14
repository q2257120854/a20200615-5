/**
 *  某某短域名系统 jQuery Application
 *  Copyright @domain.com - All rights Reserved 
 */
$(document).ready(function(){

 /**
  * Shorten URL
  **/
 // Ajax request: URL shortening and error handeling
  $(document).on('submit',"form#main-form",function(e) {
    e.preventDefault();
    var form = $(this);
    if($("#multiple-form").val()==="1"){
      var url =  form.find(".main-textarea");
    }else{
      var url =  form.find(".main-input");
    }
    if(!url.val()){
      $('.ajax').hide().html('<div class="alert alert-danger">'+lang.error+'</div>').fadeIn('slow');
      $('.main-input').addClass('error');
      return;
    }
    var lang_shorn=form.find('#shortenurl').text();   
    $.ajax({
      type: "POST",
      url: appurl+"/shorten",
      data: $(this).serialize(),
      dataType:"json",
      beforeSend: function() {
        $('.ajax').html("<img class='loader' src='"+appurl+"/static/loader.gif' style='margin:5px 50%;border:0;' />");            
      },
      complete: function() {        
        $('.ajax').find('.loader').fadeOut("fast");
      },            
      success: function (html) {                        
          if(html.error){
            if(html.html == "captcha"){
              $('#captcha').fadeIn('slow');                
            }
            $('.ajax').hide().html('<div class="alert alert-danger">'+html.msg+'</div>').fadeIn('slow');               
            $('.main-input').addClass('error');
          }else{
            $('.main-input').removeClass('error');              
            $('.main-advanced').fadeOut('slow');
            $('#captcha').fadeOut('slow');                     
          if(!html.confirm){
            $("#shortenurl").hide();
            $("#copyurl").show();               
            
            var short = html.short.split("#");

            $('.ajax').hide().html('<div class="alert alert-success no-round">'+lang.success+' <br /><br /> '+lang.stats+' '+short[0]+'+ </div>').fadeIn('slow');
            $('.share-this').html('<div class="panel panel-body"><div class="qr"><img src="'+short[0]+'/qr" alt=""></div><div class="share-message"><p>'+lang.congrats+'</p><div class="share"><a href="'+html.short+'/qr" target="_blank" class="btn btn-primary copy" data-value="'+html.short+'/qr">'+lang.qr+'</a> <a href="http://www.facebook.com/sharer.php?u='+html.short+'" target="_blank" class="btn btn-facebook u_share">'+lang.share+' Facebook</a> <a href="https://twitter.com/share?url='+html.short+'" target="_blank" class="btn btn-twitter u_share">'+lang.share+' Twitter</a></div></div></div>').fadeIn('slow');
             zClipload();             
          }else{
            $('.share-this').slideUp();
            $('.ajax').hide().html('<div class="alert alert-success">'+lang.success+'</div>').fadeIn('slow');             
          }           
          $('.main-advanced').find('input').val('');
          url.val(html.short);  
          url.select();
          if($(".g-recaptcha").length > 0){
            grecaptcha.reset();
          }
          var copy = new Clipboard('#copyurl');            
          $("#submit").hide();            
          $("#copyurl").attr("data-clipboard-text", html.short).show();
          copy.on('success', function(e) {  
            $('.ajax').hide().html('<div class="alert alert-success">'+lang.copy+'</div>').fadeIn('slow'); 
            $("#copyurl").hide();
            $("#shortenurl").show();
            $('input.main-input').val('');
          });                                  
        } 
          
      }
    });  
  });    
  /**
  * Search for URls
  **/
  $("#search").submit(function(e){
    e.preventDefault();
    var val=$(this).find("input[type=text]").val();
    var action=$(this).attr("action");
    if(val.length > 3){
      $.ajax({
          type: "POST",
          url: action,
          data: "q="+val+"&token="+token,
          beforeSend: function() {
            $(".return-ajax").html("<img class='loader' src='"+appurl+"/static/loader.gif' style='margin:0 45%;border:0;' />");
          },
          complete: function() {      
            $('img.loader').fadeOut("fast",function(){$(this).remove()});
          },          
          success: function (r) { 
            $(".return-ajax").html(r);
            $(".url-container").slideUp('fast');
            $(".return-ajax").slideDown('fast');
            loadall();
          }
      }); 
    }else{
      $(".return-ajax").html('<p class="alert alert-info" style="color:#fff">Keyword must be more than 3 characters!</p><br>').fadeIn();
    }   
  });
 /**
   * Server Requests
   **/ 
  $(document).on('click','.ajax_call',function(p){
      p.preventDefault();
      var e = $(this);
      var id = $(this).attr("data-id");
      var action = $(this).attr("data-action");
      var loading="<img class='loader' src='"+appurl+"/static/loader.gif' style='margin:5px 50%;border:0;' />";
      var title = e.attr("data-title");
      if(typeof($(this).attr("data-container")) == "undefined"){
        if(typeof($(this).attr("data-class"))!="undefined") {
          var container=$("."+$(this).attr("data-class"));
          var loading="<span><i class='glyphicon glyphicon-refresh'></i> Loading</span>";
        }else{
          if(typeof(title) == "undefined") title="User Account";
          $(this).modal({title:title,content:"Please wait while loading...",confimation:1});
          var container=$("#modal-alert > p");
        }
      }else{
        var container=$("#"+$(this).attr("data-container"));
      }
      var title=$(this).attr("data-title");
      $.ajax({
        type: "POST",
        url: appurl+"/server",
        data: "request="+action+"&id="+id+"&token="+token,
        beforeSend: function() {
          container.html(loading);
        },
        complete: function() {   
          loadall();    
          $('img.loader').fadeOut("fast");
        },                   
        success: function (html) {           
          if(typeof(e.attr("data-active")) !== "undefined"){
            e.parents("div#user-content").find(".active").removeClass("active");
            e.addClass(e.attr("data-active"));
          }
          container.hide();                                            
          container.html(html);
          container.fadeIn('fast');
        }
      });       
  });
  if($("#widget_activities").length > 0){
    var intval =  $("#widget_activities").attr("data-refresh");
    setInterval(function(){
      server("activities");
    },intval);
  }
});  
/**
 * Realtime Data
 **/
function server(fn){
  if(fn=="activities"){
    var li=$("#widget_activities").find("li");
    var text=$("#widget_activities h3 small").text();
    var id=li.attr("data-id");
    if(typeof(id) == "undefined") id=0;
    $.ajax({
          type: "POST",
          url: appurl+"/server",
          data: "request=activities&id="+id+"&token="+token,
          beforeSend: function() {
          	li.removeClass("new_item");
            $("#widget_activities h3 small").html("<img class='loader' src='"+appurl+"/static/loader.gif' style='margin:0 45%;border:0;' />");
          },
          complete: function() {      
            $("#widget_activities h3 small").text(text);
          },          
          success: function (r) {             
            $("#widget_activities ul").html(r);
          }
      }); 
  }
  return false;
}  