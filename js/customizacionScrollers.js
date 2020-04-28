(function($){
			$(window).on("load",function(){
				
				var content=$("#content-1"),autoScrollTimer=4000,autoScrollTimerAdjust,autoScroll;
				
				content.mCustomScrollbar({                   
					scrollButtons:{enable:true},
					callbacks:{
						whileScrolling:function(){
							autoScrollTimerAdjust=autoScrollTimer*this.mcs.topPct/100;
						},
						onScroll:function(){ 
							if($(this).data("mCS").trigger==="internal"){AutoScrollOff();}
						}
					}
				});
				
				content.addClass("auto-scrolling-on auto-scrolling-to-bottom");
				AutoScrollOn("bottom");
                
                function AutoScrollOn(to,timer){
					if(!timer){timer=autoScrollTimer;}
					content.addClass("auto-scrolling-on").mCustomScrollbar("scrollTo",to,{scrollInertia:timer,scrollEasing:"easeInOutSmooth"});
					autoScroll=setTimeout(function(){
						if(!content.hasClass("auto-scrolling-to-top")){
							AutoScrollOn("bottom",autoScrollTimer-autoScrollTimerAdjust);
							content.removeClass("auto-scrolling-to-top").addClass("auto-scrolling-to-bottom");
						}else{
							AutoScrollOn("top",autoScrollTimerAdjust);
							content.removeClass("auto-scrolling-to-bottom").addClass("auto-scrolling-to-top");
						}
					},timer);
				}
                
				
				$(".auto-scrolling-toggle").click(function(e){
					e.preventDefault();
					if(content.hasClass("auto-scrolling-on")){
						AutoScrollOff();
					}else{
						if(content.hasClass("auto-scrolling-to-top")){
							AutoScrollOn("top",autoScrollTimerAdjust);
						}else{
							AutoScrollOn("bottom",autoScrollTimer-autoScrollTimerAdjust);
						}
					}
				});
				
				
				
				function AutoScrollOff(){
					clearTimeout(autoScroll);
					content.removeClass("auto-scrolling-on").mCustomScrollbar("stop");
				}
				
			});
		})(jQuery);
