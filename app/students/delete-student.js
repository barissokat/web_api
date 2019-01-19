$(document).ready(function () {

   // will run if the delete button was clicked
   $(document).on('click', '.delete-student-button', function () {
      // get the student id
      var student_no = $(this).attr('data-id');
      var student_email = $(this).attr('data-email');

      // bootbox for good looking 'confirm pop up'
      bootbox.confirm({

         message: "<h4>Are you sure?</h4>",
         buttons: {
            confirm: {
               label: '<span class="glyphicon glyphicon-ok"></span> Yes',
               className: 'btn-danger'
            },
            cancel: {
               label: '<span class="glyphicon glyphicon-remove"></span> No',
               className: 'btn-primary'
            }
         },
         callback: function (result) {
            if (result == true) {

               // send delete request to api / remote server
               $.ajax({
                  url: "http://localhost/api/student/delete.php",
                  type: "POST",
                  dataType: 'json',
                  data: JSON.stringify({
                     id: student_no,
                     email: student_email
                  }),
                  success: function (result) {

                     // re-load list of students
                     showStudents();
                  },
                  error: function (xhr, resp, text) {
                     console.log(xhr, resp, text);
                  }
               });

            }
         }
      });
   });
});