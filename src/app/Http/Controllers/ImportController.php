<?php

namespace App\Http\Controllers;

use App\Enums\ImportStatus;
use App\Enums\ImportType;
use App\Events\ImportCreated;
use App\Http\Requests\ImportStoreRequest;
use App\Models\Import\Import as ImportModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('imports.create', [
            'userImports' => auth()->user()->imports,
            'importTypes' => ImportType::toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ImportStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ImportStoreRequest $request): RedirectResponse
    {
        $fileName = $request->file('file')->store('import-files');

        /** @var ImportModel $importModel */
        $importModel = ImportModel::query()->create([
            'uploader_id' => auth()->id(),
            'file_name'   => $fileName,
            'import_type' => $request->input('importType'),
            'status'      => ImportStatus::default()
        ]);
        event(new ImportCreated($importModel));

        return redirect()->route('imports.create');
    }
}
