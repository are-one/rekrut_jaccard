<?php

namespace frontend\models;

use common\models\main\Pelamar as MainPelamar;
use phpDocumentor\Reflection\Types\Boolean;

class Pelamar extends MainPelamar
{
    public $uploadCv;
    public $uploadIjazah;
    const SCENARIO_UPDATE = 'scenario_update';
    const SCENARIO_INSERT = 'scenario_insert';

    
     
    public function rules()
    {
        return array_merge(parent::rules(),[
            ['email','email', 'message' => 'Email yang dimasukkan tidak valid.'],
            [['uploadCv','uploadIjazah'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf, png, jpg, jpeg', 'on' => self::SCENARIO_INSERT],
            [['uploadCv','uploadIjazah'], 'file', 'skipOnEmpty' => false, 'extensions' => 'pdf, png, jpg, jpeg', 'on' => self::SCENARIO_UPDATE],
        ]);
    }
    
    public function validasiData()
    {
        $cekNik = !in_array($this->nik,[null, ""]);
        $cekNamaLenkap = !in_array($this->nama_lengkap,[null, ""]);
        $cekTempatLahir = !in_array($this->tempat_lahir,[null, ""]);
        $cekTanggalLahir = !in_array($this->tanggal_lahir,[null, ""]);
        $cekAlamat = !in_array($this->alamat,[null, ""]);
        $cekNoHp = !in_array($this->no_hp,[null, ""]);    
        $cekEmail = !in_array($this->email,[null, ""]); 
        $cekFileCv = !in_array($this->file_cv,[null, ""]); 
        $cekFileIjazah = !in_array($this->file_ijazah,[null, ""]); 

        // var_dump([$cekNik, $cekNamaLenkap, $cekTanggalLahir, $cekTanggalLahir, $cekAlamat, $cekNoHp, $cekEmail, $cekFileCv, $cekFileIjazah]);die;
        $result = ((
            $cekNik && $cekNamaLenkap &&
            $cekTempatLahir && $cekTanggalLahir &&
            $cekAlamat && $cekNoHp &&
            $cekEmail && $cekFileCv &&
            $cekFileIjazah
        )? true : false);
        
        // var_dump($result);die;
        return $result;
    }

    public function upload($isDeleteTemp)
    {

        if ($this->validate(['uploadCv','uploadIjazah'])) {
            if($this->uploadCv != null){
                $this->uploadCv->saveAs('@frontend/assets/berkas/' . $this->file_cv, $isDeleteTemp);
            }

            if($this->uploadCv != null){
                $this->uploadIjazah->saveAs('@frontend/assets/berkas/' . $this->file_ijazah, $isDeleteTemp);
            }
            return true;
        } else {
            return false;
        }
    }
}