<?php

namespace spec\Ceeps\CoreBundle\Command;

use Ceeps\LockerBundle\Entity\Locker;
use Ceeps\MailerBundle\Business\MailService;
use Ceeps\RentalBundle\Entity\Rental;
use Ceeps\RentalBundle\Repository\RentalRepository;
use Ceeps\UserBundle\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CronCommandSpec extends ObjectBehavior
{
    function let(
        Locker $locker,
        Rental $rental,
        User $user
    )
    {
        // $this->beConstructedWith();
        $rental->getUser()->willReturn($user);
        $rental->getLocker()->willReturn($locker);
        $rental->getIsRenewable()->willReturn(true);

        $locker->getCode()->willReturn("100");

        $user->getEmail()->willReturn('client@gmail.com');
        $user->getUsername()->willReturn('client@gmail.com');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Ceeps\CoreBundle\Command\CronCommand');
    }

    public function it_is_a_container_aware_command()
    {
        $this->shouldHaveType('Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand');
    }

    public function it_has_a_name()
    {
        $this->getName()->shouldReturn('seta:cron:run');
    }

    public function it_send_emails(
        ContainerInterface $container,
        InputInterface $input,
        MailService $mailer,
        OutputInterface $output,
        Rental $rental,
        RentalRepository $rentalRepository
    )
    {
        $container->get('tuconsigna.repository.rental')->willReturn($rentalRepository);
        $container->get('seta_mailing')->willReturn($mailer);

        $rentalRepository
            ->getExpireOnDateRentals(Argument::type(\DateTime::class))
            ->willReturn([$rental])
            ->shouldBeCalled()
        ;
        $mailer->sendRenewWarningEmail($rental)->shouldBeCalled();

        $this->setContainer($container);
        $this->run($input, $output);
    }
}
