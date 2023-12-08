<?php

namespace App\Tests\Entity;

use App\Entity\Admin;
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase
{
    public function testGetInfosUserAdmin()
    {
        $dataUser = ["PERQUY", "Kévin", "kperquy_admin", ["1"=>"ROLE_ADMIN"], "P@ssw0rdDeTest12"];
        $roleGroup = $dataUser[3] + ["2"=>"ROLE_USER"];

        $userAdmin = (new Admin())
            ->setName($dataUser[0])
            ->setSurname($dataUser[1])
            ->setUseradmin($dataUser[2])
            ->setRoles($dataUser[3])
            ->setPassword($dataUser[4]);

        $this->assertSame($dataUser[0], $userAdmin->getName());
        $this->assertSame($dataUser[1], $userAdmin->getSurname());
        $this->assertSame($dataUser[2], $userAdmin->getUseradmin());
        $this->assertEquals(json_encode($roleGroup), json_encode($userAdmin->getRoles()));
        $this->assertSame($dataUser[4], $userAdmin->getPassword());
    }
}
