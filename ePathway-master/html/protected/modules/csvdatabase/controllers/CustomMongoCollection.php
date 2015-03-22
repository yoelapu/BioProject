<?php

class CustomMongoCollection {
    private $CollectionName;
    private $CollectionColumns;
    public $_id;


    public function getCollectionName() {
        return $this->CollectionName;
    }

    public function setCollectionName($pCollectionName) {
        $this->CollectionName = $pCollectionName;
    }

    public function getCollectionColumns() {
        return $this->CollectionColumns;
    }

    public function setCollectionColumns($pCollectionColumns) {
        $this->CollectionColumns = $pCollectionColumns;
    }
}

?>
