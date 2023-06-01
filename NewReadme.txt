Code to refactor
=================
1) app/Http/Controllers/BookingController.php

We can do code much better then this, 
1- you can also take model in BookingController function __construct for set model one time, so that we can not call it controller again and again.
2- you can set user/admin roles id on database for better code.
3- you can set name ( $this->repository) with $this->booking for understanding
4- in store function for authentication set this in __construct, by this you can not call or use it again and again
5- for immediateJobEmail you can make a proper event so you can call it globaly
6- in distanceFeed function you can use WHEN rather then if/else
7- try/catch in all funcitons
8- make same reponses globaly

2) app/Repository/BookingRepository.php

1- call models one time
2- use DB Transactions for revert entry if goes wrong
3- use try/catch
4- don't send request from controller to repository
5- use when request rather than too much if else

I will show you my code for example:

Shelter Controllers
Shelter Repository
Filters

this is just a short example, i made a huge project :
1- Multi vendor
2- Ecommerce

using Vue 3 for admin/vendor/shelter portals and Nuxt 3 for User Web with laravel 9
