// function filterProduct() {
// 	var category_id=getValueUsingClass();
// 	$.ajax({
//                type:'GET',
//                url:'/client/store',
//                data:
//                 {
// 			      "_token": "{{ csrf_token() }}",
// 			      'category_id': category_id,
// 			      'price_min':$( "#price-min" ).val(),
// 			      'price_max':$( "#price-max" ).val(),
// 			      'product_sortBy':$("#product_sortBy").val(),
// 			      'product_paginate':$("#product_paginate").val()
// 			    },
//                success:function(data) {
//                	console.log(data);
//                   console.log("ok");
//                }
//             });
// }
function filterProduct(sel) {
	// var arrStr = encodeURIComponent(JSON.stringify(getValueUsingClass()));
	var link="/client/store?";
		if(sel==="laptop"){
		link="/client/storeLaptop?";
		}
	category_id=getValueUsingClass();
	if(category_id.length){
		for (var i = 0; i <category_id.length; i++) {
			link+="category_id%5B%5D="+category_id[i]+"&";
		}
	}
	link+="price_min="+$( "#price-min" ).val()
	+"&price_max="+$( "#price-max" ).val()
	+"&product_sortBy="+$("#product_sortBy").val()
	+"&product_paginate="+$("#product_paginate").val();
	console.log(link);
	 window.location.href = link;
}
function getValueUsingClass(){
	/* declare an checkbox array */
	var chkArray = [];
	
	/* look for all checkboes that have a class 'chk' attached to it and check if it was checked */
	$(".duc:checked").each(function() {
		chkArray.push($(this).val());
	});
	
	/* we join the array separated by the comma */
	var selected;
	selected = chkArray.join(',') ;
	console.log(selected);
	return chkArray;
	/* check if there is selected checkboxes, by default the length is 1 as it contains one single comma */
	// if(selected.length > 0){
	// 	alert("You have selected " + selected);	
	// }else{
	// 	alert("Please at least check one of the checkbox");	
	// }
}