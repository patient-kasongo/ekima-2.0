<?php
        \App\Authentification::accessBlocker();
        $auth=new \App\Authentification(\App\Database::getPdo());
        $user=$auth->isConnect();
        $bilans=\App\Annee::getAnnuelBilan(3);
        $annee=\App\Annee::getAnneeById(3);
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
            $B='B'.(string)$i;
            $C='C'.(string)$i;
            $D='D'.(string)$i;
            $E='E'.(string)$i;
            $F='F'.(string)$i;
            $G='G'.(string)$i;

            $sheet->setCellValue($A, $bilan->nom.' '.$bilan->postnom.' '.$bilan->prenom);
            $sheet->setCellValue($B, $bilan->sexe);
            $sheet->setCellValue($C, $bilan->nomPromotion.' '.$bilan->nomOption);
            $sheet->setCellValue($D, $bilan->sommeEnChiffre.' $');
            $sheet->setCellValue($E, $bilan->sommeEnLettre);
            $sheet->setCellValue($F, $bilan->motif.' '.$bilan->mois);
            $sheet->setCellValue($G, $bilan->dateDuJour);
            $i++;
        }
        $writer= new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $nameofFile="bilan-".date('Y-m-d-H-i-s').'.xlsx';
        $file_path=$pathToFile.$nameofFile;
        $writer->save($file_path);

        if(file_exists($file_path)){
            // Définir les en-têtes HTTP pour le téléchargement

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
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
        }

        //$route=isset($router) ? $router->generate('home') : '/public/login';
        //$user->redirectUser($route);