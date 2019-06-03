function addToCart(id) {
  $.ajax({
   type:'GET',
   url:'/add-to-cart/'+id,
   data:
   {
     "_token": "{{ csrf_token() }}",
     'qty': $('#qty').val(),
     'detail_id':$( "#detail" ).val()
   },
   success:function(data) {
    $("#cart").load(" #cart > *");
    console.log(data);
  }
});
}
function addToCart(id,detail) {
  if(!detail){
    detail=$( "#detail" ).val();
  }
  $.ajax({
   type:'GET',
   url:'/add-to-cart/'+id,
   data:
   {
    "_token": "{{ csrf_token() }}",
    'qty': 1,
    'detail_id':detail
  },
  success:function(data) {
    $("#cart").load(" #cart > *");
    console.log("goi ham 2 tham so");
  }
});
}
//them san pham vao gio hang goi den Productcontroller
function subToCart(id) {
 $.ajax({
   type:'GET',
   url:'/sub-to-cart/'+id,
   data:
   {
     "_token": "{{ csrf_token() }}",

   },
   success:function(data) {
    $("#cart").load(" #cart > *");
    console.log("ok");
  }
});
}
function addLaptopToCart(id) {
  $.ajax({
   type:'GET',
   url:'/add-laptop-to-cart/'+id,
   data:
   {
     "_token": "{{ csrf_token() }}",
     'qty': $('#qty').val(),
     
   },
   success:function(data) {
    $("#cart").load(" #cart > *");
    console.log("ok");
  }
});
}
function subLaptopToCart(id) {
 $.ajax({
   type:'GET',
   url:'/sub-laptop-to-cart/'+id,
   data:
   {
     "_token": "{{ csrf_token() }}",

   },
   success:function(data) {
    $("#cart").load(" #cart > *");
    console.log("ok");
  }
});
}