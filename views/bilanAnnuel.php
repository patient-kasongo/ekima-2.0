<?php
        \App\Authentification::accessBlocker();
        $idAnnee=$match['params']['idAnnee'] ?? \App\Annee::getAnneeInSession();
        $auth=new \App\Authentification(\App\Database::getPdo());
        $user=$auth->isConnect();
        $bilans=\App\Annee::getAnnuelBilan($idAnnee);
        $annee=\App\Annee::getAnneeById($idAnnee);

        $titre="Bilan global de l'année scolaire ".$annee->annee;
        $pathToFile=dirname(__DIR__).DIRECTORY_SEPARATOR."file".DIRECTORY_SEPARATOR;

        $spreadsheet=new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet=$spreadsheet->getActiveSheet();
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1',$titre);
        $sheet->setCellValue("A2", "Nom, postnom,prenom");
        $sheet->setCellValue("B2", "genre");
        $sheet->setCellValue("C2", "Classe");
        $sheet->setCellValue("D2", "Somme en chiffre");
        $sheet->setCellValue("E2", "Somme en toute lettre");
        $sheet->setCellValue("F2", "Motif");
        $sheet->setCellValue("G2", "Date de payement");
        $i=3;
        foreach ($bilans as $bilan){
            $A='A'.(string)$i;

            $sheet->setCellValue($A, $bilan->nom.' '.$bilan->postnom.' '.$bilan->prenom);
            $sheet->setCellValue('B'.(string)$i, $bilan->sexe);
            $sheet->setCellValue('C'.(string)$i, $bilan->nomPromotion.' '.$bilan->nomOption);
            $sheet->setCellValue('D'.(string)$i, $bilan->sommeEnChiffre.' $');
            $sheet->setCellValue('E'.(string)$i, $bilan->sommeEnLettre);
            $sheet->setCellValue('F'.(string)$i, $bilan->motif.' '.$bilan->mois);
            $sheet->setCellValue('G'.(string)$i, $bilan->dateDuJour);
            $i++;
        }
        $writer= new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $nameofFile="bilan-".date('Y-m-d-H-i-s').'-.xlsx';
        $file_path=$pathToFile.$nameofFile;
        $writer->save($file_path);

        if(file_exists($file_path)){
            ob_start();
            // Définir les en-têtes HTTP pour le téléchargement

            header('Content-Description: File Transfer');
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));

            // Lire le fichier et le transmettre au navigateur

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file_path);
            $spreadsheet = $reader->load($file_path);
            $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save('php://output');
            ob_end_flush();
            exit();
        }
