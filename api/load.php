<?php
include("../config.php");
$data = [];
$code_uti = $_GET['code_uti'];

//$result = $db->rows("SELECT * FROM events ORDER BY id");
$result = $db->rows('SELECT * FROM events WHERE _user_id ="'.$code_uti.'" ORDER BY id');

foreach($result as $row) {
    $data[] = [
        'id'              => $row->id,
        'title'           => $row->title,
        'desc'            => $row->description,
        'start'           => $row->start_event,
        'end'             => $row->end_event,
        'check'           => $row->allDay,
        'adresse'         => $row->adresse,
        'backgroundColor' => $row->color,
        'textColor'       => $row->text_color
    ];
}
$urlApi = 'https://calendrier.api.gouv.fr/jours-feries/metropole/2020.json';
$content = file_get_contents($urlApi);
 $joursferie = json_decode($content, true);

foreach($joursferie as $date => $jourferie) {

    $data[] = [
    
        'id'    => uniqid(),
        'title' => $jourferie,
        'desc'            => '',
        'start' => $date,
        'end'             =>  $date,
        'check'           => 1,
        'adresse'         => '',
        'backgroundColor' => '#6453e9',
        'textColor'       => 'white'
    ];
}

$urlApi2 = 'https://calendrier.api.gouv.fr/jours-feries/metropole/2021.json';
$content2 = file_get_contents($urlApi2);
 $joursferie2 = json_decode($content2, true);

foreach($joursferie2 as $date => $jourferie2) {

    $data[] = [
    
        'id'    => uniqid(),
        'title' => $jourferie2,
        'desc'            => '',
        'start' => $date,
        'end'             =>  $date,
        'check'           => 1,
        'adresse'         => '',
        'backgroundColor' => '#6453e9',
        'textColor'       => 'white'
    ];
}

echo json_encode($data);
