<?php


namespace Drupal\timezone;

/**
 *  Implementing 'Time Generator' Custom Service
 */

class TimeGenerator {

    public function getTime($timezone) {

        $date = new \DateTime("now", new \DateTimeZone($timezone) );
        return $date->format('jS M Y - h:i A');
    }
}