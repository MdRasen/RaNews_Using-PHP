// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#dataTable").DataTable();
});

// For customized row in dataTable
$(document).ready(function () {
  $("#dataTableCustom").DataTable({
    pageLength: 6,
    lengthMenu: [
      [6, 12, 24, -1],
      [6, 12, 24, 48],
    ],
  });
});
