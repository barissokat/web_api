$(document).ready(function () {

   // show html form when 'create student' button was clicked
   $(document).on('click', '.create-student-button', function () {
      // load list of advisors
      $.getJSON("http://localhost/api/advisor/read.php", function (data) {
         // build advisors option html
         // loop through returned list of data
         var advisors_options_html = "";
         advisors_options_html += "<select name='advisor_id' class='form-control'><option value='-1'>Not Decided</option>";
         $.each(data.records, function (key, val) {
            advisors_options_html += "<option value='" + val.id + "'>" + val.name + "</option>";
         });
         advisors_options_html += "</select>";

         // we have our html form here where student information will be entered
         // we used the 'required' html5 property to prevent empty fields
         var create_student_html = "";

         // 'read students' button to show list of students
         create_student_html += "<div id='read-students' class='btn btn-primary pull-right m-b-15px read-students-button'>";
         create_student_html += "<span class='glyphicon glyphicon-list'></span> Read Students";
         create_student_html += "</div>";

         // 'create student' html form
         create_student_html += "<form id='create-student-form' action='#' method='post' border='0'>";
         create_student_html += "<table class='table table-hover table-responsive table-bordered'>";

         // Student No field
         create_student_html += "<tr>";
         create_student_html += "<td>Student No</td>";
         create_student_html += "<td><input type='text' name='id' class='form-control' required /></td>";
         create_student_html += "</tr>";

         // name field
         create_student_html += "<tr>";
         create_student_html += "<td>Name</td>";
         create_student_html += "<td><input type='text' name='name' class='form-control' required /></td>";
         create_student_html += "</tr>";

         // email field
         create_student_html += "<tr>";
         create_student_html += "<td>Email</td>";
         create_student_html += "<td><input type='email' name='email' class='form-control' required /></td>";
         create_student_html += "</tr>";

         // topic field
         create_student_html += "<tr>";
         create_student_html += "<td>Topic</td>";
         create_student_html += "<td><input type='text' name='topic' class='form-control' required /></td>";
         create_student_html += "</tr>";

         // advisors 'select' field
         create_student_html += "<tr>";
         create_student_html += "<td>Advisors</td>";
         create_student_html += "<td>" + advisors_options_html + "</td>";
         create_student_html += "</tr>";

         // button to submit form
         create_student_html += "<tr>";
         create_student_html += "<td></td>";
         create_student_html += "<td>";
         create_student_html += "<button type='submit' class='btn btn-primary'>";
         create_student_html += "<span class='glyphicon glyphicon-plus'></span> Add Student";
         create_student_html += "</button>";
         create_student_html += "</td>";
         create_student_html += "</tr>";

         create_student_html += "</table>";
         create_student_html += "</form>";

         // inject html to 'page-content' of our app
         $("#page-content").html(create_student_html);

         // chage page title
         changePageTitle("Create Student");
      });
   });

   // will run if create student form was submitted
   $(document).on('submit', '#create-student-form', function () {
      // get form data
      var form_data = JSON.stringify($(this).serializeObject());
      // submit form data to api
      $.ajax({
         url: "http://localhost/api/student/create.php",
         type: "POST",
         contentType: 'application/json',
         data: form_data,
         success: function (result) {
            // student was created, go back to students list
            showStudents();
         },
         error: function (xhr, resp, text) {
            // show error to console
            console.log(xhr, resp, text);
         }
      });

      return false;
   });
});