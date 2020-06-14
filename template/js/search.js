//Автопоиск категорий 
$(function(){
    var overlay = $(".overlay");
    //Живой поиск
    $('.who').bind("keyup input click", function() {
        if(this.value.length >= 3){
            $.ajax({
                type: 'post',
                url: "/search/category", //Путь к обработчику
                data: {'referal':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result").html(data).fadeIn(); //Выводим полученые данные в списке
					overlay.css('display', 'block');
                }
            })
        } else {
			$(".search_result").html(null).fadeOut();
			overlay.css('display', 'none');
		}
    })
    
    /*$(".search_result").hover(function(){
        $(".who").blur(); //Убираем фокус с input
    });*/
	
	$(".who").on('blur', function () {
		$(".search_result").fadeOut();
		overlay.css('display', 'none');
	});
					 

    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result").on("click", "li", function(){
        s_user = $(this).text();
        console.log(javascript_array_category[s_user]);
        window.location.replace('/category/'+ javascript_array_category[s_user]);
               $(".who").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $(".search_result").fadeOut();
    })

})

//Автопоиск товаров
$(function(){
    var overlay1 = $(".overlay1");
    //Живой поиск
    $('.who1').bind("keyup input click", function() {
        if(this.value.length >= 3){
            $.ajax({
                type: 'post',
                url: "/search/product", //Путь к обработчику
                data: {'referal1':this.value},
                response: 'text',
                success: function(data){
                    $(".search_result1").html(data).fadeIn(); //Выводим полученые данные в списке
					overlay1.css('display', 'block');
                }
            })
        } else {
			$(".search_result").html(null).fadeOut();
			overlay1.css('display', 'none');
		}
    })
    
    /*$(".search_result").hover(function(){
        $(".who").blur(); //Убираем фокус с input
    });*/
	
	$(".who1").on('blur', function () {
		$(".search_result1").fadeOut();
		overlay1.css('display', 'none');
	});
					 

    //При выборе результата поиска, прячем список и заносим выбранный результат в input
    $(".search_result1").on("click", "li", function(){
        s_user_prod = $(this).text();
        console.log(s_user_prod);
        window.location.replace('product/'+ javascript_array_prod[s_user_prod]);
               $(".who1").val(s_user).attr('disabled', 'disabled'); //деактивируем input, если нужно
        $(".search_result1").fadeOut();
    })

})