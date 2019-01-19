$(document).ready(function () {

   // handle 'read one' button click
   $(document).on('click', '.read-one-student-button', function () {
      // get student id
      var id = $(this).attr('data-id');

      // read student record based on given ID
      $.getJSON("http://localhost/api/student/read_one.php?id=" + id, function (data) {
         // start html
         var read_one_student_html = "";

         // when clicked, it will show the student's list
         read_one_student_html += "<div id='read-students' class='btn btn-primary pull-right m-b-15px read-students-button'>";
         read_one_student_html += "<span class='glyphicon glyphicon-list'></span> Read Students";
         read_one_student_html += "</div>";

         // student data will be shown in this table
         read_one_student_html += "<table class='table table-bordered table-hover'>";

         var topic = data.topic == "" ? "Not Determined" : data.topic;
         var status = data.status == 1 ? "Accepted" : "No Status";

         // student no
         read_one_student_html += "<tr>";
         read_one_student_html += "<td class='w-30-pct'>Student No</td>";
         read_one_student_html += "<td class='w-70-pct'>" + data.id + "</td>";
         read_one_student_html += "</tr>";

         // student name
         read_one_student_html += "<tr>";
         read_one_student_html += "<td class='w-30-pct'>Name</td>";
         read_one_student_html += "<td class='w-70-pct'>" + data.name + "</td>";
         read_one_student_html += "</tr>";

         // student topic
         read_one_student_html += "<tr>";
         read_one_student_html += "<td>Topic</td>";
         read_one_student_html += "<td>" + topic + "</td>";
         read_one_student_html += "</tr>";

         // student status
         read_one_student_html += "<tr>";
         read_one_student_html += "<td>Status</td>";
         read_one_student_html += "<td>" + status + "</td>";
         read_one_student_html += "</tr>";

         // student email
         read_one_student_html += "<tr>";
         read_one_student_html += "<td>email</td>";
         read_one_student_html += "<td>" + data.email + "</td>";
         read_one_student_html += "</tr>";

         // student advisor name
         read_one_student_html += "<tr>";
         read_one_student_html += "<td>Advisor</td>";
         read_one_student_html += "<td>" + data.advisor_name + "</td>";
         read_one_student_html += "</tr>";

         read_one_student_html += "</table>";

         // inject html to 'page-content' of our app
         $("#page-content").html(read_one_student_html);

         // chage page title
         changePageTitle("Student Detail");
      });
   });

});