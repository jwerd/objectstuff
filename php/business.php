<?php

class Person {
    protected $name;
    protected $position = [];

    public function __construct($name, $position = 'Owner')
    {
        $this->name     = $name;
        $this->position = $position;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getPosition()
    {
        return is_array($this->position) ? implode(", ", $this->position) : $this->position;
    }
}

class Business {
    protected $name;
    protected $staff;

    public function __construct($name)
    {
        $this->name  = $name;
        $this->staff = new Staff;

        return $this;
    }
    public function hire(Person $person)
    {
        $this->staff->add($person);

        return $this;
    }
    public function fire(Person $person)
    {
        //@todo implement
    }
    public function getCompanyName()
    {
        return $this->name;
    }
    public function getStaffMembers()
    {
        return $this->staff->members();
    }
}

class Staff {
    protected $members = [];

    public function add(Person $person)
    {
        $this->members[] = $person;
    }
    public function members()
    {
        return $this->members;
    }
}

// An example how to call this and build the objects out:
$scs = (new Business('SCS'))
        ->hire(new Person('Sean', 'Owner'))
        ->hire(new Person('Jackie', ['Owner', 'Leecher']))
        ->hire(new Person('Jake', 'Tech'))
        ->hire(new Person('Colby', 'Tech'));

echo "Company report for ".$scs->getCompanyName()."\n";
echo "=====\n";
foreach($scs->getStaffMembers() as $member) {
    echo $member->getName() . ", with position: " . $member->getPosition() . "\n";
}
//var_dump($scs);
echo "Yeee, we're at the end...\n";
?>
