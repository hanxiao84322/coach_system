// JavaScript Document
$(function(){
	$(".nav li h1").click(function(){
		$(this).addClass('hover')
		$(this).siblings().slideDown();
		$(this).parent().siblings().find("h1").removeClass('hover');
		$(this).parent().siblings().find(".second_div").slideUp();

	});
	$(".nav li a").click(function(){
		$(this).addClass("hover");
	})

	$(".nrset_set li h1").click(function(){
		$(this).addClass('hover')
		$(this).siblings().slideDown();
		$(this).parent().siblings().find("h1").removeClass('hover');
		$(this).parent().siblings().find(".form_input").slideUp();

	});

	//tab
	$(".tabs .title_h42 a:first-child").addClass("hover");
		$(".tabs").each(function(){
			$(".tab_son",this).eq(0).addClass("nodis");
		});
		$(".tabs .title_h42 a").click(function(){
			var nnum = $(this).index();
			$(this).siblings().removeClass("hover");
			$(this).addClass("hover");
			var nnum = $(this).index();
			$(this).parent().siblings(".tab_son").removeClass("nodis");
			$(this).parent().siblings(".tab_son").eq(nnum).addClass("nodis");

		});

		//tab
	$(".tabs .title_h43 a:first-child").addClass("hover");
		$(".tabs").each(function(){
			$(".tab_son",this).eq(0).addClass("nodis");
		});
		$(".tabs .title_h43 a").click(function(){
			var nnum = $(this).index();
			$(this).siblings().removeClass("hover");
			$(this).addClass("hover");
			var nnum = $(this).index();
			$(this).parent().siblings(".tab_son").removeClass("nodis");
			$(this).parent().siblings(".tab_son").eq(nnum).addClass("nodis");

		});	
		
		$(".fixed_information").find(".btnBoxset").click(function(){
			$(".fixed_information").hide();
		})
		
		$(".go_add").click(function(){
			$(".fixed_information1").show();
		})

})