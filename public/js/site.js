// let modalToggle = document.querySelectorAll('.js-toggle-modal');
// let modal = document.querySelector('.js-modal');

// Array.from(modalToggle).forEach(modal => {
//   modal.addEventListener('click', function(event) {
//     event.preventDefault();
//     modal.classList.toggle('is-active');
//   });
// });

$(function () {
  var modalToggle = $('.js-toggle-modal');
  var modal = $('.js-modal');

  modalToggle.on('click', function (e) {
    e.preventDefault();
    modal.toggleClass('is-active');
  });
});