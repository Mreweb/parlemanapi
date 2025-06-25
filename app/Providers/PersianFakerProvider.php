<?php

namespace App\Providers;
use Faker\Provider\Base;

class PersianFakerProvider extends Base
{
    public function __construct($faker)
    {
        parent::__construct($faker);
    }

    public function persianName()
    {
        $names = ['Ali', 'Reza', 'Mohammad', 'Sara', 'Fatemeh', 'Zahra', 'Mahan', 'Niloofar'];
        return $this->generator->randomElement($names);
    }

    public function persianFamily()
    {
        $families = ['Ahmadi', 'Karimi', 'Rezaei', 'Mohammadi', 'Hashemi', 'Sadeghi', 'Jafari'];
        return $this->generator->randomElement($families);
    }

    public function persianPhoneNumber()
    {
        $prefixes = ['0912', '0913', '0914', '0915'];
        $prefix = $this->generator->randomElement($prefixes);
        $number = $this->generator->numerify('#####');
        return $prefix . $number;
    }

    public function persianEmail()
    {
        $domains = ['gmail.com', 'yahoo.com', 'outlook.com'];
        $emailPrefix = $this->persianName() . $this->persianFamily() . rand(10, 99);
        return strtolower($emailPrefix) . '@' . $this->generator->randomElement($domains);
    }

    public function persianNationalId()
    {
        return $this->generator->numerify('##########');
    }
}
