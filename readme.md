## HOW TO USE

Below will detail on how to use this blog messaging platform, although this has been built using Laravel, I have made a few bespoke custom methods within the logic on what is needed for this exercise:

- Please run the command "php artisan migrate". This will import the table structure within the database.
- Please run the command "php artisan db:seed". This will import the user created for this exercise.
- Run the following two commands "php artisan serve" and "npm run watch". This will start up both the PHP and Node servers respectively.
- Go to http://127.0.0.1:8000 and you will be directed to the blog homepage where you are able to view posts/add comments as a generic user.
- To sign is as an admin click the Admin Panel option from the navigation, the login section had been built using Vue.js and uses vuex to send the request.
- After logging in as an Admin, you are able to post blog posts along with commenting on other posts more will be discussed further below.


## Admin Panel

The Admin panel allows the admin user to switch tech stack, on the bottom right hand side of the list of panels is a switch. 

This switch by default is set to PHP, once clicked it will switch to Node. 

Once in Node, you are able to post a blog post and comment using Node, you just need to make sure that the switch is set to Node. After switching you will need to refresh the page as the conditional logic to check is in javascript.

After submitting a post or a comment, an alert will display asking to run the following command "node resources/js/connection.js", this will then process and save the data into the database using Node.


## Comments

When commenting, after submitting one, these will be displayed in real-time along with adding comments within the comments. This is used by applying micro-services to obtain and process the data via the respective APIs.

## Unit Testing

When running unit tests please run the following command in the root directory: "vendor/bin/phpunit tests/Unit/Auth/LoginControllerTest.php".

There are other unit tests to be found but these are from the third party package used for this exercise, these can be found here: "/vendor/webdevetc/blogetc/tests/MainTest.php".

I have used mocking and reflection techniques to create the tests. 
