<?php

namespace Baikal\DavServicesBundle\Service\Helper;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Sabre\VObject;

class DavTimeZoneHelper {

    protected $servertimezone;

    public function __construct($servertimezone) {
        $this->servertimezone = $servertimezone;
    }
    
    public function extractTimeZoneFromDavString($davstring) {
        try {
            $timezone = VObject\TimeZoneUtil::getTimeZone(
                null,
                VObject\Reader::read($davstring),
                TRUE    # failIfUncertain
            );
        } catch(\Exception $e) {
            # Defaulting to Server timezone
            $timezone = new \DateTimeZone($this->servertimezone);
        }

        return $timezone;
    }
}