Documentation and Shits 

npx @tailwindcss/cli -i ./src/input.css -o ./src/output.css --watch


ACCESS  6LdIQ_UqAAAAAGrV2MqdRUY2QWN7dGJP3G9Q4NET
FPW     6LfGZvUqAAAAAC3HdNLI0eRuIaaZR-PSpXrD6GRK

https://www.codexworld.com/new-google-recaptcha-with-php/




Put some tasks that hasn't done yet or to be planned here

========================================================== Heads Up
- Archive/Delete All should be disabled when there is no 2nd following tr in the db
        2nd following because the 1st tr is the header of the table
- Forget Password form to be done yet
- Request for theses deletion form
- Profile Page
    Where to display the profile picture across other pages? - to be asked
- DB is hidden to users in default (in the header)
- Contact Page
- About Page
- Animations/Transitions
- Graphic Designs (Profile Pictures)
- Mobile View

- Import data from CSV file for database manager
- Create a excel/spreadsheet format for easier import

- Use Recaptcha when published https://developers.google.com/recaptcha/docs/v3

========================================================== BACK-END FLOW/ALGORITHM
HAVE AN ADMIN AND SUPERADMIN USER ACCESS CREDENTIALS - prolly provide it here


- Login and Registration Logic

Login
    Use JS for validation
    After validation, JS will submit the specific form
    The site will then be reload because of form submission, from PHP to MySQL

Register
    Retrieve data from MySQL using PHP
    Use JS for validation
    After validation, JS will submit the specific form
    The site will then be reload because of form submission, from PHP to MySQL

(Remember to hash the password)


========================================================== Database Management
User Database
    ID
    ACCESS
    USERNAME
    NAME
    EMAIL
    PASSWORD (ENCRYPTED)
    PERSONALIZATION - For Profile Picture # and Saved Bookmarks

Thesis Database
    ID
    ARCHIVED
    DATE
    COURSE
    TITLE
    AUTHORS
    ABSTRACT
    KEYWORDS

- Personalization Logic
    First character represents the Profile Picture ID (10 characters)
    Second character will be the divider (use symbols)
    Third and following character will be the ID of the Thesis Bookmarked
    Separate with a character (use symbols)


FLOW OF DATABASE (THESIS)
    (PHP)
    RETRIEVE DATA FROM MYSQL
    CREATE AN OBJECT
    STORE DATA TO THE OBJECT
    STORE OBJECT TO AN ARRAY
    PARSE THE ARRAY TO JSON (?) THEN SEND IT TO JAVASCRIPT BY STORING IT IN A VARIABLE
    (JAVASCRIPT)
    FOR EACH LOOP
        SE


It is also important na JS I think siya because kapag magseselect ka ng isang data from DBMANAGER.HTML.
It'll reflect sa notification/popup ng user what data is selected

========================================================== Beta Testing Preparation
Have a notice to users that their password is encrypted.
    For their safety and privacy.
    It should be a popup message after registration.


Regular
View thesis books 

Admin
View databases
Edit thesis databases

SUPERADMIN
Edit user and thesis database


Background: #14532d (Deep Green)
Text: #bbf7d0 (Light Green)

Background: #7f1d1d (Deep Red)
Text: #fecaca (Light Red)