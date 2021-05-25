## Domain Checker

Both GUI and API implemented for CRUD of Domain records.

### Implemented Functionality

* app/Models/Domain.php - Domain record model
* app/Http/Controllers/DomainController.php - Controller for the UI portion
* app/Http/Resources/Domain[Collection]Resource.php - Resources for REST API implementation
* app/Jobs/Domain[Create|Update]Job.php - Jobs for Create and Update so we can queue actions that may take a while
* database/migrations/*[domains|jobs]_table.php - Migration table creation for domains and jobs
* resources/views/Layouts/App.blade.php - Base UI template for all views
* resources/views/Domains/*.blade.php - Specific views for different CRUD actions over UI
* routes/web.php - Add Resource route for UI implementation
* routes/api.php - Add routes for REST API implementation

### API Examples

`curl -H "Accept: application/json" http://localhost/api/domains | jq -r .`

`curl -X POST -H "Content-Type: application/json" -H "Accept: application/json" -d '{"domainName":"example.com","deliveredCount":0,"bouncedCount":0}' http://localhost/api/domains`

`curl -H "Accept: application/json" http://localhost/api/domains/1 | jq -r .`

`curl -X PUT -H "Content-Type: application/json" -H "Accept: application/json" -d '{"bouncedCount":1}' http://localhost/api/domains/1`

`curl -X DELETE -H "Accept: application/json" http://localhost/api/domains/1`
