# Outputs

You need to use POSTMAN to test this API.

## Read Advisors
Enter the following as the request URL.
http://localhost/api/advisor/read.php

Click the blue "Send" button.

## Create Advisor
Enter the following as the request URL
http://localhost/api/advisor/create.php

Click "Body" tab. Click "raw". Enter this JSON value:

{
    "name" : "Test Name",
    "area" : "Test Area"
}

Click the blue "Send" button.

## Read One Advisor
Enter the following as the request URL
http://localhost/api/advisor/read_one.php?id=1

Click the blue "Send" button.

## Update Advisor
Enter the following as the request URL
http://localhost/api/advisor/update.php

Click "Body" tab. Click "raw". Enter the following JSON value (make sure the ID exists in your database):

{
    "id"   : "1",
    "name" : "Updated Test Name",
    "area" : "Updated Test Area"
}

Click the blue "Send" button.

## Delete Advisor
Enter the following as the request URL
http://localhost/api/advisor/delete.php

Click "Body" tab. Click "raw". Enter the following JSON value (make sure the ID exists in your database):

{
    "id"   : "1"
}

Click the blue "Send" button.

## Search Advisors
Enter the following as the request URL
http://localhost/api/advisor/search.php?s=Name

Click the blue "Send" button.

## Paginate Advisors
Enter the following as the request URL
http://localhost/api/advisor/read_paging.php

Click the blue "Send" button.