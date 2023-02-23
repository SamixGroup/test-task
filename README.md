


## Test task

Steps to install dependencies and run application: 
- Install packages via `composer install`
- Copy the content of .env.example to .env and set database credentials
- Run `php artisan key:generate` to generate an application key
- Run migrations via `php artisan migrate`
- Seed db with `php artisan db:seed` and you will get credentials of a random user 
- Use console command to authorize. Use `php artisan command:authorize --help` to get information about this command or simply run `php artisan command:authorize {email} {password}` with data from 5th step
- Run `php artisan l5-swagger:generate` to generate api docs. Next time it will automatically update docs on refresh. Follow {host}/api/documentation
