# LBlog
LBlog is a blog app that is built off the **Laravel Web Framework**. The following provides instructions on how to run the project on **Windows OS**, you will need to configure the Virtual Hosts differently for other OS.

## Prerequisites
You will need to have an installation of the following items in order to run this project.

* PHP
* Composer
* Apache HTTP Server
* Relational Database Server (MySQL, PostgreSQL, etc.)

## Getting Started
Install Composer Dependencies & NPM Dependencies

```bash
  $ composer install
  $ npm install
```

## Environmental Variables
### Env File
Create a .env file in the root directory, and copy the contents below.

```
APP_NAME=LBlog
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=...
DB_HOST=...
DB_PORT=...
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Database Variables
You will need to populate the database variables with your database credentials `DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD`.

For `DB_DATABASE`, the value is the name of your database (MySQL, PostgreSQL, SQL Server). When using SQLite, the value should be the absolute path to your database file.

For `DB_CONNECTION`, use one of these values based on the relational database management system you're using:

|Database Management System|Value|
|---|---|
|MySQL|`mysql`|
|PostgreSQL|`pgsql`|
|SQLite|`sqlite`|
|SQL Server|`sqlsrv`|

### Generating APP_KEY
Use the following artisan command to generate and set the APP_KEY.

```bash
  $ php artisan key:generate
```

## Configuring the Virtual Hosts
You will need to configure your Apache HTTP Server and your OS to point to the project's `/public` folder.

### Apache
Locate your Apache HTTP Server installation folder. And edit the following file:

`apache/conf/extra/httpd-vhosts.conf`

Append the following to the bottom of the file.

```properties
...
...
...
  <VirtualHost *:80>
    DocumentRoot "{% absolute_path_to_project's_public_folder %}"
    ServerName lblog.test
  </VirtualHost>
```
Next, locate and edit the following file using an elevated text editor (Run as Administrator).

`C:\Windows\System32\drivers\etc\hosts`

Append the following to the botom of the file.

```
...
...
...
127.0.0.1 lblog.test
```

## Migrating the Database
Run the Database migration to prepare the tables necessary for the application's functionalities

```bash
  $ php artisan migrate
```

## Seeding the Database (Optional)
You can populate the database with some fake data to begin with. The database seeding will provide:

* 5 Users (The last one is the Demo Account)
* 40 Posts (The post belong to the first 4 users; `id: 1-4`)
* 80 Comments (The comments belong to the first 20 posts; `id: 1-20`)

You can seed the database using the following command:

```bash
  $ php artisan db:seed
```

## Hopefully it worked
Then restart your Apache Server and try visiting [lblog.test](http://lblog.test). If nothing went wrong. It should work :pray:.