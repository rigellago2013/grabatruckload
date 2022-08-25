# grabatruckload

# Dev setup
- clone this repo
- create local database `grabatruckload`
- copy .env.example to .env and change any settings if required
- php artisan migrate:fresh --seed
- php artisan serve (or use laravel valet on mac)
    
# Workflow
- every commit must pass `composer check`
- every commit must have tests
- use Action classes for *everything* related to business logic, and data retrieval. Feel free to combine actions in other actions - please see
  https://stitcher.io/blog/laravel-beyond-crud-03-actions (I also have the course if anyone is interested)
- use Data Transfer Objects for moving parameters and data around the system
- no logic in controllers
- thin models
- use ViewModels to organise data for templates (see spatie package or https://laravel.com/docs/8.x/views#view-composers)
- Blade UI components - these are criticial to keeping the UI tidy. Please read up on them.

