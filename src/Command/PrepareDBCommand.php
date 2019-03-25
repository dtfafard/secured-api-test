<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 4:03 PM
 */

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PrepareDBCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'seedbox:create-user';

    /**
     * @var EntityManagerInterface $em
     */
    protected $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * CreateUserCommand constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->em = $em;
        $this->passwordEncoder = $passwordEncoder;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...')
            ->addArgument('email', InputArgument::REQUIRED, 'User email')
            ->addArgument('username', InputArgument::REQUIRED, 'User name')
            ->addArgument('password', InputArgument::REQUIRED, 'User password');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    }
}