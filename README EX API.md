# TRACCIA

Continuiamo a lavorare sul codice dei giorni scorsi, ma in una nuova repo.
L'esercizio di oggi è suddiviso in milestone ed è importante che ne seguiate l'ordine.

## Milestone 1

nome repo 1: laravel-api
Aggiungiamo al nostro progetto Laravel una nuovo Api/ProjectController. Questo controller risponderà a delle richieste via API e si occuperà di restituire la lista dei progetti presenti nel database in formato json.

## Milestone 2

Testiamo la chiamata API tramite Postman e assicuriamoci di ricevere i dati correttamente.

## Milestone 3

nome repo 2: vite-boolfolio
Iniziamo ad occuparci della parte front-office della nostra applicazione: creiamo un nuovo progetto Vue 3 con Vite e installiamo axios.
Colleghiamo questo progetto ad una repo separata.

## Milestone 4

Nel componente principale della nostra Vue App facciamo una chiamata API all'endpoint costruito nel progetto Laravel (milestone 1) e recuperiamo tutti i progetti dal nostro back-end.
Stampiamo in console i risultati e verifichiamo di ricevere i dati correttamente.

## Milestone 5

Creiamo un nuovo componente ProjectCard, che corrisponde ad una card per visualizzare un progetto. Utilizziamo questo componente per visualizzare tutti i progetti ricevuti tramite API.

## Bonus:

Gestire la paginazione dei risultati

# SVOLGIMENTO

-   Nei precedenti esercizi abbiamo stampato i projects in una tabella a schermo nell'index quello che vogliamo fare è spostare la parte grafica nel front-office quindi in vue+vite, quindi dobbiamo fare un API e creare una nuova repository che sarà in Vue+vite e riceverà da questa repository tramite API del jason che conterrà i vari projects.

-   per prima cosa andiamo in api.php e togliamo la rotta dell'autenticazione che non ci serve.
-   ci creiamo un un resource controller per l'API che esclude il create e l'edit:

```
php artisan make:controller Api\ProjectController --api
```

-   fatto il controller in api.php dobbiamo scrivere le rotte:

```php
// # CI IMPORTIAMO IL CONTROLLER DELL'API
use App\Http\Controllers\Api\ProjectController;

// # ROTTA DELL'API CONTROLLER RESOURCE CHE USA SOLO DUE ROTTE INDEX E SHOW
Route::apiResource("projects", ProjectController::class)->only(["index", "show"]);
```

-   poi andiamo nel metodo index del Api\ProjectController:

```php
    public function index()
    {
        $projects = Project::select("id", "name", "link", "type_id", "description", "cover_image")
            ->paginate(20);

        return response()->json($projects);
    }
```

-   ora apriamoci un nuova repo in vue+vie 'vite-boolfolio' che sarà il nostro front-office.

-   come abbiamo detto nell'esercizio del front-office dobbiamo passare le tecnologies e i types
    quindi andiamo in Api/ProjectController.php

```php
    // AGGIUNGIAMO IL WITH ALLA INDEX E GLI DICIAMO CHE COLONNE DEVE PRENDERE
    $projects = Project::select("id", "name", "link", "type_id", "description", "cover_image")
         ->with('type:id,label,color', 'technologies:id,label,color', ) <-----
         ->paginate(12);
```

-   possiamo tornare sul front-office.
-   aggiungiamo questo nella show per il dettaglio della pagina

```php
    public function show($id)
    {
    $project = Project::select("id", "name", "link", "type_id", "description", "cover_image")
    ->where('id', $id)
    ->with('type:id,label,color', 'technologies:id,label,color', )
    ->first();

          return response()->json($project);

    }
```

-   possiamo tornare sul front-office.
