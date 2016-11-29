# Observations

The syntax rules for the PHP-Postgres API are much stricter than those for PDO.

I would not have been able to find the =<<< EOF operations on Postgres queries on my own.

While I understand that the point of this lab is for us to figure things out on our own, some of these things seem trivial, such as not being able to specify the size of int columns.

Another example of this is that EOF in each sql command can't have tab characters in front of them.

# References

http://php.net/manual/en/function.pg-query.php
http://php.net/manual/en/function.pg-connect.php
https://www.tutorialspoint.com/postgresql/postgresql_create_database.htm
http://stackoverflow.com/questions/6588174/enabling-postgresql-support-in-php-on-mac-os-x
http://stackoverflow.com/questions/3942759/whats-the-escape-sequence-for-hyphen-in-postgresql
http://php.net/manual/en/pdostatement.fetchall.php
http://stackoverflow.com/questions/40728727/postgresql-and-php-prepared-statements
http://de2.php.net/manual/en/function.var-export.php
http://php.net/manual/en/function.pg-execute.php
http://php.net/manual/en/function.pg-prepare.php
http://stackoverflow.com/questions/26657928/error-column-must-appear-in-the-group-by-clause-or-be-used-in-an-aggregate-func
http://php.net/manual/en/function.implode.php
http://stackoverflow.com/questions/10258345/php-simple-foreach-loop-with-html
http://v4-alpha.getbootstrap.com/content/tables/