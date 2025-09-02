<?php
class Ucak {
    public $marka;
    public $model;
    public $kapasite;
    public $uretim_yili;
    public $havaalani_id;

    public function __construct($marka, $model, $kapasite, $uretim_yili, $havaalani_id) {
        $this->marka = $marka;
        $this->model = $model;
        $this->kapasite = $kapasite;
        $this->uretim_yili = $uretim_yili;
        $this->havaalani_id = $havaalani_id;
    }
}
