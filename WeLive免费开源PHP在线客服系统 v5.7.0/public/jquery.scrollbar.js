(function($) {
    $.tiny = $.tiny || { };

    $.tiny.scrollbar = {
        options: {
                axis         : 'y'    // vertical or horizontal scrollbar? ( x || y ).
            ,   wheel        : true   // enable or disable the mousewheel;
            ,   wheelSpeed   : 60     // how many pixels must the mouswheel scroll at a time.
            ,   wheelLock    : true   // return mouswheel to browser if there is no more content.
            ,   scrollInvert : false  // Enable mobile invert style scrolling
            ,   trackSize    : false  // set the size of the scrollbar to auto or a fixed number.
            ,   thumbSize    : false  // set the size of the thumb to auto or a fixed number.
        }
    };

    $.fn.welivebar = function( params )
    {
        var options = $.extend( {}, $.tiny.scrollbar.options, params );

        this.each(function()
        {
            $(this).data('tsb', new Scrollbar( $( this ), options ) );
        });

        return this;
    };

    $.fn.welivebar_update = function(sScroll)
    {
        return $( this ).data( 'tsb' ).update( sScroll );
    };

    function Scrollbar($container, options)
    {
        var self        = this
        ,   $viewport   = $container.find(".viewport")
        ,   $overview   = $container.find(".overview")
        ,   $scrollbar  = $container.find(".scb_scrollbar")
        ,   $track      = $scrollbar.find(".scb_tracker")
        ,   $thumb      = $scrollbar.find(".scb_mover")

        ,   viewportSize    = 0
        ,   contentSize     = 0
        ,   contentPosition = 0
        ,   contentRatio    = 0
        ,   trackSize       = 0
        ,   trackRatio      = 1
        ,   thumbSize       = 0
        ,   thumbPosition   = 0
        ,   mousePosition   = 0
        ,   isdraging   = 0

        ,   isHorizontal   = options.axis === 'x'
        ,   hasTouchEvents = "ontouchstart" in document.documentElement

        ,   sizeLabel = isHorizontal ? "width" : "height"
        ,   posiLabel = isHorizontal ? "left" : "top";

        function initialize()
        {
            self.update();
            setEvents();

            return self;
        }

        this.update = function(scrollTo)
        {
            sizeLabelCap    = sizeLabel.charAt(0).toUpperCase() + sizeLabel.slice(1).toLowerCase();
            viewportSize    = $viewport[0]['offset'+ sizeLabelCap];
            contentSize     = $overview[0]['scroll'+ sizeLabelCap];
			if(viewportSize <= 0) viewportSize = 1;
			if(contentSize <= 0) contentSize = 1;
			contentRatio    = viewportSize / contentSize;

            trackSize       = options.trackSize || viewportSize;
            thumbSize       = Math.min(trackSize, Math.max(0, (options.thumbSize || (trackSize * contentRatio))));
			if(thumbSize < 40) thumbSize = 40;
			if(options.thumbSize){
				var x = trackSize - thumbSize;
				if(x == 0) x = 1;
				trackRatio = (contentSize - viewportSize) / x;
			}else{
				trackRatio = contentSize / trackSize;
			}

			$overview.css("bottom", "auto"); //解决跨站调用客服, welive面板最小化后接收信息再展开时, 最新消息无法显示的问题

			if(contentRatio < 1 && !isdraging){
				switch (scrollTo)
				{
					case "bottom":
						contentPosition = contentSize - viewportSize;
						break;

					case "relative":
						contentPosition = Math.min(contentSize - viewportSize, Math.max(0, contentPosition));
						break;

					default:
						contentPosition = parseInt(scrollTo, 10) || 0;
				}
			}else{
				if($scrollbar.is(":visible"))
				{
					$viewport.width($viewport.width() + 8);
					$scrollbar.hide();
				}
			}

            setSize();
        };

        function checkshow() {
            if(contentRatio < 1 && $scrollbar.is(":hidden")) {
				$viewport.width($viewport.width() - 8);
				$scrollbar.show();
				if(!mousePosition) mousePosition = $thumb.offset()[posiLabel];
           }
        }

        function checkhide() {
			return true; //关闭自动隐藏

            if(contentRatio < 1 && $scrollbar.is(":visible"))
            {
				$viewport.width($viewport.width() + 8);
				$scrollbar.hide();
            }
        }

        function setSize()
        {
            $thumb.css(posiLabel, contentPosition / (trackRatio == 0 ? 1 : trackRatio));
            $overview.css(posiLabel, -contentPosition);
            mousePosition = $thumb.offset()[posiLabel];

            $scrollbar.css(sizeLabel, trackSize);
            $track.css(sizeLabel, trackSize);
            $thumb.css(sizeLabel, thumbSize);
        }

        function setEvents()
        {
            if(hasTouchEvents)
            {
                $viewport[0].ontouchstart = function(event)
                {
                    if(1 === event.touches.length)
                    {
                        start(event.touches[0]);
                        event.stopPropagation();
                    }
                };
            }
            else
            {
                $thumb.bind("mousedown", start);
                $track.bind("mouseup", drag);
            }

            if(options.wheel && window.addEventListener)
            {
                $container[0].addEventListener("DOMMouseScroll", wheel, false );
                $container[0].addEventListener("mousewheel", wheel, false );
            }
            else if(options.wheel)
            {
                $container[0].onmousewheel = wheel;
            }

			$container.hover(checkshow, checkhide);
        }

        function start(event)
        {
            mousePosition = isHorizontal ? event.pageX : event.pageY;
            thumbPosition = parseInt($thumb.css(posiLabel), 10) || 0;
			isdraging = 1;

            if(hasTouchEvents)
            {
                document.ontouchmove = function(event)
                {
                    event.preventDefault();
                    drag(event.touches[0]);
                };
                document.ontouchend = end;
            }
            else
            {
                $(document).bind("mousemove", drag);
                $(document).bind("mouseup", end);
                $thumb.bind("mouseup", end);
            }
        }

        function wheel(event)
        {
            if(contentRatio < 1)
            {
                var eventObject     = event || window.event,
					wheelSpeedDelta = eventObject.wheelDelta ? eventObject.wheelDelta / 120 : -eventObject.detail / 3;

                contentPosition -= wheelSpeedDelta * options.wheelSpeed;
                contentPosition = Math.min((contentSize - viewportSize), Math.max(0, contentPosition));

                $thumb.css(posiLabel, contentPosition / (trackRatio == 0 ? 1 : trackRatio));
                $overview.css(posiLabel, -contentPosition);

                if(options.wheelLock || (contentPosition !== (contentSize - viewportSize) && contentPosition !== 0))
                {
                    eventObject = $.event.fix(eventObject);
                    eventObject.preventDefault();
                }
            }
        }

        function drag( event )
        {
			window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();
            if(contentRatio < 1)
            {
                mousePositionNew   = isHorizontal ? event.pageX : event.pageY;
                thumbPositionDelta = mousePositionNew - mousePosition;

                if(options.scrollInvert)
                {
                    thumbPositionDelta = mousePosition - mousePositionNew;
                }

                thumbPositionNew = Math.min((trackSize - thumbSize), Math.max(0, thumbPosition + thumbPositionDelta));
                contentPosition  = thumbPositionNew * trackRatio;

                $thumb.css(posiLabel, thumbPositionNew);
                $overview.css(posiLabel, -contentPosition);
            }
        }

        function end()
        {
			isdraging = 0;
            $(document).unbind("mousemove", drag);
            $(document).unbind("mouseup", end);
            $thumb.unbind("mouseup", end);
            document.ontouchmove = document.ontouchend = null;
        }

        return initialize();
    }
})(jQuery);