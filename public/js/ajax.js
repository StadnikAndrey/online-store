$(function(){ 

$(document).on('click', function(event){	 
// отправка формы с фильтрами на странице products
// при постраничной навигации	страницы с товарами,
 // упр. товарами админпанели, упр. заказами админпанели,упр.пользователями,
 // упр. новостями
if(event.target.classList.contains('products_pagination_input')) {
  if ($('.products_filter_form')) {
    $('.products_filter_form').submit();
  }		 
  if ($('.admin_product_form')) {
    $('.admin_product_form').submit();
  }
  if ($('.admin_orders_form')) {
  $('.admin_orders_form').submit();
  }
  if ($('.admin_users_form')) {
  $('.admin_users_form').submit();
  }
  if ($('.admin_news_form')) {
  $('.admin_news_form').submit();
  }
}

// добавление товара в корзину асинхронным запросом	
if(event.target.classList.contains('one_product_add_cart')) {	 
	$(".one_product_size_radio").each(function(){
	if($(this).prop("checked")){		 
		    $('.one_product_size_warning').removeClass('one_product_size_warning_active');
        let data = $('.one_product_size_form').serializeArray();
	      if(data) {
		       let url = '/cart/addProduct';
           $.ajax({
        	   type: 'POST',
        	   url: url,
        	   data: data,
        	   success: function(data) {        		     
        		    if(!isNaN(+data)) {
          			  $('#cart_count').text(data);
                  // предупреждение о превышение количества добавляемых товаров(вывод на стр. one_product)
                  $('#cart_warning').text('');               
        		    }
                if(data == 'warning') { 
                  $('#cart_warning').text('Вы заказали весь товар данной модели и размера который у нас есть в наличии!!!');
                }
        	    },
        	    error: function() {
        		    console.error('error');
        	    }
           });
	      }
	      return false;
	}else{
		$('.one_product_size_warning').addClass('one_product_size_warning_active');
	}
	})
}

// стилизация label при выборe размера товара
if(event.target.classList.contains('one_product_size_radio')) {	 
	$(".one_product_size_radio").each(function(){
		if($(this).prop("checked")){
           $(this).parent(".one_product_size_label").addClass('one_product_size_label_checked');
           $('.one_product_size_warning').removeClass('one_product_size_warning_active');
		}else{
		   $(this).parent(".one_product_size_label").removeClass('one_product_size_label_checked');
		}
	}) 
}

 
});

// удаление товаров из корзины
$('.cart_one_order_delete').on('click', function(event){      
    let $this = $(this);
    let key = $this.data('key');     
    if(key) {
      let url = '/cart/delete';
          $.ajax({
            type: 'POST',
            url: url,
            data: {
              key: key
            },
            success: function(data) {
              if(data ==  1) {                   
                 window.location.reload();                             
              }              
            },
            error: function() {
              console.error('error');
            }

          });
    }

});

// изменение количества товаров в корзине
$('.cart_one_order_change_count').on('click', function(e){
   let key = $(this).prev().data('key_up');
   let count = $(this).prev().val();
   if(key && !isNaN(count) && count>0 && count<99 && count != '' ) {
      let url = '/cart/update';
          $.ajax({
              type: 'POST',
              url: url,
              data: {
                key_up: key,
                count_up: count
              },
              success: function(data) {
                if(data ==  1) { 
                    window.location.reload();                                       
                }else{
                   $(e.target).next().text(`Максимальное количество ${data} шт.`);                 
                }                             
              },
              error: function() {
                console.error('error');
              }
          });
    }
})

// изменение статтуса заказа в таблице orders
$(document).on('click', function(e){    
    if (e.target.classList.contains('admin_orders_form_status_btn')) {     
          let id_form =  e.target.id;   
          let data = $('#' + id_form + "_st").serializeArray(); 
          if(data) {
              let url = '/admin/update/order';
              $.ajax({
                  type: 'POST',
                  url: url,
                  data: data,
                  success: function(data) {
                     if (data!='') {
                        let data_obj = JSON.parse(data);                 
                        // показ абзаца со ссылкой "изменено ..."
                        $('.' + id_form + '_cl').addClass('up_active');
                        // изм. даты изм. статуса в "изменено ..."
                        $('.' + id_form + '_a').text(data_obj['up_date']);
                        // изменение ссылки на админа который изменил статус
                        $('.' + id_form + '_s').attr("href", '/admin/order/manager/' + data_obj['id_man']);
                     }
                  },
                  error: function() {
                    console.error('error');
                  }
              });
          }
    }
})

// изменение в таблице users
$(document).on('click', function(e){     
    if (e.target.classList.contains('admin_user_form_up_btn')) {     
          let id_form =  e.target.id;   
          let data = $('#' + id_form + "_f").serializeArray(); 
          if(data) {
              let url = '/admin/update/user';
              $.ajax({
                  type: 'POST',
                  url: url,
                  data: data,
                  success: function(data) {
                     if (data!='') {
                      let data_obj = JSON.parse(data);
                       // показ абзаца со ссылкой "изменено ..."
                        $('.' + id_form + '_p').addClass('active');
                        // изм. даты изм. статуса в "изменено ..."
                        $('.' + id_form + '_sp').text(data_obj['up_data']);
                        // изменение ссылки на админа который изменил статус
                        $('.' + id_form + '_a').attr("href", "/admin/one/" + data_obj['id_adm']);                    
                     }               
                  },
                  error: function() {
                    console.error('error');
                  }
              });
          }
    }
})

// изменение видимости слайда при клике по checkbox
$(document).on('click', function(e){    
    if (e.target.classList.contains('adm_sl_check')) {     
          let id_form =  e.target.id;   
          let data = $('#' + id_form + "_f").serializeArray();  
          if(data) {
              let url = '/admin/slider/visibility';
              $.ajax({
                  type: 'POST',
                  url: url,
                  data: data,
                  success: function(data) {
                              
                  },
                  error: function() {
                    console.error('error');
                  }
              });
          }
    }
})

// изменение видимости рекламной карточки на главной странице при клике по checkbox
$(document).on('click', function(e){    
    if (e.target.classList.contains('adm_card_check')) {     
        let id_form =  e.target.id;   
        let data = $('#' + id_form + "_f").serializeArray();    
   
        if(data) {
          let url = '/admin/card/visibility';
          $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                        
            },
            error: function() {
              console.error('error');
            }
          });
        }
    }
})

// постраничная навигация при прокрутке страницы "Новости"
function requestPageNews(){   
    let page = 1; 
    $(document).scroll(function(){       
        // если пользователь докрутил до начала футера:
        if($(window).height() + $(window).scrollTop() >= $(document).height() - ($('footer').height()*2)){        
            page++;       
            let url = 'news/lazy/load';
            $.ajax({
                type: 'POST',
                url: url,
                data: {page_news: page},
                success: function(data) {           
                  // если данных нет - страницы закончились - удаляем отслеживание события скролла
                  if(data == ''){
                    $(document).unbind('scroll');
                  }else{                  
                    $('.content_news').append(data);              
                  }                    
                },
                error: function() {
                  console.error('error');
                }
            });
        }     
       
    }); 
}
requestPageNews();

// удаление новости
function deleteNews(){
    $(document).on('click', function(e){    
        if (e.target.classList.contains('news_delete')) {      
            let id_news =  e.target.id;         
            let data = {id_news: id_news};     
            if(data) {
                let url = '/admin/news/delete';
                $.ajax({
                  type: 'POST',
                  url: url,
                  data: data,
                  success: function(data) {
                    if(data ==  1) {                
                       window.location.reload();                                       
                      }                              
                  },
                  error: function() {
                    console.error('error');
                  }
                });
            }         
        }
    })
}
deleteNews(); 

 


});
 
    
     
 