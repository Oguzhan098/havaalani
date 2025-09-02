<?php
// app/Entities/Plane.php

class Plane {
    public $id;
    public $marka;
    public $model;
    public $kapasite;
    public $uretim_yili;

    public function __construct($marka, $model, $kapasite, $uretim_yili) {
        $this->marka = $marka;
        $this->model = $model;
        $this->kapasite = $kapasite;
        $this->uretim_yili = $uretim_yili;
    }
}
