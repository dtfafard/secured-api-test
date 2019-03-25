<?php
/**
 * Created by PhpStorm.
 * User: Psyke
 * Date: 3/25/2019
 * Time: 4:03 PM
 */

namespace App\Command;

use App\Entity\EntityFactory;
use App\Entity\Product;
use App\Entity\ServerType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class PrepareSandboxCommand
 * @package App\Command
 */
class PrepareSandboxCommand extends Command
{
    // the name of the command (the part after "bin/console")
    /**
     * @var string
     */
    protected static $defaultName = 'seedbox:setup-sandbox';

    /**
     * @var EntityManagerInterface $em
     */
    protected $em;

    /**
     * @var UserPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * @var Product[]
     */
    protected $products = [];

    /**
     * @var ServerType[]
     */
    protected $serverTypes = [];

    /**
     * @var Server[]
     */
    protected $servers = [];

    /**
     * @var User[]
     */
    protected $users = [];

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

    /**
     *
     */
    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('Setup a Sandbox for testing the environment.')


            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command easily sets a Sandbox for testing.');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->validatePHP();
        $this->setupDBData();
    }

    /**
     *  Sets the Validates PHP Version
     */
    protected function validatePHP()
    {
        echo phpversion();
    }

    /**
     *  Sets the DB Data
     */
    protected function setupDBData()
    {
        /**
         * IMPORTANT NOTE : these functions must be executed sequentially in order for the command to work.
         */
        $this->setupProducts();
        $this->setupServerTypes();
        $this->setupServers();
        $this->setupUsers();
    }

    /**
     *  Sets the Products DB Data
     */
    private function setupProducts()
    {
        $products = [
            ['name' => 'Product 1'],
            ['name' => 'Product 2'],
            ['name' => 'Product 3'],
            ['name' => 'Product 4'],
        ];

        $container = $this->setupData($products, Product::class);

        $this->products = $container;
    }

    /**
     *  Sets the Servers Types DB Data
     */
    private function setupServerTypes()
    {
        $serverTypes = [
            ['name' => 'DB'],
            ['name' => 'API'],
            ['name' => 'WebServer']
        ];

        $container = $this->setupData($serverTypes, ServerType::class);

        $this->serverTypes = $container;
    }

    /**
     *  Sets the Servers DB Data
     *
     * @throws \LogicException
     */
    private function setupServers()
    {
        if (!$this->serverTypes || !$this->products) {
            throw new \LogicException('Products and Server Types must be setup in order to set up the servers.');
        }

        $servers = [];

        foreach ($this->products as $product) {
            if ($product instanceof Product) {
                foreach ($this->serverTypes as $type) {
                    if ($type instanceof ServerType) {
                        $serverName = $product->getName() . '-' . $type->getName();

                        $servers[] = [
                            'name' => $serverName,
                            'ip' => long2ip(rand(0, "4294967295")),
                            'product' => $product,
                            'type' => $type
                        ];
                    }
                }
            }
        }

        $container = $this->setupData($servers, Server::class);

        $this->servers = $container;
    }

    /**
     *  Sets the Users DB Data
     */
    private function setupUsers()
    {
        $users = [
            [
                'username' => 'example1@gmail.com',
                'email' => 'example1@gmail.com',
                'password' => 'test' . rand(1, 10000),
                'password-encoder' => $this->passwordEncoder
            ],
            [
                'username' => 'example2@gmail.com',
                'email' => 'example2@gmail.com',
                'password' => 'test' . rand(1, 10000),
                'password-encoder' => $this->passwordEncoder
            ],
            [
                'username' => 'example3@gmail.com',
                'email' => 'example3@gmail.com',
                'password' => 'test' . rand(1, 10000),
                'password-encoder' => $this->passwordEncoder
            ],
        ];

        $container = $this->setupData($users, User::class);

        $this->users = $container;
    }

    /**
     * @param array $data
     * @param string $entityClass
     * @return array
     */
    private function setupData($data, $entityClass)
    {
        $container = [];

        foreach ($data as $entry) {
            $entity = EntityFactory::initEntity($entry, $entityClass);
            $this->em->persist($entity);
            $container[] = $entity;
        }

        $this->em->flush();

        return $container;
    }
}