// A BIT JAVASCRIPT FOR NAVBAR
function toggle(){
  var nav = document.getElementById('menuContainer');
  nav.classList.toggle('show');
}

// FOR BUY_PAGE
function incrementValue()
{
    var value = parseInt(document.getElementById('amount').value, 10);
    value = isNaN(value) ? 0 : value;

    var remain = document.getElementById('remain-value').innerHTML;
    var newRemain = remain.slice(2, remain.length);

    if (newRemain > 0){

      value++;

      var newRemain = parseInt(newRemain) - 1;

      document.getElementById('amount').value = value;
      document.getElementById('decrement').innerHTML = '';

      var price = document.getElementById('price-value').innerHTML;
      var newPrice = price.slice(4, price.length);
      var realPrice = parseInt(newPrice, 10);

      var sumPrice = realPrice*value;

      document.getElementById('remain-value').innerHTML = ": " + newRemain;

      document.getElementById('buying-price').innerHTML = "Rp" + sumPrice + ",00";

    }
    else {
      document.getElementById('decrement').innerHTML = "Item out of stock!"
    }

}

function decrementValue()
{
    var value = parseInt(document.getElementById('amount').value, 10);
    value = isNaN(value) ? 0 : value;

    var remain = document.getElementById('remain-value').innerHTML;
    var newRemain = remain.slice(2, remain.length);

    if (value == 0){
      document.getElementById('decrement').innerHTML = "It's already minimum!"
    }
    else{
      value--;

      var newRemain = parseInt(newRemain) + 1;

      document.getElementById('amount').value = value;
      document.getElementById('decrement').innerHTML = '';

      var price = document.getElementById('price-value').innerHTML;
      var newPrice = price.slice(4, price.length);
      var realPrice = parseInt(newPrice, 10);

      var sumPrice = realPrice*value;

      document.getElementById('remain-value').innerHTML = ": " + newRemain;

      document.getElementById('buying-price').innerHTML = "Rp" + sumPrice + ",00";
    }

}
