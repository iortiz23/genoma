<?php

/**
 * Description of loadFiles
 *
 * @author Sneider Rocha
 */
class loadFiles {

    public function createFileVarient($_inputFile) {
        $uploads_dir = '../class/loadFiles/files';
        $newName = pathinfo($_inputFile["name"], PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($_inputFile["name"], PATHINFO_EXTENSION);
        $resultado = move_uploaded_file($_inputFile["tmp_name"], "$uploads_dir/$newName");
        $result = array(
            'result_move_uploaded_file' => $resultado,
            'nameFile' => $newName,
            'uploads_dir' => $uploads_dir,
            'uploads_dir_complete' => "$uploads_dir/$newName",
            'extension' => pathinfo($_inputFile["name"], PATHINFO_EXTENSION),
        );

        return $result;
    }

    public function readDataFileVarient($_inputFileData) {
        $uploads_dir = '../class/loadFiles/files';
        $newName = pathinfo($_inputFile["name"], PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($_inputFile["name"], PATHINFO_EXTENSION);
        return $resultado = move_uploaded_file($_inputFile["tmp_name"], "$uploads_dir/$newName");
    }

    public function insertDataFileVarient($_inputFile) {
        $uploads_dir = '../class/loadFiles/files';
        $newName = pathinfo($_inputFile["name"], PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($_inputFile["name"], PATHINFO_EXTENSION);
        return $resultado = move_uploaded_file($_inputFile["tmp_name"], "$uploads_dir/$newName");
    }

}
