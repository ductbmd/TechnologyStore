function placeorder() {
   data={"_token": "{{ csrf_token() }}"};
   data.first_name=$('#first-name').val();
   data.last_name=$('#last-name').val();
   data.email=$('#email').val();
   data.address=$('#address').val();
   data.city=$('#city').val();
   data.country=$('#country').val();
   data.zip_code=$('#zip-code').val();
   data.telephone=$('#telephone').val();
   data.pass=$('#pass').val();
   data.pass=$('#note').val();

   console.log(data);

   $.ajax({
      type:'POST',
      url:'/order',
      data:data,
      dataType: 'JSON',
      success:function(data) {
        
        console.log("ok");
     }
  });
}