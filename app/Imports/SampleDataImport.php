<?php

namespace App\Imports;

use Log;
use App\Models\Produit;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToArray;

class SampleDataImport implements ToArray
{
    /**
     * @param Collection $collection
     */
    public function array(array $data)
    {
        $importationWord = "IMPORTATION DES PRODUITS";
        $exportationWord = "EXPORTATION DES PRODUITS";
        $isImportationSection = false;
        $isExportationSection = false;

        $anneeWord = "ANNEES";
        $annees = [];

        for ($i = 0; $i < count($data); $i++) {
            for ($j = 0; $j < count($data[$i]) - 1; $j++) {

                if (strpos($data[$i][$j], $importationWord) !== false) {
                    $isImportationSection = true;
                    echo 'Data importation...';
                }
                if ($isImportationSection) {

                    if (strpos($data[$i][$j], $anneeWord) !== false) {
                        for ($a = 2; $a < count($data[$i]); $a += 2) {
                            $annees[] = $data[$i][$a];
                        }

                        // Traitement lignes de données
                        for ($i = 2; $i < count($data); $i++) {
                            $code = $data[$i][0];
                            $libelle = $data[$i][1];

                            for ($j = 2, $z = 0; $j < count($data[0]); $j += 2, $z++) {
                                $valeur_caf = $data[$i][$j];
                                $poids_net = $data[$i][$j + 1];
                                $annee = $annees[$z];

                                if (empty($code)) {
                                    continue;
                                }

                                $codeExiste = Produit::where('code', $code)->exists();

                                if (!$codeExiste) {
                                    if ($code != null) {
                                        if ($libelle == null) {
                                            $libelle = ""; # Valeur par défaut
                                        }
                                        if ($poids_net == null) {
                                            $poids_net = 0;
                                        }
                                        if ($valeur_caf == null) {
                                            $valeur_caf = 0;
                                        }

                                        try {
                                            Produit::create([
                                                'code' => $code,
                                                'libelle' => $libelle,
                                                'annee' => $annee,
                                                'valeur_caf' => $valeur_caf,
                                                'poids_net' => $poids_net,
                                            ]);
                                            echo ('valider');
                                        } catch (\Exception $e) {
                                            echo ("Erreur lors de la création de l'enregistrement");
                                        }
                                    } else {
                                        echo ("Le produit est déjà enregistrer dans la base de données");
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo 'export';
                }
            }
        }
    }
}
