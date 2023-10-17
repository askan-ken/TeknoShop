// Call the dataTables jQuery plugin
$(document).ready(function() {
  function rupiah(angka)
  {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++) {
      if (i % 3 == 0) {
        rupiah += angkarev.substr(i, 3) + '.';
      }
    }
    return 'Rp.' + rupiah.split('', rupiah.length - 1).reverse().join('');
  }

  function getPrice()
  {
    let price = 0;
    $('.form-input-count').each(function(index, element) {
      price += parseInt($(element).attr('data-price')) * parseInt($(element).val());
    });
    return price;
  }

  $('.form-input-count').change(function() {
    let price = getPrice();
    $('span#price').html(rupiah(price));
    const submitCheckout = $('#submitCheckout');
    if( price > 0 ) {
      if (submitCheckout.prop('disabled')) {
        submitCheckout.removeAttr('disabled');
      }
    }else{
      if (submitCheckout.attr('disabled') === undefined) {
        submitCheckout.attr('disabled', 'disabled');
      }
    }
  });

  $('#submitCheckout').click(function(){
    if ($('#submitCheckout').attr('disabled') === undefined && getPrice() > 0) {
      $('#formCheckout').submit();
    }
  });

});
