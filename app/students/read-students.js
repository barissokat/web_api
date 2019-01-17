$(document).ready(function () {

   // show list of student on first load
   showStudents();

});

// function to show list of students
function showStudents() {
   // get list of students from the API
   $.getJSON("http://localhost/api/student/read.php", function (data) {
      // html for listing students
      var read_students_html = "";

      // when clicked, it will load the create student form
      read_students_html += "<div id='create-student' class='btn btn-primary pull-right m-b-15px create-student-button'>";
      read_students_html += "<span class='glyphicon glyphicon-plus'></span> Create Student";
      read_students_html += "</div>";

      // start table
      read_students_html += "<table class='table table-bordered table-hover'>";

      // creating our table heading
      read_students_html += "<tr>";
      read_students_html += "<th class='w-25-pct'>Student No</th>";
      read_students_html += "<th class='w-25-pct'>Name</th>";
      read_students_html += "<th class='w-10-pct'>topic</th>";
      read_students_html += "<th class='w-15-pct'>status</th>";
      read_students_html += "<th class='w-15-pct'>advisor</th>";
      read_students_html += "<th class='w-25-pct text-align-center'>Action</th>";
      read_students_html += "</tr>";

      // loop through returned list of data
      $.each(data.records, function (key, val) {

         // creating new table row per record
         read_students_html += "<tr>";
         
         var topic = val.topic == "" ?  "Not Determined" : val.topic ;
         var status = val.status == 1 ? "Accepted" : "No Status";

         read_students_html += "<td>" + val.id + "</td>";
         read_students_html += "<td>" + val.name + "</td>";
         read_students_html += "<td>" + topic + "</td>";
         read_students_html += "<td>" + status + "</td>";
         read_students_html += "<td>" + val.advisor_name + "</td>";

         // 'action' buttons
         read_students_html += "<td>";

         // edit button
         read_students_html += "<button class='btn btn-primary m-r-10px update-student-button' data-id='" + val.id + "'>";
         read_students_html += "<span class='glyphicon glyphicon-edit'></span> Detail";
         read_students_html += "</button>";

         // delete button
         read_students_html += "<button class='btn btn-danger delete-student-button' data-id='" + val.id + "'>";
         read_students_html += "<span class='glyphicon glyphicon-remove'></span> Delete";
         read_students_html += "</button>";
         read_students_html += "</td>";

         read_students_html += "</tr>";

      });

      // end table
      read_students_html += "</table>";

      // inject to 'page-content' of our app
      $("#page-content").html(read_students_html);

      // chage page title
      changePageTitle("All Students");
   });
}

// when a 'read students' button was clicked
$(document).on('click', '.read-students-button', function () {
   showStudents();
});