# Note Plugin for OctoberCMS

**Background**  
This adds simple note management to application. If the AlbrightLabs.Client plugin is installed, this will extend it and add a notes tab to a single client view. Notes added via a client will only be attached to the client, but still visible from the notes controller.

**Features**  
- Store notes
- Add notes to clients (requires AlbrightLabs.Client plugin)

**Install**  
There are two options:
- `git clone https://github.com/albrightlabs/note-plugin.git plugins/albrightlabs/note` and run `php artisan october:up` or
- `git submodule add -b master https://github.com/albrightlabs/note-plugin.git plugins/albrightlabs/note` and run `php artisan october:up`

**Update**  
- `git pull origin master` or
- `git pull --recursive-submodules`

**Usage**  
Simply install plugin and access via navigation.

**Contribute**  
Feel free to fork and contribute to this plugin! Please email support@albrightlabs.com with any and all questions.
