<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 12:31 PM
 */

namespace Faker\Provider;

require_once __DIR__ . '/../../../../vendor/fzaninotto/faker/src/autoload.php';

class Book extends \Faker\Provider\Base
{
    public function title($nbWords = 5)
    {
        $sentence = $this->generator->sentence($nbWords);
        return substr($sentence, 0, strlen($sentence) - 1);
    }

    public function ISBN()
    {
        return $this->generator->randomNumber(13);
    }
}