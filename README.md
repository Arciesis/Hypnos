# Hypnos project for Studi ECF

### How to run localy
run `git clone https://github.com/Arciesis/Hypnos.git`
to create a local repository

run `composetr install`
to install the bundles

configure your DB:
You need to modify (or create) the .env file in the root directory
`DATABASE_URL="mysql://db_user:password@127.0.0.1:3306/db_name?serverVersion=8.0.28&charset=utf8mb4"`

If your want to use a custom user / password to manage your database loggin with Admin privileges into MySQL:
`mysql -u root -p` and then type your password
run `CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';`

To grant privileges only on the hypnos database run:
`CREATE DATABASE hypnosDB;`
`GRANTS ALL PRIVILEGES ON hypnosDB.* TO 'your_user'@'localhost';`

then logout and loggin with the created user to take effect:
`EXIT;`

`mysql -u your_user -p`

To test if it is okay run:
`SHOW DATABASES;`
it must prompt: 

```
+--------------------+
| Database           |
+--------------------+
| hypnosDB           |
| information_schema |
+--------------------+
2 rows in set (0.00 sec)
```
### Create an Administrator (Usefull ???)
run `php bin/console security:hash-password`

and type `0`

> Note: We need to do this because symfony 5.4 uses argon2 to secure the password with the security bundle 
> for security reason.

then type your password (nothing will prompt it's normal)
At the end, you have and '$2y$13...' password it's the password to use in the further SQL command.

open an mysql instance and run
`INSERT IGNORE INTO user (email, roles, password, firstname, lastname) VALUES ('your_email',"ROLE_ADMIN"','your-hashed_password','your_name','your_lastname');`
That will cerate the admin.

