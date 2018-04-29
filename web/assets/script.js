// author: Mike Henry, 2018

// generate a data object representing the toggle state of the clicked div for the AJAX POST request
// divObj is the jQuery-wrapped clicked div
function formatPostData(divObj) {
  let state = 0;
  if (divObj.hasClass('toggled')) {
    state = 1;
  }

  let id = divObj.attr('id');
  let data = {};
  data[id] = state;

  return data;
}

// div click handler to update class and submit AJAX request
function toggleAndSaveState() {
  $(this).toggleClass('toggled');

  let data = formatPostData($(this));
  $.post("/", data);
}

$(function() {
  $('.divitem').click(toggleAndSaveState);
});
