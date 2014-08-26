1. go to assets/sql/wsdc_students.sql and import the file (it's a database with 3 tables)
2. create an account
3. to activete the newly created account, set the active column value correspoing to the new account to '1' (table: student: auth)
4. php error are logged. (location: applications/config/logs/*.txt)
5. Only for linux users: set the permission of applications/config/logs/ folder to 777.

**NOTE: rename applications/config/database.php.example to applications/config/database.php 