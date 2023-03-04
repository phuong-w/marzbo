# Marzbo

<p align="center"><a href="https://www.k-hgc.com" target="_blank"><img src="https://www.k-hgc.com/img/logo/khgc-logo-black.svg" width="400"></a></p>

## About This Project

This is the project for **Marzbo** by **KHGC**. This project is built with:

-   **[Laravel](https://laravel.com/)**
-   **[Laravel Livewire](https://laravel-livewire.com/)**
-   **[Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v9/introduction)**
-   **[Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)**

## Getting started

### Prerequisites

-   PHP ^8.1
-   Latest [Node.js](https://nodejs.org) version
-   Docker
-   Composer v2.5.4

### Installing

#### Manual

```bash
# Clone the project and run composer


# Install the composer packages
composer install

# Copy the .env.example file to .env
cp .env.example .env

# Remember to setup your DB settings in .env
# Migration and DB seeder (after changing your DB settings in .env)
php artisan migrate --seed

# Run the Vite development server...
npm run dev
```

#### With Docker

```bash
# Clone the project and run composer


# We need to copy the .env.example file to .env first (!!important)
cp .env.example .env

# Run the sail with path
./vendor/bin/sail up -d
```

-   Or You can configuring a shell alias

```sh
# Run command
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

# Run the sail
sail up -d
```

### Final steps

Add **marzbo.local** to your **hosts** file.

Go to [marzbo.local](http://marzbo.local) to access the website.

## Running the tests

-   Tests system is under development

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Authors

-   **Steven** - _Initial Work_

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE) file for details.
