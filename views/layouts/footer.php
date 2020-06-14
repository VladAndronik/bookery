<div class="page-buffer"></div>

</div>
    <div class="footer-bottom">
        <div class="container">

        </div>
    </div>
 </div>


<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script src="/template/js/jquery.flexislider.js"></script>
<script src="/template/js/search.js"></script>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
<script>
    //var prodId ='<?php //echo $product; ?>//';
    $(document).on('change', '.select-test-1', function() {
        var selected = $(this).val();
        var id = $(this).attr("data-id");

        $.ajax({
            url: '',
            type: 'POST',
            data: {
                action: 'myajax',
                id: id,
                postID: selected
            },
            beforeSend: function(xhr) {},
            success: function(data) {
                $('.card-item-1').html(data);
            },
            error: function() {
                alert('Error');
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
        $(".add-to-cart").click(function () {
            var id = $(this).attr("data-id");

            $.post("/cart/addAjax/"+id, {}, function (data) {
                $("#cart-count").html(data);
            });
            return false;
        });
    });
</script>

<script>
		var speed = 70;
	var pic, numImgs, arrLeft, i, totalWidth, n, myInterval; 

$(window).load(function(){
	pic = $("#slider").children("img");
	numImgs = pic.length;
	arrLeft = new Array(numImgs);
	
	for (i=0;i<numImgs;i++){
		
		totalWidth=0;
		for(n=0;n<i;n++){
			totalWidth += $(pic[n]).width();
		}
		
		arrLeft[i] = totalWidth;
		$(pic[i]).css("left",totalWidth);
	}
	
	myInterval = setInterval("flexiScroll()",speed);
	$('#imageloader').hide();
	$(pic).show();	
});

function flexiScroll(){

	for (i=0;i<numImgs;i++){
		arrLeft[i] -= 1;		

		if (arrLeft[i] == -($(pic[i]).width())){	
			totalWidth = 0;	
			for (n=0;n<numImgs;n++){
				if (n!=i){	
					totalWidth += $(pic[n]).width();
				}			
			}	
			arrLeft[i] =  totalWidth;	
		}					
		$(pic[i]).css("left",arrLeft[i]);
	}
}
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".sub > a").click(function() {
            var ul = $(this).next(),
                    clone = ul.clone().css({"height":"auto"}).appendTo(".mini-menu"),
                    height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
            clone.remove();
            ul.animate({"height":height});
            return false;
        });
           $('.mini-menu > ul > li > a').click(function(){
           $('.sub a').removeClass('active');
           $(this).addClass('active');
        }),
           $('.sub ul li a').click(function(){
           $('.sub ul li a').removeClass('active');
           $(this).addClass('active');
        });
    });
    /* ____________________________________________ */
        $(document).ready(function () {
        $(".sub_active > a").click(function() {
            var ul = $(this).next(),
                    clone = ul.clone().css({"height":"300px"}).appendTo(".mini-menu"),
                    height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
            clone.remove();
            ul.animate({"height":height});
            return false;
        });
           $('.mini-menu > ul > li > a').click(function(){
           $('.sub_active a').removeClass('active');
           $(this).addClass('active');
        }),
           $('.sub_active ul li a').click(function(){
           $('.sub_active ul li a').removeClass('active');
           $(this).addClass('active');
        });
    });

</script>


</div>
</div>  
</div>
</body>
</html>