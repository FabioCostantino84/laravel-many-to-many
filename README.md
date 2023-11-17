#### SoftDeletes

- Model Name implementare use SoftDeletes e relativo percorso se non implementata in automatico

- creare una migrazione con php artisan make:migration add_delete_at_column_to_projects_table

- dentro la migrazione, nello schema::table inserire $table->SoftDeletes() e in down() $table->dropSoftDeletes()

- eseguire la migrate per generare la colonna nel db php artisan migrate

- controllare in phpMyAdmin se presente la colonna con valore di default NULL

- aprire il server virtuale e provare a cancellare un project e in phpMyAdmin verificare se al posto di NULL è stata inseritaa la data di cancellazione

- creare una route e una nuova page recycle

- in web.php creare una rotta Route::get('recycle', [ProjectController::class, 'recycle'])->name('project.recycle');

- public function recycle() {$trashed = Project::onlyTrashed()->orderByDesc('id')->paginate('10');
      return view('admin.projects.recycle', compact('trashed'));
  }

- dopo aver creata il layout nella page recycle aggiungere un btn con route('project.restore') per riportare in index i progetti cancellati temporaneamente

- creare un function restore nell ProjectController

- creare Route::get('project/{id}/restore',[ProjectController::class, 'restore'])->name('project.restore'); //se scrivo ->name('projects.restore') il percorso sarà admin.projects.restore

- creo in layouts/admin.blade.php un link alla pagina recycle

    <a class="nav-link text-white {{ Route::currentRouteName() == 'project.recycle'}}" href="{{route('project.recycle')}}">
        <i class="fa-solid fa-dumpster fa-lg fa-fw"></i> Trashe
    </a>