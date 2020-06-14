 /*TipTip Version 1.3 */
var tip_ttt = 0;
(function($){
	$.fn.tipTip = function(options) {
		var defaults = { 
			parent: false,
			hoverClass: false,
			activation: "hover",
			keepAlive: false,
			maxWidth: "400px",
			edgeOffset: 3,
			defaultPosition: "bottom",
			left: 0,
			arrowLeft: 0,
			delay: 0,
			fadeIn: 0,
			fadeOut: 0,
			attribute: "title",
			content: false, // HTML or String to fill TipTIp with
		  	enter: function(){},
		  	exit: function(){}
	  	};
	 	var opts = $.extend(defaults, options);
	 	
	 	// Setup tip tip elements and render them to the DOM
	 	if($("#tiptip_holder").length <= 0){
	 		var tiptip_holder = $('<div id="tiptip_holder" style="max-width:'+ opts.maxWidth +';"></div>');
			var tiptip_content = $('<div id="tiptip_content"></div>');
			var tiptip_arrow = $('<div id="tiptip_arrow"></div>');
			$("body").append(tiptip_holder.html(tiptip_content).prepend(tiptip_arrow.html('<div id="tiptip_arrow_inner"></div>')));
		}

		this.each(function(){
			var org_elem = $(this);

			if(opts.content){
				var org_title = opts.content;
			} else {
				var org_title = org_elem.attr(opts.attribute);
			}

			if(org_title != ""){
				if(!opts.content) org_elem.removeAttr(opts.attribute);

				var tiptip_holder = $("#tiptip_holder");
				var tiptip_content = $("#tiptip_content");
				var tiptip_arrow = $("#tiptip_arrow");
				
				if(opts.activation == "hover"){
					org_elem.hover(function(){

						clearTimeout(tip_ttt);
						tip_ttt = setTimeout(function(){active_tiptip();}, opts.delay);	

					}, function(){

						clearTimeout(tip_ttt);
						if(!opts.keepAlive){
							deactive_tiptip();
						}else{
							tip_ttt = setTimeout(function(){deactive_tiptip();}, 1000);	
						}
					});

				} else if(opts.activation == "click"){
					org_elem.click(function(e){

						tiptip_holder.unbind();
						clearTimeout(tip_ttt);
						active_tiptip();
						e.preventDefault();

					}).mouseout(function(){

						clearTimeout(tip_ttt);
						if(!opts.keepAlive){
							deactive_tiptip();
						}else{
							tip_ttt = setTimeout(function(){deactive_tiptip();}, 1000);	
						}
					});

				} else if(opts.activation == "focus"){
					org_elem.focus(function(){
						active_tiptip();
					}).blur(function(){
						deactive_tiptip();
					});
				}
			
				function active_tiptip(){
					tiptip_holder.unbind();
					//opts.enter.call(this);
					tiptip_content.html(org_title);
					tiptip_holder.hide().removeAttr("class").css({"margin": "0", "max-width": opts.maxWidth});
					tiptip_arrow.removeAttr("style");

					opts.enter.call();

					tiptip_holder.hover(function(){
						if(tip_ttt) clearTimeout(tip_ttt);
						if(opts.hoverClass) org_elem.addClass(opts.hoverClass);
					}, function(){
						deactive_tiptip();
						if(opts.hoverClass) org_elem.removeClass(opts.hoverClass);
					});

					if(opts.parent){
						var target = org_elem.parent();
					}else{
						var target = '';
					}

					if(target.length){
						var top = parseInt(target.offset()['top']);
						var left = parseInt(target.offset()['left']);
						var org_width = parseInt(target.outerWidth());
						var org_height = parseInt(target.outerHeight());
					}else{
						var top = parseInt(org_elem.offset()['top']);
						var left = parseInt(org_elem.offset()['left']);
						var org_width = parseInt(org_elem.outerWidth());
						var org_height = parseInt(org_elem.outerHeight());
					}
					
					var tip_w = tiptip_holder.outerWidth();
					var tip_h = tiptip_holder.outerHeight();
					var w_compare = Math.round((org_width - tip_w) / 2);
					var h_compare = Math.round((org_height - tip_h) / 2);
					var marg_left = Math.round(left + w_compare);
					var marg_top = Math.round(top + org_height + opts.edgeOffset);
					var t_class = "";
					var arrow_top = "";
					var arrow_left = Math.round(tip_w - 12) / 2;
					marg_left += opts.left;
					arrow_left += opts.arrowLeft;

                    if(opts.defaultPosition == "bottom"){
                    	t_class = "_bottom";
                   	} else if(opts.defaultPosition == "top"){ 
                   		t_class = "_top";
                   	} else if(opts.defaultPosition == "left"){
                   		t_class = "_left";
                   	} else if(opts.defaultPosition == "right"){
                   		t_class = "_right";
                   	}
					
					var right_compare = (w_compare + left) < parseInt($(window).scrollLeft());
					var left_compare = (tip_w + left) > parseInt($(window).width());
					
					if((right_compare && w_compare < 0) || (t_class == "_right" && !left_compare) || (t_class == "_left" && left < (tip_w + opts.edgeOffset + 5))){
						t_class = "_right";
						arrow_top = Math.round(tip_h - 13) / 2;
						arrow_left = -12;
						marg_left = Math.round(left + org_width + opts.edgeOffset);
						marg_top = Math.round(top + h_compare);
					} else if((left_compare && w_compare < 0) || (t_class == "_left" && !right_compare)){
						t_class = "_left";
						arrow_top = Math.round(tip_h - 13) / 2;
						arrow_left =  Math.round(tip_w);
						marg_left = Math.round(left - (tip_w + opts.edgeOffset + 5));
						marg_top = Math.round(top + h_compare);
					}

					var top_compare = (top + org_height + opts.edgeOffset + tip_h + 8) > parseInt($(window).height() + $(window).scrollTop());
					var bottom_compare = ((top + org_height) - (opts.edgeOffset + tip_h + 8)) < 0;
					
					if(top_compare || (t_class == "_bottom" && top_compare) || (t_class == "_top" && !bottom_compare)){
						if(t_class == "_top" || t_class == "_bottom"){
							t_class = "_top";
						} else {
							t_class = t_class+"_top";
						}
						arrow_top = tip_h;
						marg_top = Math.round(top - (tip_h + 5 + opts.edgeOffset));
					} else if(bottom_compare | (t_class == "_top" && bottom_compare) || (t_class == "_bottom" && !top_compare)){
						if(t_class == "_top" || t_class == "_bottom"){
							t_class = "_bottom";
						} else {
							t_class = t_class+"_bottom";
						}
						arrow_top = -12;						
						marg_top = Math.round(top + org_height + opts.edgeOffset);
					}
				
					if(t_class == "_right_top" || t_class == "_left_top"){
						marg_top = marg_top + 5;
					} else if(t_class == "_right_bottom" || t_class == "_left_bottom"){		
						marg_top = marg_top - 5;
					}
					if(t_class == "_left_top" || t_class == "_left_bottom"){	
						marg_left = marg_left + 5;
					}
					tiptip_arrow.css({"margin-left": arrow_left+"px", "margin-top": arrow_top+"px"});
					tiptip_holder.css({"margin-left": marg_left+"px", "margin-top": marg_top+"px"}).attr("class","tip"+t_class);
					
					tiptip_holder.show();					
				};
				
				function deactive_tiptip(){
					//opts.exit.call(this);
					tiptip_holder.hide();					
				}
			}
		});
	}
})(jQuery);  	