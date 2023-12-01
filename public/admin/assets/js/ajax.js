//  add to cart js code 
function btnAddCart(param) {

		$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
         });

  var product_id = param;
  var name = $('#name'+product_id).val();
  var url = 'addToCart/'+product_id;

  $.ajax({
    type: "POST",
    url: url,
    data: { product_id: product_id },
    contentType: "application/json; charset=utf-8",
    dataType: "json",

    success: function (response) {
		$('#cartCounterId').load(location.href + ' .cartCounter');
		alertify.set('notifier' , 'position' , 'center')
		alertify.success(name+' Added Successfully To Your Cart.'); 
     },

    error: function () {
		alertify.set('notifier' , 'position' , 'center')
		alertify.error('Somthing Error.'); 
 
    }
  });
};


  // quantity count in cart 
  function incrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal)) {
            parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    function decrementValue(e) {
        e.preventDefault();
        var fieldName = $(e.target).data('field');
        var parent = $(e.target).closest('div');
        var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

        if (!isNaN(currentVal) && currentVal > 0) {
            parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
        } else {
            parent.find('input[name=' + fieldName + ']').val(0);
        }
    }

    $('.input-group').on('click', '.button-plus', function(e) {
        incrementValue(e);
    });

    $('.input-group').on('click', '.button-minus', function(e) {
        decrementValue(e);
    });


    
// Update quantity in cart

$(document).ready(function() {
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $(document).on('click' , '.updateQuant' , function() {
  
    var thisClick = $(this);
    var productId = $(this).val();
    var orderPrice = $('.orderPrice').val();
    var quty = $(this).closest('.itemsQuty').find('.quantitytxt').val();
    var url = '/updateQuantity/'+productId;
 
    if(quty == 0){

      alertify.set('notifier' , 'position' , 'center')
          alertify.error('quantity must be 1 ore greater.'); 
    }else{

      $.ajax ({
      type : 'POST',
      url : url,
      data :{
      'product_id' : productId,
      'quantity' : quty,
    },

      success : function(response){
    
        thisClick.closest('.cartpage').find('.total_price').text('$'+response.getPrice);
        $('#orderPriceId').load(location.href + ' .orderPrice');
        	alertify.set('notifier' , 'position' , 'center');
		      alertify.success('Quantity Updated Successfully.');
          

      },
      error: function () {
          alertify.set('notifier' , 'position' , 'center')
          alertify.error('Somthing Error.'); 
    }

    });
  }  
  });
 });



// delete one prod from cart
  function deleteFromCart(id)
  {
    if(confirm('Are you sure you want to delete this product from cart ?')){

    $.ajax({
        url: "/deleteOrder/"+id,
        type: 'DELETE',
      
        data:{
          _token: $('input[name=_token]').val()
        },

        success:function(response)
        {
          $('#orderPriceId').load(location.href + ' .orderPrice');
          $("#sid"+id).remove();
        }
      });
    }
  }



  // profile pic
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
  }
   $("#imageUpload").change(function() {
    readURL(this);
  });