$(document).ready(function () {

   // show html form when 'update student' button was clicked
   $(document).on('click', '.update-student-button', function () {
      // get student id
      var id = $(this).attr('data-id');

      // read one record based on given student id
      $.getJSON("http://localhost/api/student/read_one.php?id=" + id, function (data) {

         // values will be used to fill out our form
         var name = data.name;
         var topic = data.topic;
         var status = data.status;
         var advisor_id = data.advisor_id;
         var advisor_name = data.advisor_name;

         // load list of advisors
         $.getJSON("http://localhost/api/advisor/read.php", function (data) {

            // store 'update student' html to this variable
            var update_student_html = "";

            // 'read students' button to show list of students
            update_student_html += "<div id='read-students' class='btn btn-primary pull-right m-b-15px read-students-button'>";
            update_student_html += "<span class='glyphicon glyphicon-list'></span> Read Students";
            update_student_html += "</div>";

            // build 'update student' html form
            // we used the 'required' html5 property to prevent empty fields
            update_student_html += "<form id='update-student-form' action='#' method='post' border='0'>";
            update_student_html += "<table class='table table-hover table-responsive table-bordered'>";

            // name field
            update_student_html += "<tr>";
            update_student_html += "<td>Student No</td>";
            update_student_html += "<td>" + id + "</td>";
            update_student_html += "</tr>";

            // name field
            update_student_html += "<tr>";
            update_student_html += "<td>Name</td>";
            update_student_html += "<td>" + name + "<input value=\"" + name + "\" name='name' type='hidden' /></td>";
            update_student_html += "</tr>";

            // topic field
            update_student_html += "<tr>";
            update_student_html += "<td>Topic</td>";
            update_student_html += "<td>" + topic + "<input value=\"" + topic + "\" name='topic' type='hidden' /></td>";
            update_student_html += "</tr>";

            // advisors 'select' field
            update_student_html += "<tr>";
            update_student_html += "<td>Advisor</td>";
            update_student_html += "<td>" + advisor_name + "<input value=\"" + advisor_id + "\" name='advisor_id' type='hidden' /></td>";
            update_student_html += "</tr>";

            update_student_html += "<tr>";

            // hidden 'student id' to identify which record to update
            update_student_html += "<td><input value=\"" + id + "\" name='id' type='hidden' /><input value='1' name='status' type='hidden' /></td>";

            // button to submit form
            update_student_html += "<td>";
            update_student_html += "<button type='submit' class='btn btn-info'>";
            update_student_html += "<span class='glyphicon glyphicon-edit'></span> Accept";
            update_student_html += "</button>";
            update_student_html += "</td>";

            update_student_html += "</tr>";

            update_student_html += "</table>";
            update_student_html += "</form>";

            // inject to 'page-content' of our app
            $("#page-content").html(update_student_html);

            // chage page title
            changePageTitle("Update Student");
         });
      });
   });

   // will run if 'create student' form was submitted
   $(document).on('submit', '#update-student-form', function () {

      // get form data
      var form_data = JSON.stringify($(this).serializeObject());

      // submit form data to api
      $.ajax({
         url: "http://localhost/api/student/update.php",
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