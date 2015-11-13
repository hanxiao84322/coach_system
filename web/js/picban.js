$(document).ready(function(){
	var len=$(".tu>a").length;
	var i=0;
	var lunhuan;
	var kuan=$(window).width();
	$(".tu>a").css('width',kuan);
	$(".xu:eq(0)").css({'background':'yellow','color':'#000000'});

	function huan()
	{	
		$(".xu:eq("+i+")").css({'background':'yellow','color':'#000000'});
		$(".xu:eq("+i+")").siblings().css('background','#3b5998');
		$(".txt>em:eq("+i+")").siblings("em").fadeOut("fast");
		$(".txt>em:eq("+i+")").fadeIn("fast");
		$(".tu>a:eq("+i+")").siblings("a").fadeOut(500);
		$(".tu>a:eq("+i+")").fadeIn(500);
		i=i+1
		if(i==len)
		{i=0}
	
	}
	lunhuan=setInterval(huan,4000);
	$("#hao").find(".xu").click(function(){
		j=$(this).index();
		$(".xu:eq("+j+")").css({'background':'yellow','color':'#000000'});
		$(".xu:eq("+j+")").siblings().css('background','#3b5998');
		$(".txt>em:eq("+j+")").siblings("em").fadeOut("fast");
		$(".txt>em:eq("+j+")").fadeIn("fast");
		i=j;
		$(".tu>a:eq("+j+")").siblings("a").fadeOut(500);
		$(".tu>a:eq("+j+")").fadeIn(500);
										  
	})
	
})