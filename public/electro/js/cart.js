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
//them san pham vao gio hang goi den Productcontroller