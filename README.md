# Client Locations Plugin for OctoberCMS

**Background**  
This plugin extends the Albright Client plugin and is used to add multiple note support to single clients. If the Albright Client plugin is not installed, the system can store general notes.

**Features**  
- Simple note storage and management
- Attach many notes to clients

**Install**  
There are two options:
- `git clone https://github.com/albrightlabs/note-plugin.git plugins/albrightlabs/note` and run `php artisan october:up` or
- `git submodule add -b master https://github.com/albrightlabs/note-plugin.git plugins/albrightlabs/note` and run `php artisan october:up`

**Update**  
- `git pull origin master` or
- `git pull --recursive-submodules`
