document.addEventListener('DOMContentLoaded', function() {
  var passwordInput = document.querySelector('input[name="pwd"]');
  
  if (passwordInput) {
    var passwordToggle = document.createElement('span');
    passwordToggle.className = 'password-toggle';
    passwordToggle.setAttribute('onclick', 'togglePasswordVisibility()');
    passwordToggle.innerHTML = '<i class="fa fa-eye"></i>';
    
    passwordInput.insertAdjacentElement('afterend', passwordToggle);
  }
});

function togglePasswordVisibility() {
  var passwordInput = document.querySelector('input[name="pwd"]');
  var passwordToggle = document.querySelector('.password-toggle');
  var iconElement = passwordToggle.querySelector('i');
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    iconElement.className = 'fa fa-eye-slash';
  } else {
    passwordInput.type = 'password';
    iconElement.className = 'fa fa-eye';
  }
}
