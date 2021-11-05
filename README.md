# Database
## Config:
    Open env.php to config
## Import:
    Import file database/fronks.sql
# Model:
## Create model:
    1. Extends BaseModel.
    2. Model name should be table's name without 's'. If not, define static function get_db_name(), which return table's name.
    3. Create attributes for class. Name and order of attributes must be the same as table in database.
## Use model:
    1. Two build-in static function is all() and findById().
    2. Build-in non-static function is create(), save() and delete().
# Controller:
## Create controller:
    1. Extends BaseAdminController or BaseController
    2. In function __construct, init attribute 
        'folder' - which contains views
        'page' - Title of page
    3. Create other function to handle request
    4. Open route.php, in array $controller, add controller as a key and function in step 3 as values