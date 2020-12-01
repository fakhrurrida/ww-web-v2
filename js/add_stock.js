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
    value++;

    document.getElementById('amount').value = value;
    document.getElementById('decrement').innerHTML = '';
}

function decrementValue()
{
  var value = parseInt(document.getElementById('amount').value, 10);
  value = isNaN(value) ? 0 : value;
  document.getElementById('decrement').innerHTML = '';
  
  if (value == 0){
    document.getElementById('decrement').innerHTML = "It's already minimum!"
  }
  else{
    value--;
    document.getElementById('amount').value = value;
    document.getElementById('decrement').innerHTML = '';
  }

}
