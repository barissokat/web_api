# Outputs

_You need to use POSTMAN to test this API._

## Add Chair
**Chair is added to the "advisors" list.**
Enter the following as the request URL

http://localhost/api/advisor/create.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"name" : "Tolga Ayav",
	"title_id" : "1"
}
```
Click the blue *"Send"* button.

## Add Advisor
**Advisor is added to the "advisors" list.**
Enter the following as the request URL

http://localhost/api/advisor/create.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"name" : "Onur Demirörs",
	"area" : "Software Process Improvement",
	"title_id" : "2"
}
```
Click the blue *"Send"* button.

## Delete The Advisor
**Secretary deletes the advisor from "advisors" list.**
Enter the following as the request URL

http://localhost/api/advisor/delete.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "1"
}
```
Click the blue *"Send"* button.

## Add Student
**Student is added to the master students thesis list.**
Enter the following as the request URL

http://localhost/api/student/create.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "252001045",
	"name" : "Barış Sokat",
	"advisor_id" : "1"
}
```
Click the blue *"Send"* button.

## List Advisors
**Advisors are listed.**
Enter the following as the request URL

http://localhost/api/advisor/read.php

Click the blue *"Send"* button.

## Search Advisor
**Search advisor with string.**
Enter the following as the request URL

http://localhost/api/advisor/search.php?s=Onur

Click the blue *"Send"* button.

## Determine Advisor
**Student determines the advisor.**
Enter the following as the request URL

http://localhost/api/student/update.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "252001045",
	"name" : "Barış Sokat",
	"advisor_id" : "2"
}
```
Click the blue *"Send"* button.

## Determine Thesis Topic
**Student determines the thesis topic.**
Enter the following as the request URL

http://localhost/api/student/update.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "252001045",
	"name" : "Barış Sokat",
	"topic" : "Microservices",
	"advisor_id" : "2"
}
```
Click the blue *"Send"* button.

## List Students
**Students are listed.**
Enter the following as the request URL

http://localhost/api/student/read.php

Click the blue *"Send"* button.

## Search Student
**Search student with string.**
Enter the following as the request URL

http://localhost/api/student/search.php?s=Barış

Click the blue *"Send"* button.

**Search student with id.**
Enter the following as the request URL

http://localhost/api/student/read_one.php?id=252001045

Click the blue *"Send"* button.

## Accept The Student
**Secretary accepts the student.**
Enter the following as the request URL

http://localhost/api/student/update.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "252001045",
	"name" : "Barış Sokat",
	"topic" : "Microservices",
	"accepted" : "1",
	"advisor_id" : "2"
}
```
Click the blue *"Send"* button.

## Delete The Student
**Secretary deletes the student from "students" list.**
Enter the following as the request URL

http://localhost/api/student/delete.php

Click *"Body"* tab. Click *"raw"*. Enter this JSON value:
```
{
	"id"   : "252001045"
}
```
Click the blue *"Send"* button.