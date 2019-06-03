function placeorder() {
   if(!$("#terms").is(":checked")){
                alert("Đọc điều khoản và đồng ý với chúng tôi.");
                return
            }
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
   data={};
   data.name=$('#name').val();
   // data.last_name=$('#last-name').val();
   data.email=$('#email').val();
   data.address=$('#address').val();
   // data.city=$('#city').val();
   // data.country=$('#country').val();
   data.zip_code=$('#zip-code').val();
   data.telephone=$('#telephone').val();
   data.pass=$('#pass').val();
   data.note=$('#note').val();
   data.payment=$('input[name=payment]:checked').val();
   if($("#create-account").is(":checked")){
      data.create="yes";
   }else{
      data.create="no";
   }

   console.log(data);

   $.ajax({
      type:'POST',
      url:'/order',
      data:data,
      dataType: 'JSON',
      success:function(data) {
        
        console.log(data);
     },
     error: function (reject) {
         console.log(reject);
     }
  });
}