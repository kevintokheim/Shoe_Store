# Shoe Store Database app with MySQL

##### Shoe Store App, 8/28/15

#### Kevin Tokheim

## Status
Almost fully functional. All methods pass tests for Store and Brand classes. Store has been written with full CRUD functionality. Update and Delete routes in Silex not quite working for the individual store page.

## Description

This application allows the user to see a list of local shoe stores, as well as the brands carried by those stores. The user can also add stores and brands.

## Setup

* First clone the repository using the line:
```console
$ git clone https://github.com/kevintokheim/Shoe_Store.git
```
* In the project directory run the following to install the composer:
```console
$ composer install
```
* Start your local host in the web folder using:
```console
$ php -S localhost:8000
```
* Unzip **shoe_store.sql.zip** import it to your local server.
* Navigate your browser to **localhost:8000**
* To run tests using PHPUnit, create a copy of the database called **library_test** with phpmyadmin.

## Database Commands
* started MySQL server by typing mysql.server start in your terminal
* type mysql -uroot -proot
* CREATE DATABASE shoes;
* USE shoes;
* CREATE TABLE stores (id serial PRIMARY KEY, store_name varchar (255));
* CREATE TABLE brands (id serial PRIMARY KEY, brand_name varchar (255));
* CREATE TABLE stores_brands (id serial PRIMARY KEY, store_id (int), brand_id (int));
* Type 'apachectl start' in your terminal to start the apache server
* go to the URL localhost:8080/phpmyadmin and enter 'root' for both the username and password
* create a copy of the shoes database and call it 'shoes_test,' with the option structure only.

## Technologies Used

PHP, PHPUnit, Silex, Twig, Bootstrap and MySQL

### Legal

Copyright (c) 2015 Kevin Tokheim

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
