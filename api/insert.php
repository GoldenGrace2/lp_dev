<?php
include("../config.php");

if (isset($_POST['title'])) {

    //collect data
    $error      = null;
    $title      = $_POST['title'];
    $desc       = $_POST['desc'];
    $start      = $_POST['startDate'];
    $end        = $_POST['endDate'];
    $adresse    = $_POST['adresse'];
    $check      = $_POST['check'];
    $color      = $_POST['color'];
    $text_color = $_POST['text_color'];
    $id_utilisateur = $_POST['id_user'];

    //validation
    if ($title == '') {
        $error['title'] = 'Le titre est requis';
    }

    if ($start == '') {
        $error['start'] = 'La date de début est requise';
    }

    if ($end == '') {
        $error['end'] = 'La date de fin est requise';
    }



    //if there are no errors, carry on
    if (! isset($error)) {

        //format date
        $start = date('Y-m-d H:i:s', strtotime($start));
        $end = date('Y-m-d H:i:s', strtotime($end));
        
        $data['success'] = true;
        $data['message'] = 'Success!';

        // check
        if ($check == true) :
            $check = 1;
        else: $check = 0;
        endif;

        //store
        $insert = [
            'title'       => $title,
            'description' => $desc,
            'start_event' => $start,
            'end_event'   => $end,
            'adresse'     => $adresse,
            'allDay'      => $check,
            'color'       => $color,
            'text_color'  => $text_color,
            '_user_id'  => $id_utilisateur
        ];
        $db->insert('events', $insert);
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}
