# Sample Storefront SPA

Sample e-comerce application developed in [Lumen](https://lumen.laravel.com/docs) and [Vue.js](https://vuejs.org/)

## Setup

Install composer dependencies:
```
composer install
```
After installation download all npm dependencies:
```
npm install
```

## Testing

The application uses the vue devServer proxy to allow all backend routes
to be available from the frontend **only** via XHR/fetch requests.
Learn more about devServer proxy [here](https://webpack.js.org/configuration/dev-server/).
Just run `php artisan serve` and `npm run serve` and voila, the app should be up on `https://localhost:8080`.
> Using the vue-cli devServer, all vue front-end requests get not routed through lumen and associated middlewares.
> To test this behaviour just build the front-end using `npm run build` and run the lumen app using `php artisan serve`
