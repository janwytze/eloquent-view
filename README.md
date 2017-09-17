# Eloquent view
With Eloquent view you can create a SQL view with the eloquent query builder.
This will prevent huge SQL strings in your migrations.  

## Installation
Run `composer require jwz104/eloquent-view`.

Add the service provider to `config/app.php`:
```
'providers' => [
    Jwz104\EloquentView\EloquentViewServiceProvider::class,
]
```

Optionally add the facade:
```
'aliases' => [
    'EloquentView' => Jwz104\EloquentView\Facades\EloquentView::class,
]
```

## How to use
Eloquent view is really easy to use.  
Just parse a builder instance to the create method of the view builder.

Example migration:
```
class CreateEmployeesView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $builder = DB::table('employees')
            ->join('companies', 'employees.company_id', '=', 'companies.id')
            ->select('employees.*', 'companies.name');

        EloquentView::create('employees_view', $builder);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        EloquentView::dropIfExists('employees_view');
    }
}
```
