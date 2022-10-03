# Laravel Paytabs boilerplate

This project introduces a basic implemetation of [laravel-paytabs](https://github.com/devinweb/laravel-paytabs).

To start testing this project

1- Migrate the database.

```shell
php artisan migrate
```

2- Update the `.env`

```shell
PAYTABS_SERVER_KEY=your-server-key
PAYTABS_PROFILE_ID=your-profile-id
# default SAR
CURRENCY=
PAYTABS_REGION=
# default https://secure.paytabs.sa/
PAYTABS_API=
```

3- Create your first user.

4- Navigate to the route `/transactions/create` or click "عملية جديدة".
