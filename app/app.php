<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Patient.php";
    require_once __DIR__."/../src/Doctor.php";
    require_once __DIR__."/../src/Specialty.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=doctor_office';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);



    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('specialties' => Specialty::getAll()));
    });

    $app->get("/specialties/{id}", function($id) use ($app) {
        $specialty = Specialty::findById($id);
        return $app['twig']->render('specialties.html.twig', array('specialty' => $specialty, 'doctors' => $specialty->getDoctors()));
    });

    $app->post("/specialties", function() use ($app) {
        $new_specialty = new Specialty($_POST['specialty_name']);
        $new_specialty->save();
        return $app['twig']->render('index.html.twig', array('specialties' => Specialty::getAll()));
    });

    $app->post("/delete_specialties", function() use ($app) {
        Specialty::deleteSpecialties();
        return $app['twig']->render('index.html.twig', array('specialties' => Specialty::getAll()));
    });

    $app->get("/doctors", function() use ($app) {
        return $app['twig']->render('doctors.html.twig', array('doctors' => Doctor::getAll()));
    });

    $app->get("/doctors/{id}", function($id) use ($app) {
        $doctor = Doctor::findById($id);
        return $app['twig']->render('doctors.html.twig', array('doctor' => $doctor, 'patients' => $doctor->getPatients()));
    });

    $app->post("/doctors", function() use ($app) {
        $specialty_id = $_POST['specialty_id'];
        $doctor = new Doctor($_POST['doctor_name'], $id=null, $specialty_id);
        $doctor->save();
        return $app['twig']->render('specialties.html.twig', array('doctors' => Doctor::getAll()));
    });

    $app->post("/delete_doctors/{id}", function($id) use ($app) {
        $specialty = Specialty::findById($id);
        Doctor::deleteFromSpecialty($specialty->getId());
        return $app['twig']->render('specialties.html.twig', array('specialty' => $specialty));
    });

    $app->get("/patients", function() use ($app) {
        return $app['twig']->render('patients.html.twig', array('patients' => Patient::getAll()));
    });

    $app->post("/patients", function() use ($app) {
        $name = $_POST['patient_name'];
        $doctor_id = $_POST['doctor_id'];
        $patient = new Patient($name, $id = null, $doctor_id);
        $patient->save();
        $doctor = Doctor::findById($doctor_id);
        return $app['twig']->render('doctors.html.twig', array('doctor' => $doctor, 'patients' => $doctor->getPatients()));
    });

    $app->post("/delete_patients/{id}", function($id) use ($app) {
        $doctor_id = Doctor::findById($id);
        Patient::deleteFromDoctor($doctor_id->getId());

        return $app['twig']->render('doctors.html.twig', array('doctor' => $doctor_id));
    });



    // $app->post("/date_search", function() use ($app) {
    //     // $doctor_id = Doctor::findById($id);
    //     $search_date = $_POST['search_date'];
    //     Patient::findByDate($search_date);
    //
    //     return $app['twig']->render('doctors.html.twig', array('doctor' => $doctor, 'patients' => $doctor->searchByDate()));
    // });

    return $app;
?>
