const ERR_MSG = document.querySelector ('.js-err-msg');

function displayError (errorMessage) {
  ERR_MSG.innerText = errorMessage;
}


const LOGIN_MODAL = document.querySelector ('.modal-bg');
const BORROW_BUTTON = document.querySelector ('.js-borrow-button');

function showLoginModal () {
  LOGIN_MODAL.classList.toggle ('show-modal');
}

BORROW_BUTTON.addEventListener('click', showLoginModal);