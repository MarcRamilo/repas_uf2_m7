<?php
class Store {
    public static function store($source, $dst, $filename) {
 
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/Public/Assets/" . $dst;
        $fullPath = $folder . "/" . $filename;

        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        if (move_uploaded_file($source, $fullPath)) {
            return true; 
        } else {
            return false; 
        }
    }
}
?>
