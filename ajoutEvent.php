
<?php
 // ...
    require_once "../google-api-php-client/src/Google_Client.php";
    require_once "../google-api-php-client/src/contrib/Google_CalendarService.php";
    //
    $client = new Google_Client();
    $client->setUseObjects(true);
/*    $client->setApplicationName("your-app-name");*/
    $client->setClientId("438975720919-534fjbi3nsapqpfkhdngmbf7pqmvnbjb.apps.googleusercontent.com");
    /*$client->setAssertionCredentials(
        new Google_AssertionCredentials(
            "d98hg78as9dj-0askd9ajsd08a0sdjspdj9@developer.gserviceaccount.com",
            array(
                "https://www.googleapis.com/auth/calendar"
            ),
            file_get_contents("certificates/dceffe6e95344eb64c88dd982bc8f1c01ed0aa6b-privatekey.p12")
        )
    );*/
    //
    $service = new Google_CalendarService($client);
    //
    $event = new Google_Event();
    $event->setSummary('Event 1');
    $event->setLocation('Somewhere');
    $start = new Google_EventDateTime();
    $start->setDateTime('2016-10-22T19:00:00.000+01:00');
    $start->setTimeZone('Europe/London');
    $event->setStart($start);
    $end = new Google_EventDateTime();
    $end->setDateTime('2016-10-22T19:25:00.000+01:00');
    $end->setTimeZone('Europe/London');
    $event->setEnd($end);
    //
    $calendar_id = "438975720919-534fjbi3nsapqpfkhdngmbf7pqmvnbjb.apps.googleusercontent.com";
    //
    $new_event = null;
    //
    try {
        $new_event = $service->events->insert($calendar_id, $event);
        //
        $new_event_id= $new_event->getId();
    } catch (Google_ServiceException $e) {
        syslog(LOG_ERR, $e->getMessage());
    }
    //
    $event = $service->events->get($calendar_id, $new_event->getId());
    //
    if ($event != null) {
        echo "Inserted:";
        echo "EventID=".$event->getId();
        echo "Summary=".$event->getSummary();
        echo "Status=".$event->getStatus();
    }
    //...