function showHideMenu (){
    let header_menu_nav = document.querySelector('.header_menu_nav');
    let header_top_ship_policy = document.querySelector('.header_top_ship_policy');
    let header_top_inform =  document.querySelector('.header_top_inform');
    let gambr = document.querySelector('.header_menu_gamburger'); 

    gambr.addEventListener('click', ()=>{
      	header_menu_nav.classList.toggle('mobile');
      	header_top_ship_policy.classList.toggle('mobile');
      	if(window.matchMedia('(max-width: 560px)').matches){
           header_top_inform.classList.toggle('mobile');
        }
    });
}
showHideMenu ();

// слайдер
function showSlider(){ 
    let carusel = document.querySelector('.slider');
    let slide = document.querySelectorAll('.slide'); 

    if (carusel) {
        // генерация items в количестве=количеству слайдов 
        let ulSlider = document.querySelector('.slider_ul');
        let item = `<li class="items"></li>`;
        for (let i = 0; i < slide.length-1; i++) {
         ulSlider.insertAdjacentHTML('beforeend', item);
        }
        let items = document.querySelectorAll('.items');
        // выравнивание списка по центру 
        if (ulSlider) {
            let widthUL = ulSlider.clientWidth; 
            let ulCentr = (widthUL/2)-10;   
            ulSlider.style.left = `calc(50% - ${ulCentr}px)`; 
        }

        // смена слайдов и изменение стилей items по клику 
        items.forEach(function(li, i) {
          li.addEventListener("click", function() {
            for (let j = 0; j < slide.length; j++) {
              if (slide[j].classList.contains('slider_slide_active')) { 
                slide[j].classList.remove('slider_slide_active');
              }
            }
            slide[i].classList.add('slider_slide_active');

            for (let i = 0; i < items.length; i++) {
              if (items[i].classList.contains('slider_items_active')) { 
                items[i].classList.remove('slider_items_active'); 

              }
            }     
            items[i].classList.add('slider_items_active');
          });
        }); 

        // автоматическая смена слайдов и изменение стилей items       
        let count = 0;
        setInterval(function (){    
            // если слайд выбран кликом по items - смена слайдов начнется от выбранного слайда;
            // если не выбран - с первого
            for (let j = 0; j < slide.length; j++) {
              if (slide[j].classList.contains('slider_slide_active')) { 
                count = j;
              }
            }
            count++; 
            
            slide[count-1].classList.remove('slider_slide_active');
            items[count-1].classList.remove('slider_items_active');
            if (count > slide.length-1 ) {
                count = 0;
            }   
            slide[count].classList.add('slider_slide_active'); 
            items[count].classList.add('slider_items_active');         
        },10000);  

    } 
} 
showSlider(); 

// кнопка наверх
function scrolScreen(){
	  let upBtn = document.querySelector('.up_button');
	  upBtn.addEventListener('click',function backToTop (){
      if (window.pageYOffset > 0) { 
        window.scrollBy(0, -50);
        setTimeout(backToTop, 0);
      }
    })	 
}
scrolScreen();

// появление/скрытие фильтра .left_filter
function showFilterProducts(){
	let btn = document.querySelector('.btn_show_left_filter'); 
	let filter = document.querySelector('.left_filter');
  if (btn) {
      btn.addEventListener('click',function(){     
          filter.classList.toggle("left_filter_activ");
          setTimeout(function(){
             btn.classList.toggle("btn_show_left_filter_active");
          },100);     
          if (btn.innerHTML=='Показать фильтр') {
              setTimeout(function(){
                btn.innerHTML = 'Скрыть фильтр';
              },100);      
          }else if(btn.innerHTML == 'Скрыть фильтр'){
              btn.innerHTML= 'Показать фильтр';
          }     
      });
  } 
} 
showFilterProducts(); 

// поведение элементов формы-фильтра
function filterForm(){
    let btn = document.querySelector('.btn_products_filter_form');   
    let input = document.querySelector('input[type=checkbox]');
    document.body.addEventListener('click',function(e){
        // изменение стилей label left_filter  при клике
        if (e.target.classList.contains('left_filter_label')) {
            e.target.classList.toggle('left_filter_label_active');
        } 
        // перемещение кнопки 'применить' формы фильтра на большом экране 
        if(window.matchMedia('(min-width: 970px)').matches){
            if(e.target.classList.contains('filter')){ 
              btn.classList.add('btn_products_filter_form_active');   
              btn.style.left = '22%';
              btn.style.top = e.target.offsetTop + 'px';
            }
        }
        // кнопка 'применить' на маленьких экранах
        if(window.matchMedia('(max-width: 970px)').matches){
            if (e.target.classList.contains('btn_show_left_filter')) {
              btn.classList.toggle('btn_products_filter_form_active');
            }      
        }    
    })

    // запрет ввода в поля поиска по цене любых символов кроме цифр
    let inpMinPrice = document.querySelector('.left_filter input[name="minPrice"]');
    let inpMaxPrice = document.querySelector('.left_filter input[name="maxPrice"]'); 
    if (inpMinPrice) {
            inpMinPrice.addEventListener('input',function(e){
                if (/[^0-9]/g.test(inpMinPrice.value) || /[0-9]{8,}/g.test(inpMinPrice.value)) { 
                    inpMinPrice.value = inpMinPrice.value.replace(/\D/g, "" ); 
                    inpMinPrice.value = inpMinPrice.value.replace(/[0-9]{8,}/g, "" );           
                }
            })
        inpMaxPrice.addEventListener('input',function(e){
                if (/[^0-9]/g.test(inpMaxPrice.value) || /[0-9]{8,}/g.test(inpMaxPrice.value)) { 
                    inpMaxPrice.value = inpMaxPrice.value.replace(/\D/g, "" ); 
                    inpMaxPrice.value = inpMaxPrice.value.replace(/[0-9]{8,}/g, "" );           
                }
        })
    }     
}
filterForm();

 

// показ/скрытие детальной информации о товаре (one_product)
function showDetailsProduct(){
let target = document.querySelector('.one_product_details');
let result = document.querySelector('.one_product_screen_details');
let arrTitle = document.querySelectorAll('.one_product_details_title');
let firstBlock = document.querySelector('.one_product_details_first'); 
let arrInfo = document.querySelectorAll('.one_product_details_info'); 
if (result || target) {
  result.innerHTML = firstBlock.innerHTML;
  target.addEventListener('click',function(e){
   if(window.matchMedia('(min-width: 700px)').matches){
     if (e.target.classList.contains('one_product_details_title')) {
       for (let i = 0; i < arrTitle.length; i++) {
          if (arrTitle[i].classList.contains('one_product_details_title_active')) {
             arrTitle[i].classList.remove('one_product_details_title_active');
          }
       }
       e.target.classList.add('one_product_details_title_active');
       result.innerHTML = e.target.nextElementSibling.innerHTML;
      }
   }else{       
      if (e.target.classList.contains('one_product_details_title')) {
        for (let i = 0; i < arrInfo.length; i++) {
          if (!e.target.nextElementSibling.classList.contains('one_product_details_info_active')&&
            arrTitle[i].nextElementSibling.classList.contains('one_product_details_info_active')) {
            arrTitle[i].nextElementSibling.classList.remove('one_product_details_info_active');
          }       
        }   
        e.target.nextElementSibling.classList.toggle('one_product_details_info_active');
      }       
   } 
   
})
}   
 
}
showDetailsProduct();

// адаптив 825px
function adaptiveOneProroductCharacteristic(){
  let media = document.querySelector('.one_product_characteristic_media_js');
  let main = document.querySelector('.one_product_characteristic_container_name');
  if (main&&media) {
    media.innerHTML = main.innerHTML;
  }   
}
adaptiveOneProroductCharacteristic(); 

// адаптив корзины
function adaptiveCart(){
  let price = document.querySelectorAll('.cart_one_order_price');
  let priceAdaptive = document.querySelectorAll('.cart_one_order_price_adaptiv');
  let name = document.querySelectorAll('.cart_one_order_info_name');
  let nameAdaptive = document.querySelectorAll('.cart_one_order_info_name_adaptive');
  let articul = document.querySelectorAll('.cart_one_order_info_articul');
  let articulAdaptive = document.querySelectorAll('.cart_one_order_info_articul_adaptive');
  if (price && name && articul && priceAdaptive && nameAdaptive && articulAdaptive) {
    for (let i = 0; i < price.length; i++) {
      priceAdaptive[i].innerHTML = price[i].innerHTML;
      nameAdaptive[i].innerHTML = name[i].innerHTML;
      articulAdaptive[i].innerHTML = articul[i].innerHTML;
    }
       
  }
   
}
adaptiveCart();

// ввод только чисел в поле изменения количества товаров корзины и 
// появление 'изменить' корзины при изменении количества товаров
function showChangeCountCart(){
  let input = document.querySelectorAll('.cart_one_order_change_input');
  let change = document.querySelectorAll('.cart_one_order_change_count');
  if (input) {
    for (let i = 0; i < input.length; i++) {     
    input[i].addEventListener('input',function(e){        
      if (/^[0-99]{1,2}$/g.test(input[i].value) && /^(?!0)/g.test(input[i].value)) {
        change[i].classList.add('cart_one_order_change_count_active');              
      }else{
         change[i].classList.remove('cart_one_order_change_count_active');
         input[i].value = input[i].value.replace(/\D/g, "" ); 
         input[i].value = input[i].value.replace(/^0/g, "" ); 
      }       
  });
  }
  }   
} 
showChangeCountCart();

// валидация формы регистрации
function checkRegistration(){
    let form = document.querySelector('.registration_form');
    // let submit = document.querySelector('.registration_btn_submit');
    if (form) {
      form.addEventListener('submit',function(e){ 
    let error = false;      
      // имя
      if (!/^[а-яА-я\s-]{1,20}$/g.test(r_name.value.trim()) || r_name.value.trim() == '') {         
        r_name.parentElement.nextElementSibling.classList.add('error_active');
         r_name.classList.add('input_red'); 
         error =true;                 
      }else{
        r_name.parentElement.nextElementSibling.classList.remove('error_active');
         r_name.classList.remove('input_red');          
      }
      // отчество  
      if (!/^[а-яА-я\s-]{1,20}$/g.test(r_patronymic.value.trim()) || r_patronymic.value.trim() == '') {
        r_patronymic.parentElement.nextElementSibling.classList.add('error_active');
         r_patronymic.classList.add('input_red'); 
         error =true;                 
      }else{
         r_patronymic.parentElement.nextElementSibling.classList.remove('error_active');
         r_patronymic.classList.remove('input_red');           
      }
      // фамилия  
      if (!/^[а-яА-я\s-]{1,20}$/g.test(r_surname.value.trim()) || r_surname.value.trim() == '') {
        r_surname.parentElement.nextElementSibling.classList.add('error_active');
         r_surname.classList.add('input_red'); 
         error =true;                 
      }else{
         r_surname.parentElement.nextElementSibling.classList.remove('error_active');
         r_surname.classList.remove('input_red');         
      }
      // номер мобильного телефона
      if (!/^(((\+38){0,1}|(38){0,1}|(8){0,1})([0-9]){10})$/g.test(r_mob_num.value.trim()) || r_mob_num.value.trim() == '') {
        r_mob_num.parentElement.nextElementSibling.classList.add('error_active');
         r_mob_num.classList.add('input_red'); 
         error =true;                 
      }else{
         r_mob_num.parentElement.nextElementSibling.classList.remove('error_active');
         r_mob_num.classList.remove('input_red');         
      }
      // e-mail
      if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/gi.test(r_email.value.trim()) || r_email.value.trim() == '') {
        r_email.parentElement.nextElementSibling.classList.add('error_active');
         r_email.classList.add('input_red'); 
         error =true;                 
      }else{
         r_email.parentElement.nextElementSibling.classList.remove('error_active');
         r_email.classList.remove('input_red');         
      }
      // пароль
      if (!/^[0-9a-zA-Z-_*]{6,20}$/g.test(r_pass.value.trim()) || r_pass.value.trim() == '') {
        r_pass.parentElement.nextElementSibling.classList.add('error_active');
         r_pass.classList.add('input_red'); 
         error =true;                 
      }else{
         r_pass.parentElement.nextElementSibling.classList.remove('error_active');
         r_pass.classList.remove('input_red');         
      }
      // подтверждение пароля
      if (r_pass_confirm.value != r_pass.value.trim()) {
        r_pass_confirm.parentElement.nextElementSibling.classList.add('error_active');
         r_pass_confirm.classList.add('input_red'); 
         error =true;                 
      }else{
         r_pass_confirm.parentElement.nextElementSibling.classList.remove('error_active');
         r_pass_confirm.classList.remove('input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
    })
    }
     
}
checkRegistration();  

// форма страницы оформления заказа
function checkoutForm(){
  let form = document.querySelector('.checkout_form');
  let divOffice = document.querySelector('.checkout_delivery_number');
  let divAdres = document.querySelector('.checkout_delivery_adres');
  let result = document.querySelector('.checkout_delivery_result');  
  if (result || form) {
    if (check_office.checked) {
      result.innerHTML = divOffice.innerHTML;       
    }
    if (check_courier.checked) {
      result.innerHTML = divAdres.innerHTML;       
    }
    
    form.addEventListener('click',function(e){
      // отображение поля для выбора номера отделения
      if (e.target.classList.contains('post_office_label')) {
         result.innerHTML = divOffice.innerHTML;
      }
      // отображение полей для адреса доставки курьером
      if (e.target.classList.contains('delivery_courier_label')) {
         result.innerHTML = divAdres.innerHTML;
      }
      // отображение textarea комментариев
      let review = document.querySelector('.review_row');
      if (e.target.classList.contains('checkout_review_title')) {
          review.classList.toggle('review_row_activ');
          if (review.classList.contains('review_row_activ')) {
            e.target.innerHTML = 'Скрыть комментарии к заказу';
          }else{
            e.target.innerHTML = 'Добавить комментарий к заказу';
          }       
      }
    })
    // запрет ввода в textarea скобок
    let checkTextAr = document.querySelector('  textarea[name="ch_comment"]');   
    checkTextAr.addEventListener('input',function(e){
      if (/[<>]{1,1020}/gi.test(checkTextAr.value)) {
        checkTextAr.value =  checkTextAr.value.replace(/[<>]{1,1020}/gi, "" );       
      }
    })
  }   
}
checkoutForm();

// валидация формы оформления заказа
function checkCheckoutForm(){
    let form = document.querySelector('.checkout_form');
    // let submit = document.querySelector('.checkout_btn_submit');
    if (form) {
      form.addEventListener('submit',function(e){ 
        let error = false; 
      // фамилия  
      if (!/^[а-яА-я-]{1,50}$/gi.test(check_surname.value.trim()) || check_surname.value.trim() == '') {
        check_surname.nextElementSibling.classList.add('error_active');
         check_surname.classList.add('input_red'); 
         error =true;                 
      }else{
         check_surname.nextElementSibling.classList.remove('error_active');
         check_surname.classList.remove('input_red');         
      }     
      // имя
      if (!/^[а-яА-я-]{1,50}$/gi.test(check_name.value.trim()) || check_name.value.trim() == '') {
        check_name.nextElementSibling.classList.add('error_active');
         check_name.classList.add('input_red'); 
         error =true;                 
      }else{
         check_name.nextElementSibling.classList.remove('error_active');
         check_name.classList.remove('input_red');         
      }     
      // // отчество  
      if (!/^[а-яА-я-]{1,50}$/gi.test(check_patronymic.value.trim()) || check_patronymic.value.trim() == '') {
        check_patronymic.nextElementSibling.classList.add('error_active');
         check_patronymic.classList.add('input_red'); 
         error =true;                 
      }else{
         check_patronymic.nextElementSibling.classList.remove('error_active');
         check_patronymic.classList.remove('input_red');         
      }       
      // // номер мобильного телефона
      if (!/^(((\+38){0,1}|(38){0,1}|(8){0,1})([0-9]){10})$/g.test(check_mob_num.value.trim()) || check_mob_num.value.trim() == '') {
        check_mob_num.nextElementSibling.classList.add('error_active');
         check_mob_num.classList.add('input_red'); 
         error =true;                 
      }else{
         check_mob_num.nextElementSibling.classList.remove('error_active');
         check_mob_num.classList.remove('input_red');         
      }
      // // e-mail
      if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/gi.test(check_email.value.trim()) || check_email.value.trim() == '') {
        check_email.nextElementSibling.classList.add('error_active');
         check_email.classList.add('input_red'); 
         error =true;                 
      }else{
         check_email.nextElementSibling.classList.remove('error_active');
         check_email.classList.remove('input_red');         
      }
      // город
      if (!/^[а-яА-я-\s]{1,50}$/gi.test(check_city.value.trim()) || check_city.value.trim() == '') {
        check_city.nextElementSibling.classList.add('error_active');
         check_city.classList.add('input_red'); 
         error =true;                 
      }else{
         check_city.nextElementSibling.classList.remove('error_active');
         check_city.classList.remove('input_red');         
      }    
      // область
      if (!/^[а-яА-я-\s]{1,50}$/gi.test(check_region.value.trim()) || check_region.value.trim() == '') {
        check_region.nextElementSibling.classList.add('error_active');
         check_region.classList.add('input_red'); 
         error =true;                 
      }else{
         check_region.nextElementSibling.classList.remove('error_active');
         check_region.classList.remove('input_red');         
      }    
      // район
      if (!/^[а-яА-я-\s]{0,50}$/gi.test(check_district.value.trim())) {
         check_district.nextElementSibling.classList.add('error_active');
         check_district.classList.add('input_red'); 
         error =true;                 
      }else{
         check_district.nextElementSibling.classList.remove('error_active');
         check_district.classList.remove('input_red');         
      } 
      // служба доставки
      let optionArr =document.querySelectorAll('.checkout_select option');   
      if (optionArr[0].selected) {          
         optionArr[0].parentElement.nextElementSibling.classList.add('error_active');
         optionArr[0].parentElement.classList.add('input_red'); 
         error =true;
      }else{         
         optionArr[0].parentElement.nextElementSibling.classList.remove('error_active');
         optionArr[0].parentElement.classList.remove('input_red');         
         } 
      // доставка в отделение     
      if (check_office.checked) {
        // номер отделения
        let numOf = document.querySelector('.checkout_delivery_result input[name="ch_post_office_number"]');    
        if (!/^[0-9/]{1,4}[а-яА-Я]{0,2}$/g.test(numOf.value.trim()) || numOf.value.trim() == '') {
         numOf.nextElementSibling.classList.add('error_active');
         numOf.classList.add('input_red'); 
         error =true;                     
        }else{
         numOf.nextElementSibling.classList.remove('error_active');
         numOf.classList.remove('input_red');              
         } 
      }
      // доставка курьером
      if (check_courier.checked) {
          // улица
          let courierStreet = document.querySelector('.checkout_delivery_result input[name="ch_street"]');
          if (!/^[а-яА-я0-9-\s]{1,20}$/gi.test(courierStreet.value.trim()) || courierStreet.value.trim() == '') {
             courierStreet.nextElementSibling.classList.add('error_active');
             courierStreet.classList.add('input_red'); 
             error =true;                 
          }else{
             courierStreet.nextElementSibling.classList.remove('error_active');
             courierStreet.classList.remove('input_red');         
          }
          // номер дома
          let courierHouseNum = document.querySelector('.checkout_delivery_result input[name="ch_house_number"]');
          if (!/^[0-9-/]{1,5}[а-яА-Я/]{0,2}[0-9]{0,3}$/gi.test(courierHouseNum.value.trim()) || courierHouseNum.value.trim() == '') {
             courierHouseNum.nextElementSibling.classList.add('error_active');
             courierHouseNum.classList.add('input_red'); 
             error =true;                 
          }else{
             courierHouseNum.nextElementSibling.classList.remove('error_active');
             courierHouseNum.classList.remove('input_red');         
          }
          // номер квартиры 
          let courierApartNum = document.querySelector('.checkout_delivery_result input[name="ch_apartment_number"]');
          if (!/^[0-9-/]{1,5}[а-яА-Я/]{0,2}[0-9]{0,3}$/gi.test(courierApartNum.value.trim()) || courierApartNum.value.trim() == '') {
             courierApartNum.nextElementSibling.classList.add('error_active');
             courierApartNum.classList.add('input_red'); 
             error =true;                 
          }else{
             courierApartNum.nextElementSibling.classList.remove('error_active');
             courierApartNum.classList.remove('input_red');         
          }           
        }      

        if(error){
              e.preventDefault();
          }  
       })
    }
}
checkCheckoutForm();
// кабинет пользователя
function cabinetUser(){
    let container = document.querySelector('.wrap_cabinet');
    if (container) {
        container.addEventListener('click',function(e){       
            // показ/скрытие деталей заказа
            if (e.target.classList.contains('cab_one_order_hide_details')) {
                e.target.parentElement.nextElementSibling.classList.toggle('cabinet_one_order_wrap_activ'); 
                e.target.innerHTML = 'Скрыть'; 
                if (!e.target.parentElement.nextElementSibling.classList.contains('cabinet_one_order_wrap_activ')) {
                    e.target.innerHTML = 'Детали';
                }
            }    
        })
    }   
}
cabinetUser();

// личный кабинет: страница профиль пользователя
function cabinetProfile(){
  let container = document.querySelector('.cabinet_profile');
  let formChangePass = document.querySelector('.cabinet_profile_change_pass_form');
  let wrapEditing = document.querySelector('.cabinet_profile_editing_wrap');
  let wrapProfInform = document.querySelector('.cabinet_profile_inform');
  if (container) {
     // для корректного показа/скрытия формы редактирования данных пользователя 
    if (wrapEditing.classList.contains('cabinet_profile_form_active')) {
      document.querySelector('.cabinet_profile_editing_in').innerHTML = 'Отменить редактирование';       
    } 
     // для корректного показа/скрытия формы изменения пароля       
    if (formChangePass.classList.contains('cabinet_profile_form_active')) {
      document.querySelector('.cabinet_profile_change_pass_title').innerHTML = 'Отменить';       
    }     
      container.addEventListener('click',function(e){
    // показ/скрытие формы изменения пароля
    if (e.target.classList.contains('cabinet_profile_change_pass_title')) {         
        if (e.target.innerHTML == 'Отменить') {
          formChangePass.classList.remove('cabinet_profile_form_active');
          e.target.innerHTML = 'Изменить пароль';
        }else{
          formChangePass.classList.add('cabinet_profile_form_active');
        e.target.innerHTML = 'Отменить';
        }         
    }
    // показ/скрытие формы редактирования данных пользователя      
    if (e.target.classList.contains('cabinet_profile_editing_in')) { 
        if (e.target.innerHTML == 'Отменить редактирование') {
          wrapEditing.classList.remove('cabinet_profile_form_active');
          wrapProfInform.classList.remove('cabinet_profile_form_none');
          e.target.innerHTML = 'Редактировать данные';
        }else{
          wrapEditing.classList.add('cabinet_profile_form_active');
          wrapProfInform.classList.add('cabinet_profile_form_none');           
          e.target.innerHTML = 'Отменить редактирование';
        }         
    }
    // скрытие абзацев с ошибками если пользователь решил отменить изменение пароля
    if (document.querySelector('.cabinet_profile_change_pass_title').innerHTML == 'Изменить пароль') {
      if (document.querySelector('.cabinet_profile_change_pass_error')) {
        document.querySelector('.cabinet_profile_change_pass_error').classList.add('cabinet_profile_form_none');
      }             
    }

  })
      // разблокировка кнопки формы редактирования данных пользователя
      let inpEdit = document.querySelectorAll('.cabinet_profile_editing_form input'); 
      let selectEdit = document.querySelectorAll('.cabinet_profile_editing_form select');     
      let btnEdit = document.querySelector('.btn_prof_edit');
      // разблокировка при вводе
       for (let i = 0; i < inpEdit.length; i++) {
            inpEdit[i].addEventListener('input',function(e){
            btnEdit.removeAttribute('disabled'); 
            btnEdit.classList.add('cabinet_profile_editing_opacity_btn');            
           })           
       }
       // разблокировка при выборе значения выпадающего списка
       for (let i = 0; i < selectEdit.length; i++) {             
          selectEdit[i].addEventListener('change',function(e){
            btnEdit.removeAttribute('disabled'); 
            btnEdit.classList.add('cabinet_profile_editing_opacity_btn');  
          })
       }

       // разблокировка кнопки формы изменения пароля
      let inpChPass = document.querySelectorAll('.cabinet_profile_change_pass_form input');            
      let btnChPass = document.querySelector('.btn_prof_ch_pass');
      // разблокировка при вводе старого пароля        
      inpChPass[0].addEventListener('input',function(e){
        btnChPass.removeAttribute('disabled'); 
        btnChPass.classList.add('cabinet_profile_editing_opacity_btn');            
      })           
        

  }  
   
}
cabinetProfile();

// валидация формы редактирования данных пользователя
function checkEditDataUser(){
  let form = document.querySelector('.cabinet_profile_editing_form');
    // let submit = document.querySelector('.btn_prof_edit');
    if (form) {
      form.addEventListener('submit',function(e){ 
    let error = false; 
     // фамилия  
      if (!/^[а-яА-я\s-]{1,20}$/g.test(p_edit_surname.value.trim()) || p_edit_surname.value.trim() == '') {
        p_edit_surname.parentElement.nextElementSibling.classList.add('error_active');
         p_edit_surname.classList.add('input_red'); 
         error =true;                 
      }else{
         p_edit_surname.parentElement.nextElementSibling.classList.remove('error_active');
         p_edit_surname.classList.remove('input_red');         
      }     
      // имя
      if (!/^[а-яА-я\s-]{1,20}$/g.test(p_edit_name.value.trim()) || p_edit_name.value.trim() == '') {         
        p_edit_name.parentElement.nextElementSibling.classList.add('error_active');
         p_edit_name.classList.add('input_red'); 
         error =true;                 
      }else{
        p_edit_name.parentElement.nextElementSibling.classList.remove('error_active');
         p_edit_name.classList.remove('input_red');          
      }
      // отчество  
      if (!/^[а-яА-я\s-]{1,20}$/g.test(p_edit_patronymic.value.trim()) || p_edit_patronymic.value.trim() == '') {
        p_edit_patronymic.parentElement.nextElementSibling.classList.add('error_active');
         p_edit_patronymic.classList.add('input_red'); 
         error =true;                 
      }else{
         p_edit_patronymic.parentElement.nextElementSibling.classList.remove('error_active');
         p_edit_patronymic.classList.remove('input_red');           
      }
      
      // номер мобильного телефона
      if (!/^(((\+38){0,1}|(38){0,1}|(8){0,1})(0){1}([0-9]){9})$/g.test(p_edit_mob_num.value.trim()) || p_edit_mob_num.value.trim() == '') {
        p_edit_mob_num.parentElement.nextElementSibling.classList.add('error_active');
         p_edit_mob_num.classList.add('input_red'); 
         error =true;                 
      }else{
         p_edit_mob_num.parentElement.nextElementSibling.classList.remove('error_active');
         p_edit_mob_num.classList.remove('input_red');         
      }
      // e-mail
      if (!/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/gi.test(p_edit_email.value.trim()) || p_edit_email.value.trim() == '') {
         p_edit_email.parentElement.nextElementSibling.classList.add('error_active');
         p_edit_email.classList.add('input_red'); 
         error =true;                 
      }else{
         p_edit_email.parentElement.nextElementSibling.classList.remove('error_active');
         p_edit_email.classList.remove('input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
    })
    }

}
checkEditDataUser();

// валидация формы изменения пароля пользователя
function checkProfileChangePassForm(){
    let form = document.querySelector('.cabinet_profile_change_pass_form');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // старый пароль
      if (!/^[0-9a-zA-Z-_*]{6,20}$/g.test(p_ch_old_pass.value.trim()) || p_ch_old_pass.value.trim() == '') {
        p_ch_old_pass.parentElement.nextElementSibling.classList.add('error_active');
         p_ch_old_pass.classList.add('input_red'); 
         error =true;                 
      }else{
         p_ch_old_pass.parentElement.nextElementSibling.classList.remove('error_active');
         p_ch_old_pass.classList.remove('input_red');         
      }
      // новый пароль       
      if (!/^[0-9a-zA-Z-_*]{6,20}$/g.test(p_ch_new_pass.value.trim()) || p_ch_new_pass.value.trim() == '') {
        p_ch_new_pass.parentElement.nextElementSibling.classList.add('error_active');
         p_ch_new_pass.classList.add('input_red'); 
         error =true;                 
      }else{
         p_ch_new_pass.parentElement.nextElementSibling.classList.remove('error_active');
         p_ch_new_pass.classList.remove('input_red');         
      }
      // подтверждение пароля
      if (p_ch_new_pass_confirm.value != p_ch_new_pass.value.trim()) {
        p_ch_new_pass_confirm.parentElement.nextElementSibling.classList.add('error_active');
         p_ch_new_pass_confirm.classList.add('input_red'); 
         error =true;                 
      }else{
         p_ch_new_pass_confirm.parentElement.nextElementSibling.classList.remove('error_active');
         p_ch_new_pass_confirm.classList.remove('input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
    })
    }
}
checkProfileChangePassForm();

// админпанель страница управления товарами
function showAdminProductsFilter(){
  let title = document.querySelector('.admin_rigt_filter_title');
  let formFilter = document.querySelector('.admin_product_form_filter');
  if (title) {
    // показ/скрытие формы-фильтра
  title.addEventListener('click', function(e){
      e.target.classList.toggle('admin_product_form_active');
      formFilter.classList.toggle('admin_product_form_active');
      if (formFilter.classList.contains('admin_product_form_active')) {
        title.innerHTML = 'Скрыть фильтр';
      }else{
        title.innerHTML = 'Фильтр';
      }
  })
}
  // показ/скрытие меню администратора
  let menuTitle = document.querySelector('.admin_left_togle');
  let adminMenu = document.querySelector('.admin_left_menu');
  if (menuTitle) {
    menuTitle.addEventListener('click', function(e){
       e.target.classList.toggle('admin_left_togle_arrow_up');
      adminMenu.classList.toggle('admin_left_menu_active');
      if (adminMenu.classList.contains('admin_left_menu_active')) {
        menuTitle.innerHTML = 'Скрыть ';
      }else{
        menuTitle.innerHTML = 'Меню администратора';
      }
  })
  }   
  // запрет ввода в поля поиска по цене любых символов кроме цифр
  let inpMin = document.querySelector('.admin_rigt input[name="adm_filter_min_price"]');
  let inpMax = document.querySelector('.admin_rigt input[name="adm_filter_max_price"]'); 
  if (inpMin) {
      inpMin.addEventListener('input',function(e){
    if (/[^0-9]/g.test(inpMin.value) || /[0-9]{8,}/g.test(inpMin.value)) { 
         inpMin.value = inpMin.value.replace(/\D/g, "" ); 
         inpMin.value = inpMin.value.replace(/[0-9]{8,}/g, "" );           
      }
  })
  inpMax.addEventListener('input',function(e){
    if (/[^0-9]/g.test(inpMax.value) || /[0-9]{8,}/g.test(inpMax.value)) { 
         inpMax.value = inpMax.value.replace(/\D/g, "" ); 
         inpMax.value = inpMax.value.replace(/[0-9]{8,}/g, "" );           
      }
  })
  }    
}
showAdminProductsFilter();

// валидация формы добавления товара
function checkFormInsertProduct(){
    let form = document.querySelector('.admin_insert_form');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // категория
      if (a_i_cat.value.trim() == '') {
        a_i_cat.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_cat.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_cat.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_cat.classList.remove('admin_insert_input_red');         
      }
      // название товара
      if (a_i_name.value.trim() == '') {
        a_i_name.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_name.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_name.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_name.classList.remove('admin_insert_input_red');         
      }

      // тип товара
      if (a_i_subcat.value.trim() == '') {
        a_i_subcat.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_subcat.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_subcat.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_subcat.classList.remove('admin_insert_input_red');         
      }

      // модель товара
      if (a_i_model.value.trim() == '') {
        a_i_model.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_model.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_model.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_model.classList.remove('admin_insert_input_red');         
      }

      // бренд товара
      if (a_i_brand.value.trim() == '') {
        a_i_brand.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_brand.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_brand.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_brand.classList.remove('admin_insert_input_red');         
      }

      // артикул товара
      if (a_i_code.value.trim() == '') {
        a_i_code.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_code.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_code.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_code.classList.remove('admin_insert_input_red');         
      }

      // цена товара
      if (a_i_price.value.trim() == '' || /[^0-9]/g.test(a_i_price.value.trim())) {
        a_i_price.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_price.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_price.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_price.classList.remove('admin_insert_input_red');         
      }

      // описание товара
      if (a_i_desc.value.trim() == '' || /[<>]/gi.test(a_i_desc.value.trim())) {
        a_i_desc.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_desc.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_desc.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_desc.classList.remove('admin_insert_input_red');         
      }

      // фотографии товара
      if (a_i_img.value.trim() == '') {
        a_i_img.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_img.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_img.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_img.classList.remove('admin_insert_input_red');         
      }

      // детальное описание товара
      if (a_i_details.value.trim() == '' || /[<>]/gi.test(a_i_details.value.trim())) {
        a_i_details.parentElement.nextElementSibling.classList.add('admin_insert_error_active');
         a_i_details.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         a_i_details.parentElement.nextElementSibling.classList.remove('admin_insert_error_active');
         a_i_details.classList.remove('admin_insert_input_red');         
      }

      // количество товара определенного размера
      let selectQuantity = document.querySelectorAll('select[name="adm_insert_quantity_product[]"]');
      let sumSelect = 0;
      for (let i = 0; i < selectQuantity.length; i++) {
        sumSelect += selectQuantity[i].value;
      }
      if (sumSelect == 0) {
        wr_ins_qa_prod.nextElementSibling.classList.add('admin_insert_error_active');
         wr_ins_qa_prod.classList.add('admin_insert_input_red'); 
         error =true;                 
      }else{
         wr_ins_qa_prod.nextElementSibling.classList.remove('admin_insert_error_active');
         wr_ins_qa_prod.classList.remove('admin_insert_input_red');         
      }
       

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertProduct();

// валидация формы редактирования товара
function checkFormUpdateProduct(){
    let form = document.querySelector('.admin_update_form');     
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // категория
      if (a_up_category.value.trim() == '') {
        a_up_category.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_category.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_category.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_category.classList.remove('admin_update_input_red');         
      }
      // название товара
      if (a_up_name.value.trim() == '') {
        a_up_name.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_name.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_name.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_name.classList.remove('admin_update_input_red');         
      }

      // тип товара
      if (a_up_subcategory.value.trim() == '') {
        a_up_subcategory.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_subcategory.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_subcategory.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_subcategory.classList.remove('admin_update_input_red');         
      }

      // модель товара
      if (a_up_model.value.trim() == '') {
        a_up_model.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_model.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_model.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_model.classList.remove('admin_update_input_red');         
      }

      // бренд товара
      if (a_up_barand.value.trim() == '') {
        a_up_barand.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_barand.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_barand.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_barand.classList.remove('admin_update_input_red');         
      }

      // артикул товара
      if (a_up_code.value.trim() == '') {
        a_up_code.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_code.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_code.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_code.classList.remove('admin_update_input_red');         
      }

      // цена товара
      if (a_up_price.value.trim() == '' || /[^0-9]/g.test(a_up_price.value)) {
        a_up_price.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_price.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_price.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_price.classList.remove('admin_update_input_red');         
      }

      // описание товара
      if (a_up_description.value.trim() == '' || /[<>]/gi.test(a_up_description.value.trim())) {
        a_up_description.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_description.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_description.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_description.classList.remove('admin_update_input_red');         
      }      

      // детальное описание товара
      if (a_up_details.value.trim() == '' || /[<>]/gi.test(a_up_details.value.trim())) {
        a_up_details.parentElement.nextElementSibling.classList.add('admin_update_error_active');
         a_up_details.classList.add('admin_update_input_red'); 
         error =true;                 
      }else{
         a_up_details.parentElement.nextElementSibling.classList.remove('admin_update_error_active');
         a_up_details.classList.remove('admin_update_input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateProduct();

// разблокировка кнопки формы редактирования товара в админпанели после изменения значений полей
function unlockedBtnUpdateProduct(){
      let inpUp = document.querySelectorAll('.admin_update_form  input'); 
      let selectUp = document.querySelectorAll('.admin_update_form select');  
      let taUp = document.querySelectorAll('.admin_update_form textarea');     
      let btnUp = document.querySelector('.admin_update_form_btn_submit');
      if (inpUp) {
        // разблокировка при вводе в input
       for (let i = 0; i < inpUp.length; i++) {
            inpUp[i].addEventListener('input',function(e){
            btnUp.removeAttribute('disabled'); 
            btnUp.classList.add('admin_update_editing_opacity_btn');            
           })           
       }
        // разблокировка при вводе в textarea
       for (let i = 0; i < taUp.length; i++) {
            taUp[i].addEventListener('input',function(e){
            btnUp.removeAttribute('disabled'); 
            btnUp.classList.add('admin_update_editing_opacity_btn');            
           })           
       }
       // разблокировка при выборе значения выпадающего списка
       for (let i = 0; i < selectUp.length; i++) {             
          selectUp[i].addEventListener('change',function(e){
            btnUp.removeAttribute('disabled'); 
            btnUp.classList.add('admin_update_editing_opacity_btn');  
          })
       }
      }
}
unlockedBtnUpdateProduct();

// валидация формы добавления бренда и отображение сообщений: об успешном добавлении бренда; ошибки
function checkFormInsertBrand(){
  let form = document.querySelector('.admin_insert_brand_form');
  let err = document.querySelector('.registration_error');
  let success = document.querySelector('.admin_insert_brand_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название бренда
      if (a_ins_brand.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_ins_brand.parentElement.nextElementSibling.classList.add('admin_insert_brand_error_active');
        a_ins_brand.classList.add('admin_insert_brand_input_red');         
        error =true;                
      }else{
         a_ins_brand.parentElement.nextElementSibling.classList.remove('admin_insert_brand_error_active');
         a_ins_brand.classList.remove('admin_insert_brand_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }

}
checkFormInsertBrand();

// валидация формы редактирования бренда и отображение сообщений: об успешном редактировании бренда; ошибки
function checkFormUpdateBrand(){
  let form = document.querySelector('.admin_update_brand_form');
  let err = document.querySelector('.error_admin_update_brand');
  let success = document.querySelector('.success_admin_update_brand');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название бренда
      if (a_up_br_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_up_br_name.parentElement.nextElementSibling.classList.add('admin_update_brand_error_active');
        a_up_br_name.classList.add('admin_update_brand_input_red');         
        error =true;                
      }else{
         a_up_br_name.parentElement.nextElementSibling.classList.remove('admin_update_brand_error_active');
         a_up_br_name.classList.remove('admin_update_brand_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateBrand();

// валидация формы добавления субкатегории и отображение сообщений: об успешном добавлении субкатегории; ошибки
function checkFormInsertSubcategory(){
    let form = document.querySelector('.admin_insert_subcat_form');
    let err = document.querySelector('.adm_ins_subcat_error');
    let success = document.querySelector('.adm_ins_subcat_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название субкатегории
      if (a_i_subcat_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_i_subcat_name.parentElement.nextElementSibling.classList.add('admin_insert_subcat_error_active');
        a_i_subcat_name.classList.add('admin_insert_subcat_input_red');         
        error =true;                
      }else{
         a_i_subcat_name.parentElement.nextElementSibling.classList.remove('admin_insert_subcat_error_active');
         a_i_subcat_name.classList.remove('admin_insert_subcat_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }

}
checkFormInsertSubcategory();

// валидация формы редактирования субкатегории и отображение сообщений: об успешном редактировании субкатегории; ошибки
function checkFormUpdateSubcat(){
    let form = document.querySelector('.admin_update_subcat_form');
    let err = document.querySelector('.adm_up_subcat_error');
    let success = document.querySelector('.adm_up_subcat_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название бренда
      if (a_u_subcat_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_u_subcat_name.parentElement.nextElementSibling.classList.add('admin_update_subcat_error_active');
        a_u_subcat_name.classList.add('admin_update_subcat_input_red');         
        error =true;                
      }else{
         a_u_subcat_name.parentElement.nextElementSibling.classList.remove('admin_update_subcat_error_active');
         a_u_subcat_name.classList.remove('admin_update_subcat_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateSubcat();

// валидация формы добавления размера и отображение сообщений: об успешном добавлении размера; ошибки
function checkFormInsertSize(){
    let form = document.querySelector('.admin_insert_size_form');
    let err = document.querySelector('.adm_ins_size_error');
    let success = document.querySelector('.adm_ins_size_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название размера
      if (a_i_size_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_i_size_name.parentElement.nextElementSibling.classList.add('admin_insert_size_error_active');
        a_i_size_name.classList.add('admin_insert_size_input_red');         
        error =true;                
      }else{
         a_i_size_name.parentElement.nextElementSibling.classList.remove('admin_insert_size_error_active');
         a_i_size_name.classList.remove('admin_insert_size_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertSize();

// валидация формы редактирования размера и отображение сообщений: об успешном редактировании размера; ошибки
function checkFormUpdateSize(){
    let form = document.querySelector('.admin_update_size_form');
    let err = document.querySelector('.adm_up_size_error');
    let success = document.querySelector('.adm_up_size_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название размера
      if (a_u_size_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_u_size_name.parentElement.nextElementSibling.classList.add('admin_update_size_error_active');
        a_u_size_name.classList.add('admin_update_size_input_red');         
        error =true;                
      }else{
         a_u_size_name.parentElement.nextElementSibling.classList.remove('admin_update_size_error_active');
         a_u_size_name.classList.remove('admin_update_size_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateSize();

// валидация формы добавления статуса заказа и отображение сообщений: об успешном добавлении статуса заказа; ошибки
function checkFormInsertStatusOrder(){
    let form = document.querySelector('.admin_insert_order_status_form');
    let err = document.querySelector('.adm_ins_order_status_error');
    let success = document.querySelector('.adm_ins_order_status_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название статуса заказа
      if (a_i_o_s_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_i_o_s_name.parentElement.nextElementSibling.classList.add('admin_insert_order_status_error_active');
        a_i_o_s_name.classList.add('admin_insert_order_status_input_red');         
        error =true;                
      }else{
         a_i_o_s_name.parentElement.nextElementSibling.classList.remove('admin_insert_order_status_error_active');
         a_i_o_s_name.classList.remove('admin_insert_order_status_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertStatusOrder();

// валидация формы редактирования статуса заказа и отображение сообщений: об успешном редактировании статуса заказа; ошибки
function checkFormUpdateStatusOrder(){
    let form = document.querySelector('.admin_update_order_status_form');
    let err = document.querySelector('.adm_up_or_st_error');
    let success = document.querySelector('.adm_up_or_st_success');         
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;      
      // название статуса заказа
      if (a_up_o_s_name.value.trim() == '') {
        if (success) {
            success.classList.add('adm_ins_br');             
        }
        if (err) {             
            err.classList.add('adm_ins_br');
        }         
        a_up_o_s_name.parentElement.nextElementSibling.classList.add('admin_update_order_status_error_active');
        a_up_o_s_name.classList.add('admin_update_order_status_input_red');         
        error =true;                
      }else{
         a_up_o_s_name.parentElement.nextElementSibling.classList.remove('admin_update_order_status_error_active');
         a_up_o_s_name.classList.remove('admin_update_order_status_input_red');                     
      }     

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateStatusOrder();

// валидация формы добавления слайда
function checkFormInsertSlide(){
    let form = document.querySelector('.admin_slider_insert_form');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false; 

      // фотография логотипа
      if (a_s_i_logo.value == '') {
        a_s_i_logo.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_logo.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_logo.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_logo.classList.remove('admin_slider_insert_input_red');         
      }

      // название бренда
      if (a_s_i_name_brand.value.trim() == '') {
        a_s_i_name_brand.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_name_brand.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_name_brand.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_name_brand.classList.remove('admin_slider_insert_input_red');         
      }

      // заголовок
      if (a_s_i_title.value.trim() == '') {
        a_s_i_title.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_title.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_title.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_title.classList.remove('admin_slider_insert_input_red');         
      }

      // подзаголовок
      if (a_s_i_subtitle.value.trim() == '') {
        a_s_i_subtitle.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_subtitle.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_subtitle.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_subtitle.classList.remove('admin_slider_insert_input_red');         
      }

      // основное изображение
      if (a_s_i_main_img.value == '') {
        a_s_i_main_img.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_main_img.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_main_img.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_main_img.classList.remove('admin_slider_insert_input_red');         
      }

      // id товара
      if (a_s_i_product_id.value.trim() == '') {
        a_s_i_product_id.parentElement.nextElementSibling.classList.add('admin_slider_insert_error_active');
         a_s_i_product_id.classList.add('admin_slider_insert_input_red'); 
         error =true;                 
      }else{
         a_s_i_product_id.parentElement.nextElementSibling.classList.remove('admin_slider_insert_error_active');
         a_s_i_product_id.classList.remove('admin_slider_insert_input_red');         
      }      

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertSlide();

// валидация формы редактирования слайда
function checkFormUpdateSlide(){
    let form = document.querySelector('.admin_slider_up_form');
    let err = document.querySelector('.adm_sl_er');
    let success = document.querySelector('.adm_sl_sc');
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;

      // название бренда
      if (adm_sl_up_alt_logo.value.trim() == '') {
        if (success) {
            success.classList.add('adm_sl_n');             
        }
        if (err) {             
            err.classList.add('adm_sl_n');
        } 
        adm_sl_up_alt_logo.parentElement.nextElementSibling.classList.add('admin_slider_up_error_active');
         adm_sl_up_alt_logo.classList.add('admin_slider_up_input_red'); 
         error =true;                 
      }else{
         adm_sl_up_alt_logo.parentElement.nextElementSibling.classList.remove('admin_slider_up_error_active');
         adm_sl_up_alt_logo.classList.remove('admin_slider_up_input_red');         
      }

      // заголовок
      if (adm_al_up_title.value.trim() == '') {
        if (success) {
            success.classList.add('adm_sl_n');             
        }
        if (err) {             
            err.classList.add('adm_sl_n');
        } 
         adm_al_up_title.parentElement.nextElementSibling.classList.add('admin_slider_up_error_active');
         adm_al_up_title.classList.add('admin_slider_up_input_red'); 
         error =true;                 
      }else{
         adm_al_up_title.parentElement.nextElementSibling.classList.remove('admin_slider_up_error_active');
         adm_al_up_title.classList.remove('admin_slider_up_input_red');         
      }

      // подзаголовок
      if (adm_sl_up_st.value.trim() == '') {
          if (success) {
              success.classList.add('adm_sl_n');             
          }
          if (err) {             
              err.classList.add('adm_sl_n');
          } 
          adm_sl_up_st.parentElement.nextElementSibling.classList.add('admin_slider_up_error_active');
         adm_sl_up_st.classList.add('admin_slider_up_input_red'); 
         error =true;                 
      }else{
         adm_sl_up_st.parentElement.nextElementSibling.classList.remove('admin_slider_up_error_active');
         adm_sl_up_st.classList.remove('admin_slider_up_input_red');         
      }       

      // id товара
      if (adm_sl_up_id_product.value.trim() == '') {
        if (success) {
            success.classList.add('adm_sl_n');             
        }
        if (err) {             
            err.classList.add('adm_sl_n');
        } 
        adm_sl_up_id_product.parentElement.nextElementSibling.classList.add('admin_slider_up_error_active');
         adm_sl_up_id_product.classList.add('admin_slider_up_input_red'); 
         error =true;                 
      }else{
         adm_sl_up_id_product.parentElement.nextElementSibling.classList.remove('admin_slider_up_error_active');
         adm_sl_up_id_product.classList.remove('admin_slider_up_input_red');         
      }      

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateSlide();

// валидация формы добавления карточки
function checkFormInsertCard(){
    let form = document.querySelector('.admin_card_insert_form');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false; 

      // фотография  
      if (a_c_i_foto.value.trim() == '') {
        a_c_i_foto.parentElement.nextElementSibling.classList.add('admin_card_insert_error_active');
         a_c_i_foto.classList.add('admin_card_insert_input_red'); 
         error =true;                 
      }else{
         a_c_i_foto.parentElement.nextElementSibling.classList.remove('admin_card_insert_error_active');
         a_c_i_foto.classList.remove('admin_card_insert_input_red');         
      }

      // id товара  
      if (a_c_i_id_product.value.trim() == '') {
        a_c_i_id_product.parentElement.nextElementSibling.classList.add('admin_card_insert_error_active');
         a_c_i_id_product.classList.add('admin_card_insert_input_red'); 
         error =true;                 
      }else{
         a_c_i_id_product.parentElement.nextElementSibling.classList.remove('admin_card_insert_error_active');
         a_c_i_id_product.classList.remove('admin_card_insert_input_red');         
      }

      // название бренда  
      if (a_c_i_brand.value.trim() == '') {
        a_c_i_brand.parentElement.nextElementSibling.classList.add('admin_card_insert_error_active');
         a_c_i_brand.classList.add('admin_card_insert_input_red'); 
         error =true;                 
      }else{
         a_c_i_brand.parentElement.nextElementSibling.classList.remove('admin_card_insert_error_active');
         a_c_i_brand.classList.remove('admin_card_insert_input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertCard();

// валидация формы редактирования карточки
function checkFormUpdateCard(){
    let form = document.querySelector('.admin_card_up_form');
    let err = document.querySelector('.adm_card_er');
    let success = document.querySelector('.adm_card_sc');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;

      // id товара  
      if (a_u_c_id_product.value.trim() == '') {
        if (success) {
            success.classList.add('adm_card_n');             
        }
        if (err) {             
            err.classList.add('adm_card_n');
        }
        a_u_c_id_product.parentElement.nextElementSibling.classList.add('admin_card_up_error_active');
         a_u_c_id_product.classList.add('admin_card_up_input_red'); 
         error =true;                 
      }else{
         a_u_c_id_product.parentElement.nextElementSibling.classList.remove('admin_card_up_error_active');
         a_u_c_id_product.classList.remove('admin_card_up_input_red');         
      }

      // название бренда  
      if (a_u_c_brand.value.trim() == '') {
        if (success) {
            success.classList.add('adm_card_n');             
        }
        if (err) {             
            err.classList.add('adm_card_n');
        }
        a_u_c_brand.parentElement.nextElementSibling.classList.add('admin_card_up_error_active');
        a_u_c_brand.classList.add('admin_card_up_input_red'); 
        error =true;                 
      }else{
         a_u_c_brand.parentElement.nextElementSibling.classList.remove('admin_card_up_error_active');
         a_u_c_brand.classList.remove('admin_card_up_input_red');         
      }       

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateCard();

// валидация формы добавления новости
function checkFormInsertNews(){
    let form = document.querySelector('.admin_news_insert_form');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;

      // заголовок  
      if (a_n_i_title.value.trim() == '') {
        a_n_i_title.parentElement.nextElementSibling.classList.add('admin_news_insert_error_active');
         a_n_i_title.classList.add('admin_news_input_red'); 
         error =true;                 
      }else{
         a_n_i_title.parentElement.nextElementSibling.classList.remove('admin_news_insert_error_active');
         a_n_i_title.classList.remove('admin_news_input_red');         
      } 

      // подзаголовок  
      if (a_n_i_subtitle.value.trim() == '') {
        a_n_i_subtitle.parentElement.nextElementSibling.classList.add('admin_news_insert_error_active');
         a_n_i_subtitle.classList.add('admin_news_input_red'); 
         error =true;                 
      }else{
         a_n_i_subtitle.parentElement.nextElementSibling.classList.remove('admin_news_insert_error_active');
         a_n_i_subtitle.classList.remove('admin_news_input_red');         
      } 

      // главная фотография  
      if (a_n_i_img_first.value.trim() == '') {
        a_n_i_img_first.parentElement.nextElementSibling.classList.add('admin_news_insert_error_active');
         a_n_i_img_first.classList.add('admin_news_input_red'); 
         error =true;                 
      }else{
         a_n_i_img_first.parentElement.nextElementSibling.classList.remove('admin_news_insert_error_active');
         a_n_i_img_first.classList.remove('admin_news_input_red');         
      }      

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormInsertNews();

// валидация формы редактирования новости
function checkFormUpdateNews(){
    let form = document.querySelector('.admin_news_up_form');
    let err = document.querySelector('.adm_news_er');
    let success = document.querySelector('.adm_news_sc');    
    if (form) {
      form.addEventListener('submit',function(e){ 
      let error = false;

       // заголовок  
      if (a_n_u_title.value.trim() == '') {
        if (success) {
            success.classList.add('adm_news_n');             
        }
        if (err) {             
            err.classList.add('adm_news_n');
        }
        a_n_u_title.parentElement.nextElementSibling.classList.add('admin_news_up_error_active');
         a_n_u_title.classList.add('admin_news_up_input_red'); 
         error =true;                 
      }else{
         a_n_u_title.parentElement.nextElementSibling.classList.remove('admin_news_up_error_active');
         a_n_u_title.classList.remove('admin_news_up_input_red');         
      } 

      // подзаголовок  
      if (a_n_u_subtitle.value.trim() == '') {
        if (success) {
            success.classList.add('adm_news_n');             
        }
        if (err) {             
            err.classList.add('adm_news_n');
        }
        a_n_u_subtitle.parentElement.nextElementSibling.classList.add('admin_news_up_error_active');
        a_n_u_subtitle.classList.add('admin_news_up_input_red'); 
        error =true;                 
      }else{
        a_n_u_subtitle.parentElement.nextElementSibling.classList.remove('admin_news_up_error_active');
        a_n_u_subtitle.classList.remove('admin_news_up_input_red');         
      }          

      if(error){
            e.preventDefault();
        }  
      })
    }
}
checkFormUpdateNews();

 
 