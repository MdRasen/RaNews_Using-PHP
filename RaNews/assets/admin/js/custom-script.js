$(document).ready(function () {
  // Add user to user's table
  $(document).on("click", ".saveUser", function () {
    var name = $("#name").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var type = $("#type").val();
    var u_status = $("#u_status").val();

    if (name != "" && email != "" && password != "") {
      if (phone != "" && !$.isNumeric(phone)) {
        swal("Please enter a valid phone number!", "", "warning");
      } else {
        var data = {
          saveUserBtn: true,
          name: name,
          email: email,
          phone: phone,
          password: password,
          type: type,
          u_status: u_status,
        };

        $.ajax({
          type: "POST",
          url: "../../controllers/user-controller.php",
          data: data,
          success: function (response) {
            var res = JSON.parse(response);
            if (res.status == 200) {
              $("#addUserModal").modal("hide");
              swal("", res.message, res.status_type);
              // Auto reload after 1 sec
              setTimeout(function () {
                window.location.reload(1);
              }, 1000);
            } else if (res.status == 500) {
              swal("", res.message, res.status_type);
            } else if (res.status == 403) {
              swal("", res.message, res.status_type);
            } else {
              swal("Something went wrong, Please try again!", "", "warning");
            }
          },
        });
      }
    } else {
      swal("Please fill the required fields!", "", "warning");
    }
  });
});
