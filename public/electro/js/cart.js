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
                  console.log("ok");
               }
            });
         }
function addToCart(id,detail) {
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
                  console.log("ok");
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