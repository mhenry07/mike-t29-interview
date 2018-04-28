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

function toggleAndSaveState() {
  $(this).toggleClass('toggled');

  let data = formatPostData($(this));
  $.post("/savestate.php", data);
}

$(function() {
  $('.divitem').click(toggleAndSaveState);
});
