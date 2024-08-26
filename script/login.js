const ERROR_MESSAGE = document.querySelector ('.js-err-msg');

function displayError (errMsg) {
  ERROR_MESSAGE.innerText = errMsg;
}

const PW = document.querySelector ('.js-password');
const SHOW_PW_CB = document.querySelector ('.js-show-pw-cb');

function togglePW () {
  if (SHOW_PW_CB.checked === true) {
    PW.type = "text"
    SHOW_PW_CB.checked = true;
  } else {
    PW.type = "password"
    SHOW_PW_CB.checked = false;
  }
}

SHOW_PW_CB.addEventListener ('click', togglePW);