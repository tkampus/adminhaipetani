let role = document.querySelector('select[name="role"]');


role.addEventListener('change', function () {
   let selectedRole = this.value;
   let ahliElements = document.querySelectorAll('.user-role-ahli');
   let judul = document.querySelector('.title-user-role');
   if (selectedRole === 'ahli') {
      judul.textContent = "New Account Ahli";
      ahliElements.forEach(element => {
         element.style.display = 'block';
      });
   } else {
      judul.textContent = "New Account Petani";
      ahliElements.forEach(element => {
         element.style.display = 'none';
      });
   }
});
