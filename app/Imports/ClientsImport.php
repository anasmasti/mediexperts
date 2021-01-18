<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ClientsImport implements WithMultipleSheets, SkipsUnknownSheets
{
  use WithConditionalSheets;

    // MULTIPLE SHEETS
    public function conditionalSheets(): array
    {
        return [
            // spécifier les importation à partir du fichier Excel (Une ou Plusieurs feuilles)
            // + on a une seul feuille à importer c'est (clients)
            'clients' => new ClientsSheetImport(),
        ];
    }
    // END MULTIPLE SHEETS
    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }


}
