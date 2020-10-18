<?php
include("../config.php");

if (isset($_POST['id'])) {
    $row = $db->row("SELECT * FROM events where id=?", [$_POST['id']]);
    $data = [
        'id'        => $row->id,
        'title'     => $row->title,
        'desc'      => $row->description,
        'start'     => date('d-m-Y H:i:s', strtotime($row->start_event)),
        'end'       => date('d-m-Y H:i:s', strtotime($row->end_event)),
        'check'     => $row->allDay,
        'adresse'   => $row->adresse,
        'color'     => $row->color,
        'textColor' => $row->text_color
    ];

    echo json_encode($data);
}
