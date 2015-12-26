<?php

namespace spec\Ceeps\RentalBundle\Entity;

use Ceeps\LockerBundle\Entity\Locker;
use Ceeps\PenaltyBundle\Entity\Penalty;
use Ceeps\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RentalSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Ceeps\RentalBundle\Entity\Rental');
    }
    
    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }
    
    function it_has_no_start_date_by_default()
    {
        $this->getStartAt()->shouldReturn(null);
    }
    
    function its_start_date_is_mutable()
    {
        $now = new \DateTime('now');
        $this->setStartAt($now);
        $this->getStartAt()->shouldBeLike($now);
    }

    function it_has_no_end_date_by_default()
    {
        $this->getEndAt()->shouldReturn(null);
    }

    function its_end_date_is_mutable()
    {
        $now = new \DateTime('now');
        $this->setEndAt($now);
        $this->getEndAt()->shouldBeLike($now);
    }
    
    function it_has_no_return_date_by_default()
    {
        $this->getReturnAt()->shouldReturn(null);
    }

    function its_return_date_is_mutable()
    {
        $now = new \DateTime('now');
        $this->setReturnAt($now);
        $this->getReturnAt()->shouldBeLike($now);
    }

    function it_is_renewable_by_default()
    {
        $this->getIsRenewable()->shouldReturn(true);
    }

    function its_renewable_value_is_mutable()
    {
        $this->setIsRenewable(false);
        $this->getIsRenewable()->shouldReturn(false);
    }

    function it_has_a_mutable_locker(Locker $locker)
    {
        $this->setLocker($locker);
        $this->getLocker()->shouldReturn($locker);
    }
    
    function it_has_a_mutable_user(User $user)
    {
        $this->setUser($user);
        $this->getUser()->shouldReturn($user);
    }
    
    function it_has_no_penalty_by_default()
    {
        $this->getPenalty()->shouldReturn(null);
    }
    
    function its_penalty_is_mutable(Penalty $penalty)
    {
        $this->setPenalty($penalty);
        $this->getPenalty()->shouldReturn($penalty);
    }
}
