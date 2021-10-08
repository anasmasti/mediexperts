<?php

namespace App\Imports;

use App\Personnel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PersonnelsImport implements ToModel, WithValidation, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Personnel|null
     */
    public function model(array $row)
    {
        return new Personnel([
            'cin' => str_replace(" ", "", $row["cin"]),
            'matricule' => $row["matricule"],
            'nom' => $row["nom"],
            'prenom' => $row["prenom"],
            'cnss' => $row["cnss"],
            'dt_naiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["dt_naiss"]),
            'dt_embch' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["dt_embch"]),
            'dt_demiss' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["dt_demiss"]),
            'fonction' => $row["fonction"],
            'csp' => $row["csp"],
            'etat' => $row["etat"],
            'nrc_e' => $row["nrc_e"],
        ]);
    }

    public function rules(): array {
        return [
            'cin' => 'required|max:50',
            'matricule' => 'required|max:50',
            'nom' => 'required|max:50',
            'prenom'  => 'required|max:50',
            'cnss' => 'required|max:50',
            'dt_naiss' => 'nullable',
            'dt_embch' => 'nullable',
            'dt_demiss' => 'nullable',
            'fonction' => 'required|max:100',
            'csp' => 'required|max:50',
            'etat' => 'max:20',
            'nrc_e' =>  'required|max:20'
        ];
    }
}

