<?php
include($_SERVER['DOCUMENT_ROOT'] . "/genoma/vendor/autoload.php");
//require '../vendor/autoload.php';

//require_once('../../CapturaInformacion.class.php');
//require_once('../DataBase.class.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * Description of loadFiles
 *
 * @author Sneider Rocha
 */
class loadFiles extends IOFactory
{
    public function __construct()
    {
        $this->database = DataBase::getDatabaseObject(DataBase::MYSQL);
    }

    public function createFileVarient($_inputFile)
    {
        $uploads_dir = '../class/loadFiles/files';
        $newName = pathinfo($_inputFile["name"], PATHINFO_FILENAME) . '-' . uniqid() . '.' . pathinfo($_inputFile["name"], PATHINFO_EXTENSION);
        $resultado = move_uploaded_file($_inputFile["tmp_name"], "$uploads_dir/$newName");
        $rs =
            $result = array(
                'result_move_uploaded_file' => $resultado,
                'nameFileOld' => $_inputFile["name"],
                'nameFileNew' => $newName,
                'uploads_dir' => $uploads_dir,
                'uploads_dir_complete' => "$uploads_dir/$newName",
                'extension' => pathinfo($_inputFile["name"], PATHINFO_EXTENSION),
            );

        return $result;
    }

    public function readDataFileVarient($_inputFileData)
    {
        $document =  IOFactory::load($_inputFileData['uploads_dir_complete']);
        $hoja = $document->getSheet(0);
        foreach ($hoja->getRowIterator() as $fila) {
            $query = "";
            foreach ($fila->getCellIterator() as $celda) {
                $valRow = $celda->getValue();
                $fila = $celda->getRow();
                $columna = $celda->getColumn();

                if ($fila == "1") {
                    $resulvalidateHeaderExcel = $this->validateHeaderExcel($columna, $valRow, $_inputFileData['typeLoad']);
                    if ($resulvalidateHeaderExcel === 'ERROR') {
                        $result = array(
                            'idLoad' => $_inputFileData['idLoad'],
                            'columna' => $columna,
                            'fila' => $fila,
                            'result' => 'ERROR_FORMATO_ENCABEZADOS',
                        );

                        $this->delateLocalFileVarient($_inputFileData);
                        $captura = new CapturaInformacion();
                        $captura->updateStateLoad($_inputFileData['idLoad'], 3, 0, $fila);

                        return $result;
                    }
                } else {
                    $query = $query . "'$valRow',";
                }
            }

            if ($query != "") {
                if ($_inputFileData['typeLoad'] === '1') {
                    $resulInsertData = $this->insertDataFileVarient($query, $_inputFileData['idLoad']);
                } elseif (($_inputFileData['typeLoad'] === '2')) {
                    $resulInsertData = $this->insertDataFileIllness($query, $_inputFileData['idLoad']);
                } else {
                    $resulInsertData = $this->insertDataFileMedicine($query, $_inputFileData['idLoad']);
                }

                if ($resulInsertData === 0) {
                    $result = array(
                        'idLoad' => $_inputFileData['idLoad'],
                        'columna' => 0,
                        'fila' => $fila,
                        'result' => 'CARGUE_NO_COMPLETADO',
                    );
                    $this->delateLocalFileVarient($_inputFileData);
                    $captura = new CapturaInformacion();
                    $captura->updateStateLoad($_inputFileData['idLoad'], 2, 0, $fila);
                    return $result;
                }
            }
        }
        $result = array(
            'idLoad' => $_inputFileData['idLoad'],
            'columna' => $columna,
            'fila' => $fila,
            'result' => 'EXITOSO',
        );
        $this->delateLocalFileVarient($_inputFileData);
        $captura = new CapturaInformacion();
        $captura->updateStateLoad($_inputFileData['idLoad'], 1, 1, $fila);

        return $result;
    }

    public function validateHeaderExcel($_column, $_value, $_typeLoad)
    {

        if ($_typeLoad === '1') {
            $headers = array(
                'A' => 'Muestra',
                'B' => 'Cr.:Posición',
                'C' => 'Gen',
                'D' => 'Variante Transcripto',
                'E' => 'Variante Proteina',
                'F' => 'Efecto',
                'G' => 'ACMG',
                'H' => 'gnomAD Exome',
                'I' => 'gnomAD Genome',
                'J' => 'Frequency ExAC',
                'K' => 'Cigosidad',
                'L' => 'Coverage',
                'M' => 'FS',
                'N' => 'GQ',
                'O' => 'Qual',
                'P' => 'RefSeq',
                'Q' => 'ID dbSNP',
                'R' => 'Comment',
            );
        } elseif ($_typeLoad === '2') {
            $headers = array(
                'A' => 'ENFERMEDAD',
                'B' => 'BUSQUEDA',
                'C' => 'NILVEL DE EVIDENCIA MATCHGÉNICA',
                'D' => 'FUENTE',
            );
        } else {
            $headers = array(
                'A' => 'Gene',
                'B' => 'Drug',
            );
        }


        if ($headers[$_column] != $_value) {
            $result = "ERROR";
        } else {
            $result = "EXITOSO";
        }
        return $result;
    }
    public function insertDataFileVarient($_query, $_idLoad)
    {
        $_queryNow = "SELECT now() as 'DataTime'";
        $data = $this->database->query(utf8_decode($_queryNow));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_now = $row['DataTime'];
        }
        $_queryIdData = "SELECT max(IdDataLoadVari) as IdDataLoadVari FROM tb_dataloadvariants"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";

        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadVariOld = $row['IdDataLoadVari'];
        } else {
            $_IdDataLoadVariOld = 0;
        }
        $queryInsertData = "INSERT INTO tb_dataloadvariants("
            . " Muestra,"
            . " CrPosicion,"
            . " Gen,"
            . " VarianteTranscripto,"
            . " VarianteProteina,"
            . " Efect,"
            . " ACMG,"
            . " gnomADExome,"
            . " gnomADGenome,"
            . " FrequencyExAC,"
            . " Cigosidad,"
            . " Coverage,"
            . " FS,"
            . " GQ,"
            . " Qual,"
            . " RefSeq,"
            . " IDdbSNP,"
            . " Comments,"
            . " IdLoad,"
            . " DateCreate)"
            . " VALUES ("
            . $_query
            .  $_idLoad . ","
            . "'" . $_now . "'"
            . ")";

        $this->database->nonReturnQuery($queryInsertData);

        $_queryIdData = "SELECT max(IdDataLoadVari) as IdDataLoadVari FROM tb_dataloadvariants"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";
        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadVariNew = $row['IdDataLoadVari'];
            if ($_IdDataLoadVariNew > $_IdDataLoadVariOld) {
                $result = $_IdDataLoadVariNew;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }
    public function insertDataFileIllness($_query, $_idLoad)
    {
        $_queryNow = "SELECT now() as 'DataTime'";
        $data = $this->database->query(utf8_decode($_queryNow));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_now = $row['DataTime'];
        }
        $_queryIdData = "SELECT max(IdDataLoadIllness) as IdDataLoadIllness FROM tb_dataload_illness"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";

        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadIllnesOld = $row['IdDataLoadIllness'];
        } else {
            $_IdDataLoadIllnesOld = 0;
        }
        $queryInsertData = "INSERT INTO tb_dataload_illness("
            . " NameIllness,"
            . " Search,"
            . " LevelMatchgenicEvidence,"
            . " Source,"
            . " IdLoad,"
            . " DateCreate)"
            . " VALUES ("
            . $_query
            .  $_idLoad . ","
            . "'" . $_now . "'"
            . ")";

        $this->database->nonReturnQuery($queryInsertData);

        $_queryIdData = "SELECT max(IdDataLoadIllness) as IdDataLoadIllness FROM tb_dataload_illness"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";
        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadVariNew = $row['IdDataLoadIllness'];
            if ($_IdDataLoadVariNew > $_IdDataLoadIllnesOld) {
                $result = $_IdDataLoadVariNew;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }

    public function insertDataFileMedicine($_query, $_idLoad)
    {
        $_queryNow = "SELECT now() as 'DataTime'";
        $data = $this->database->query(utf8_decode($_queryNow));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_now = $row['DataTime'];
        }
        $_queryIdData = "SELECT max(IdDataLoadMedicine) as IdDataLoadMedicine  FROM tb_dataload_medicine"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";

        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadIllnesOld = $row['IdDataLoadMedicine'];
        } else {
            $_IdDataLoadIllnesOld = 0;
        }
        $queryInsertData = "INSERT INTO tb_dataload_medicine("
            . " Gene,"
            . " Drug,"
            . " IdLoad,"
            . " DateCreate)"
            . " VALUES ("
            . $_query
            .  $_idLoad . ","
            . "'" . $_now . "'"
            . ")";

        $this->database->nonReturnQuery($queryInsertData);

        $_queryIdData = "SELECT max(IdDataLoadMedicine) as IdDataLoadMedicine  FROM tb_dataload_medicine"
            . " WHERE IdLoad = " . $_idLoad
            . " AND  DateCreate = '" . $_now . "'";
        $data = $this->database->query(utf8_decode($_queryIdData));
        $exists = $data->num_rows;
        if ($exists > 0) {
            $row = $data->fetch_assoc();
            $_IdDataLoadVariNew = $row['IdDataLoadMedicine'];
            if ($_IdDataLoadVariNew > $_IdDataLoadIllnesOld) {
                $result = $_IdDataLoadVariNew;
            } else {
                $result = 0;
            }
        } else {
            $result = 0;
        }
        return $result;
    }

    public function delateLocalFileVarient($_inputFileData)
    {
        unlink($_inputFileData['uploads_dir_complete']);
    }
}
