# Proyecto PC Global - Laravel

## Description

**PCGlobal** is a comprehensive platform designed for the management and operation of a store specialized in electronic components. The system is structured into several modules that facilitate a cohesive and functional user experience, allowing the execution of various essential business operations.

**Main Modules:**

- **Inventory**: Allows for the management and monitoring of available electronic components, offering a clear view of stock levels and the ability to make updates based on product inflow and outflow.

- **Purchase and Sale**: This module handles the entire transaction process, from component selection to purchase completion. Additionally, it provides tools for managing sales, discounts, and promotions.

- **PQRS (Petitions, Complaints, Claims, and Suggestions)**: A dedicated channel for customers to directly communicate with the PCGlobal team, ensuring their concerns and feedback are addressed promptly.

Additionally, PCGlobal features a robust authentication system, ensuring data security and allowing users to carry out operations with confidence.

Developed with adaptability and growth in mind, PCGlobal stands as the ideal solution for electronic component stores looking to modernize and optimize their operations.

## Tecnologies used

#### Backend:
- **Laravel 10**: PHP web development framework.
- **Fortify**: Laravel's authentication library.
- **Carbon**: PHP library for date manipulation.
- **Intervention image**: PHP library for image manipulation.

#### Frontend:
- **Tailwind**: CSS framework for rapid and responsive design.

## Developers' Information

* **Work Group**: 2686374-2

* **Subgroup**: GAES 3

### Developers' Full Names

* **Daniel Espitia**: [Perfil](https://github.com/DanielEspitia1507)

* **Damián Felipe Rengifo Rincon**: [Perfil](https://github.com/DamianRengifo)

* **Gaby Puerto**: [Perfil](https://github.com/gabypuertor964)


## Installation

* **Composer Dependences**: `composer install`
* **NPM Dependences**: `npm install`
* **Create enviroment file**: `cp .env.example .env`
* **Generate APP_KEY**: `php artisan key:generate`
* **Execute migrations**: `php artisan migrate`
* **Execute Seed**: `php artisan db:seed`
* **Generate storage link**: `php artisan storage:link`
* **Execute Resource Compilation**: `npm run build`
* **Create Account Gerency**: `php artisan create-generency-account`

## Extensions and Libraries

* **Zip**: Enables ZIP file manipulation for efficient compression and decompression in web applications.
* **GD**: Provides image manipulation functions, essential for dynamic graphic generation in web development.