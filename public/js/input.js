$(document).ready(function(){


$("#name").autocomplete({

  source:'autocomplete',
  minLength:1,

  select:function(event,ui){
   console.log(q);
   $('#q').val(ui.item.id);
  }



});



});