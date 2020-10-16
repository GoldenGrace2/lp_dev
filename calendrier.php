<?php  
    require 'config.inc.php';
    require 'config.php';
?>

<?php 

    if (!isset($_SESSION['email_client'])) {
        
        $_SESSION['ErreurNonCo'] = '<h1>Vous n\'êtes pas connecté !</h1>';
        header('location:index.php'); 
    }

    $bdd = connexionBD();

    $req='SELECT * FROM User WHERE user_email LIKE "'.$_SESSION['email_client'].'"';
    $exe = $bdd->query($req);
    $valid = $exe->fetch();

        if ( $valid['user_validation'] !== 'OK') {

            $_SESSION['pasValide'] = '<h1 class="erreur">Votre compte n\'est pas encore validé ! Un email de confirmation vous a été envoyés (vérifiez vos spams) </h1>';
            header ('location:index.php');
        }
      echo   "<div style='display:none;' id='code_uti'>".$_SESSION["numero_client"]."</div>"; ?>



<!DOCTYPE html>
<html>
<head>
    <title>Calendrier</title>

    <link href='css/style.css' rel='stylesheet'/>

    <link href='<?= $dir; ?>packages/core/main.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>packages/daygrid/main.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>packages/timegrid/main.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>packages/list/main.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>packages/bootstrap/css/bootstrap.css' rel='stylesheet'/>
    <link href="<?= $dir; ?>packages/jqueryui/custom-theme/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <link href='<?= $dir; ?>packages/datepicker/datepicker.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>packages/colorpicker/bootstrap-colorpicker.min.css' rel='stylesheet'/>
    <link href='<?= $dir; ?>style.css' rel='stylesheet'/>

    <script src='<?= $dir; ?>packages/core/main.js'></script>
    <script src='<?= $dir; ?>packages/daygrid/main.js'></script>
    <script src='<?= $dir; ?>packages/timegrid/main.js'></script>
    <script src='<?= $dir; ?>packages/list/main.js'></script>
    <script src='<?= $dir; ?>packages/interaction/main.js'></script>
    <script src='<?= $dir; ?>packages/jquery/jquery.js'></script>
    <script src='<?= $dir; ?>packages/jqueryui/jqueryui.min.js'></script>
    <script src='<?= $dir; ?>packages/bootstrap/js/bootstrap.js'></script>
    <script src='<?= $dir; ?>packages/datepicker/datepicker.js'></script>
    <script src='<?= $dir; ?>packages/colorpicker/bootstrap-colorpicker.min.js'></script>
    <script type="text/javascript">

        document.addEventListener('DOMContentLoaded', function() {

        var url ='./';
        var code_uti = <?php echo $_SESSION['numero_client'] ?>;
        $('body').on('click', '.datetimepicker', function() {
            $(this).not('.hasDateTimePicker').datetimepicker({
                controlType: 'select',
                changeMonth: true,
                changeYear: true,
                dateFormat: "dd-mm-yy",
                timeFormat: 'HH:mm:ss',
                yearRange: "1900:+10",
                showOn:'focus',
                firstDay: 1
            }).focus();
        });

        $(".colorpicker").colorpicker();

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            locale:'fr',
            navLinks: true, // can click day/week names to navigate views
            businessHours: true, // display business hours
            editable: true,
            //uncomment to have a default date
            //defaultDate: '2020-04-07',
            events: url+'api/load.php?code_uti=<?php echo $_SESSION['numero_client']?>',
            eventDrop: function(arg) {
                var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
                if (arg.event.end == null) {
                    end = start;
                } else {
                    var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();
                }

                $.ajax({
                url:url+"api/update.php",
                type:"POST",
                data:{id:arg.event.id, start:start, end:end},
                });
            },
            eventResize: function(arg) {
                var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
                var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();

                $.ajax({
                url:url+"api/update.php",
                type:"POST",
                data:{id:arg.event.id, start:start, end:end},
                });
            },
            eventClick: function(arg) {
                var id = arg.event.id;
                console.log(id);
                $('#editEventId').val(id);
                $('#deleteEvent').attr('data-id', id); 

                $.ajax({
                url:url+"api/getevent.php",
                type:"POST",
                dataType: 'json',
                data:{id:id},
                success: function(data) {
                        $('#editEventTitle').val(data.title);
                        $('#editEventDesc').val(data.desc);
                        $('#editStartDate').val(data.start);
                        $('#editEndDate').val(data.end);
                        $('#editEventCheck').val(data.check)
                        $('#editAdresse').val(data.adresse)
                        $('#editColor').val(data.color);
                        $('#editTextColor').val(data.textColor);
                        $('#editeventmodal').modal();
                    }
                });

                $('body').on('click', '#deleteEvent', function() {
                    if(confirm("Are you sure you want to remove it?")) {
                        $.ajax({
                            url:url+"api/delete.php",
                            type:"POST",
                            data:{id:arg.event.id},
                        });

                        //close model
                        $('#editeventmodal').modal('hide');

                        //refresh calendar
                        calendar.refetchEvents();         
                    }
                });
                
                calendar.refetchEvents();
            }
        });

        calendar.render();

        $('#createEvent').submit(function(event) {

            // stop the form refreshing the page
            event.preventDefault();

            $('.form-group').removeClass('has-error'); // remove the error class
            $('.help-block').remove(); // remove the error text

            // process the form
            $.ajax({
                type        : "POST",
                url         : url+'api/insert.php',
                data        : $(this).serialize(),
                dataType    : 'json',
                encode      : true
            }).done(function(data) {

                // insert worked
                if (data.success) {
                    
                    //remove any form data
                    $('#createEvent').trigger("reset");

                    //close model
                    $('#addeventmodal').modal('hide');

                    //refresh calendar
                    calendar.refetchEvents();

                } else {

                    //if error exists update html
                    if (data.errors.date) {
                        $('#date-group').addClass('has-error');
                        $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                    }

                    if (data.errors.title) {
                        $('#title-group').addClass('has-error');
                        $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                    }

                }

            });
        });

        $('#editEvent').submit(function(event) {

            // stop the form refreshing the page
            event.preventDefault();

            $('.form-group').removeClass('has-error'); // remove the error class
            $('.help-block').remove(); // remove the error text

            //form data
            var id = $('#editEventId').val();
            var title = $('#editEventTitle').val();
            var desc = $('#editEventDesc').val();
            var start = $('#editStartDate').val();
            var end = $('#editEndDate').val();
            var check = $('#editCheck').is(':checked') ? 1 : 0;
            var adresse = $('#editAdresse').val();
            var color = $('#editColor').val();
            var textColor = $('#editTextColor').val();

            // process the form
            $.ajax({
                type        : "POST",
                url         : url+'api/update.php',
                data        : {
                    id:id, 
                    title:title,
                    desc:desc,
                    start:start,
                    end:end,
                    check:check,
                    adresse:adresse,
                    color:color,
                    text_color:textColor
                },
                dataType    : 'json',
                encode      : true
            }).done(function(data) {

                // insert worked
                if (data.success) {
                    
                    //remove any form data
                    $('#editEvent').trigger("reset");

                    //close model
                    $('#editeventmodal').modal('hide');

                    //refresh calendar
                    calendar.refetchEvents();

                } else {

                    //if error exists update html
                    if (data.errors.date) {
                        $('#date-group').addClass('has-error');
                        $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                    }

                    if (data.errors.title) {
                        $('#title-group').addClass('has-error');
                        $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                    }

                }

            });
        });
        });



    </script>
</head>
<body>
<header>
      <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand logo" href="#"><img alt=""  class="imglogo" src="logo.jpg" /></a>
        <button class="navbar-toggler bg-light burger" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse pages" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item assistancelien">
              <a class="nav-link" href="mailto:alois.collier@etudiant.univ-reims.fr">Assistance</a>
            </li>
            <li class="nav-item assistancelien">
              <a class="nav-link" href="csv.php">Importer CSV</a>
            </li>
            <li class="nav-item activelien">
              <a class="nav-link" href="deconnexion.php">Déconnexion <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>

<!--Créer un évènement-->
<div class="modal fade" id="addeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Ajouter un évènement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div style="display:none;" id="code_uti"><?php echo $_SESSION['numero_client']; ?></div>
            <div class="modal-body">

                <div class="container-fluid">

                    <form id="createEvent" class="form-horizontal">

                        <div class="row">

                            <div class="col-md-6">

                                    <input type="hidden" *class="form-control" name="id_user" value="<?php echo $_SESSION['numero_client'];?>">
                                    <!-- errors will go here -->

                                <div id="title-group" class="form-group">
                                    <label class="control-label" for="title">Titre</label>
                                    <input type="text" class="form-control" name="title">
                                    <!-- errors will go here -->
                                </div>

                                <div id="desc-group" class="form-group">
                                    <label class="control-label" for="desc">Description</label>
                                    <textarea class="form-control" name="desc"></textarea>
                                    <!-- errors will go here -->
                                </div>

                                <div id="startdate-group" class="form-group">
                                    <label class="control-label" for="startDate">Date de début</label>
                                    <input type="text" class="form-control datetimepicker" id="startDate"
                                           name="startDate">
                                    <!-- errors will go here -->
                                </div>

                                <div id="enddate-group" class="form-group">
                                    <label class="control-label" for="endDate">Date de fin</label>
                                    <input type="text" class="form-control datetimepicker" id="endDate" name="endDate">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div id="check-group" class="form-group">
                                    <label class="control-label" for="adresse">Adresse</label>
                                    <input type="text" class="form-control" name="adresse">
                                    <!-- errors will go here -->
                                </div>

                                <div id="check-group" class="form-group">
                                    <label class="control-label" for="check">Toute la journée</label>
                                    <input type="hidden" value="0" name="check">
                                    <input type="checkbox" class="form-control" name="check" value="1">
                                    <!-- errors will go here -->
                                </div>

                                <div id="color-group" class="form-group">
                                    <label class="control-label" for="color">Couleur</label>
                                    <input type="text" class="form-control colorpicker" name="color" value="#6453e9">
                                    <!-- errors will go here -->
                                </div>

                                <div id="textcolor-group" class="form-group">
                                    <label class="control-label" for="textcolor">Couleur du text</label>
                                    <input type="text" class="form-control colorpicker" name="text_color"
                                           value="#ffffff">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                        </div>


                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
            </div>

            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modifier un évènement-->
<div class="modal fade" id="editeventmodal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Modifier l'évènement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="container-fluid">

                    <form id="editEvent" class="form-horizontal">
                        <input type="hidden" id="editEventId" name="editEventId" value="">

                        <div class="row">

                            <div class="col-md-6">

                                <div id="edit-title-group" class="form-group">
                                    <label class="control-label" for="editEventTitle">Titre</label>
                                    <input type="text" class="form-control" id="editEventTitle" name="editEventTitle">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-desc-group" class="form-group">
                                    <label class="control-label" for="editEventDesc">Description</label>
                                    <input type="text" class="form-control" id="editEventDesc" name="editEventDesc">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-startdate-group" class="form-group">
                                    <label class="control-label" for="editStartDate">Date de début</label>
                                    <input type="text" class="form-control datetimepicker" id="editStartDate"
                                           name="editStartDate">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-enddate-group" class="form-group">
                                    <label class="control-label" for="editEndDate">Date de fin</label>
                                    <input type="text" class="form-control datetimepicker" id="editEndDate"
                                           name="editEndDate">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div id="edit-adresse-group" class="form-group">
                                    <label class="control-label" for="editAdresse">Adresse</label>
                                    <input type="text" class="form-control" id="editAdresse" name="editAdresse" />
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-check-group" class="form-group">
                                    <label class="control-label" for="editCheck">Toute la journée</label>
                                    <input type="checkbox" class="form-control" id="editCheck" name="editCheck" value="1"/>
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-color-group" class="form-group">
                                    <label class="control-label" for="editColor">Couleur</label>
                                    <input type="text" class="form-control colorpicker" id="editColor" name="editColor"
                                           value="#6453e9">
                                    <!-- errors will go here -->
                                </div>

                                <div id="edit-textcolor-group" class="form-group">
                                    <label class="control-label" for="editTextColor">Couleur du texte</label>
                                    <input type="text" class="form-control colorpicker" id="editTextColor"
                                           name="editTextColor" value="#ffffff">
                                    <!-- errors will go here -->
                                </div>

                            </div>

                        </div>

                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Sauvegarder les changements</button>
                <button type="button" class="btn btn-danger" id="deleteEvent" data-id>Supprimer</button>
            </div>

            </form>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">
    <button type="button" class="button_wow" data-toggle="modal" data-target="#addeventmodal">
        Ajouter un évènement
    </button>

    <div id="calendar"></div>
</div>

</body>
</html>
