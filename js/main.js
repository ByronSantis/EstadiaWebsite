let menu = document.querySelector('.header .nav .menu');

document.querySelector('#menu-btn').onclick = () =>{
   menu.classList.toggle('active');
}

window.onscroll = () =>{
   menu.classList.remove('active');
}

document.querySelectorAll('input[type="number"]').forEach(inputNumber => {
   inputNumber.oninput = () =>{
      if(inputNumber.value.length > inputNumber.maxLength) inputNumber.value = inputNumber.value.slice(0, inputNumber.maxLength);
   };
});

document.querySelectorAll('.view-property .details .thumb .small-images img').forEach(images =>{
   images.onclick = () =>{
      src = images.getAttribute('src');
      document.querySelector('.view-property .details .thumb .big-image img').src = src;
   }
});

document.querySelectorAll('.faq .box-container .box h3').forEach(headings =>{
   headings.onclick = () =>{
      headings.parentElement.classList.toggle('active');
   }
});



function nombre(e){

   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toString();
   letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú ";
 
   especiales = [8, 13]
   tecla_especiol = false
   for(var i  in especiales){
     if(key == especiales[i]){
       tecla_especiol = true;
       break;
     }
   }
   if(letras.indexOf(tecla) == -1 && !tecla_especiol){
     alert("Este campo solo admite letras.")
     return false;
   }
 }

 function numb(e){

   key = e.keyCode || e.which;
   tecla = String.fromCharCode(key).toString();
   letras = "/^(\+?56)?(\s?)(0?9)(\s?)[98765432]\d{7}$/"
 
   especiales = [8, 13]
   tecla_especiol = false
   for(var i  in especiales){
     if(key == especiales[i]){
       tecla_especiol = true;
       break;
     }
   }
   if(letras.indexOf(tecla) == -1 && !tecla_especiol){
     alert("Este campo solo admite numeros")
     return false;
   }
 }
 

