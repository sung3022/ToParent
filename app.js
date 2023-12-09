const input = document.querySelector('.input');
const output = document.querySelector('.output');
const button = document.querySelector('.button');

button.addEventListener('click', () => {
  if (input.value != '') {
    input.style.display = 'None';
    button.style.display = 'None';
    output.innerText = '';
    $.ajax({
      url: './submit.php',
      type: 'POST',
      data: { msg: input.value },
      success: function (result) {
        output.innerText = result;
        input.value = '';
        input.style.display = '';
        button.style.display = '';
      },
      error: (e) => {
        console.log(e);
      },
    });
  }
});
