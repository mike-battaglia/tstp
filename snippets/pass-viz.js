console.log('🟢☕ Custom JS Plugin');

document.addEventListener('DOMContentLoaded', function() {
  var passwordInput = document.querySelector('input[name="pwd"]');
  
  if (passwordInput) {
    var passwordToggle = document.createElement('span');
    passwordToggle.className = 'password-toggle';
    passwordToggle.setAttribute('onclick', 'togglePasswordVisibility()');
    passwordToggle.textContent = '👁️';
    
    passwordInput.insertAdjacentElement('afterend', passwordToggle);
  }
});

function togglePasswordVisibility() {
  var passwordInput = document.querySelector('input[name="pwd"]');
  var passwordToggle = document.querySelector('.password-toggle');
  
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    passwordToggle.textContent = '❌';
  } else {
    passwordInput.type = 'password';
    passwordToggle.textContent = '👁️';
  }
}
