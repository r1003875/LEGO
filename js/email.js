document.querySelector('#email').addEventListener('input', function(e) {
    console.log('input event fired');
  let email = document.querySelector('#email').value;
  const formData = new FormData();
  formData.append('email', email);
  //check if email is available -> use db
    fetch('ajax/checkEmail.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        if(result.body == 'false') {
            document.querySelector('#email_error').classList.remove("hidden");
            console.log('email is already in use');
        } 
        else {
            document.querySelector('#email_error').classList.add("hidden");
            console.log('email is available');
        }
    })
})