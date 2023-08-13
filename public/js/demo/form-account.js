$(document).ready(function () {
   $('select[name="role"]').on('change', function () {
      let selectedRole = $(this).val();
      let ahliElements = $('.user-role-ahli');
      let judul = $('.title-user-role');

      if (selectedRole === 'ahli') {
         judul.text("Detail Account Ahli");
         ahliElements.show();
      } else {
         judul.text("Detail Account Petani");
         ahliElements.hide();
      }
   });

   $(".btn-collapse").click(function () {
      var icon = $(this).find("i");
      if (icon.hasClass("fa-chevron-down")) {
         icon.removeClass("fa-chevron-down").addClass("fa-chevron-up");
      } else {
         icon.removeClass("fa-chevron-up").addClass("fa-chevron-down");
      }
   });
   $('.custom-file-input').on('change', function () {
      let fileName = $(this).val().split('\\').pop();
      $(this).siblings('.custom-file-label').addClass('selected').html(fileName);
   });
});
