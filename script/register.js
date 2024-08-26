const ERROR_MESSAGE = document.querySelector ('.js-err-msg');

function displayError (errMsg) {
  ERROR_MESSAGE.innerText = errMsg;
}

const REG_FORM = document.querySelector ('.js-reg-form');
const PW = document.querySelector ('.js-password');
const CONFIRM_PW = document.querySelector ('.js-confirm-password');
const SUBMIT_BUTTON = document.querySelector ('.js-register-button');

REG_FORM.addEventListener ('submit', (event)=> {
  if (PW.value !== CONFIRM_PW.value) {
    displayError ("Password not match.");
    event.preventDefault ();
  }
})

const SHOW_PW_CB = document.querySelector ('.js-show-pw-cb');

function togglePW () {
  if (SHOW_PW_CB.checked === true) {
    PW.type = "text"
    CONFIRM_PW.type = "text"
    SHOW_PW_CB.checked = true;
  } else {
    PW.type = "password"
    CONFIRM_PW.type = "password"
    SHOW_PW_CB.checked = false;
  }
}

SHOW_PW_CB.addEventListener ('click', togglePW);