<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(6); // Chiama il modello Project con all() recupera tutti i records della tabella associata, con orderByDesc('id') recupera in ordine discendente in base all' id.
        //dd($projects);

        return view('admin.projects.index', compact('projects')); // Crea un array associativo dove la chiave è il nome della variabile nella vista ('projects') e il valore è la variabile nel controller ($projects).
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request->all());

        // facciamo la validazione
        $val_data = $request->validated();

        // genera lo slug del projects
        $val_data['slug'] = Str::slug($request->title, '-');

        // aggiunge immagine se viene passata alla richiesta
        if ($request->has('thumb')) {
            $path = Storage::put('projects_thumb', $request->thumb);
            $val_data['thumb'] = $path;
        }

        //dd($val_data);
        // creiamo il nuovo progetto
        Project::create($val_data);
        return to_route('admin.projects.index')->with('message', 'Upload project created successfully'); //@if (session('messaggio')) nella view.
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //dd($project);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();

        if ($request->has('thumb')) {
            $path = Storage::put('projects_thumb', $request->thumb);
            $val_data['thumb'] = $path;
        }

        if (!Str::is($project->getOriginal('title'), $request->title)) {

            // NB: shuld check if it exists
            // update the project slug
            $val_data['slug'] = $project->generateSlug($request->title);
        }

        if ($request->has('type_id')) {
            $val_data['type_id'] = $request->type_id;
        }

        $project->update($val_data);
        return to_route('admin.projects.index')->with('message', 'Project updated successfully');
    }

    /* public function update(Request $request, Project $project)
    {
        $val_data = $request->all();
        $project->update($val_data);
        return redirect()->route('admin.projects.index', $project->id);
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->thumb) {
            Storage::delete($project->thumb);
        }

        $project->delete();
        return to_route('admin.projects.index')->with('message', 'Project deleted successfully');
    }
}
