
setTimeout(function() {
    let alertNode = document.querySelector('.alert');
    if (alertNode) {
      alertNode.classList.remove('show'); 
      alertNode.classList.add('fade'); 
      setTimeout(() => alertNode.remove(), 500);
    }
  }, 5000);