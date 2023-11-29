// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTableUser").DataTable({
    pageLength: 6,
    lengthMenu: [
      [6, 12, 24, -1],
      [6, 12, 24, 48],
    ],
  });
});
