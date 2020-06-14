$(function(){$(window).on("scroll resize",function(am){var ai=$(".cartfb");var al=$(this).scrollTop();var ak=$("#cartFooter");var ae=$("#orderSummaryLoader");var aj=$("#cartFooterScrollY").offset().top-$(window).height()+ak.height();if(al>=aj){ai.css("margin-top",0);ak.removeClass("cart-footer-fixed")
ae.addClass("sx0101")
ae.removeClass("a0a0")}else{ai.css("margin-top",ai.height()+150+"px");ak.addClass("cart-footer-fixed")
ae.removeClass("sx0101")
ae.addClass("a0a0")}});});