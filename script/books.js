const CLOSE_BUTTON = document.querySelectorAll ('.js-cb');

CLOSE_BUTTON.forEach ((cb)=> {
  cb.addEventListener ('click', ()=> {
    location.href = "/lib_sys/webpages/view-books.php"
  })
})