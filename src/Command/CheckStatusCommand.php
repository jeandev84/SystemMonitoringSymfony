<?php
namespace App\Command;

use App\Controller\HomeController;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


/**
 * Class CheckStatusCommand
 * @package App\Command
*/
class CheckStatusCommand extends Command
{
    protected static $defaultName = 'check:status';
    /**
     * @var HomeController
     */
    private $homeController;

    /**
     * @var WebsiteRepository
     */
    private $websiteRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * CheckStatusCommand constructor.
     * @param string|null $name
     * @param HomeController $homeController
     * @param WebsiteRepository $websiteRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
    string $name = null,
    HomeController $homeController,
    WebsiteRepository $websiteRepository,
    EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->homeController = $homeController;
        $this->websiteRepository = $websiteRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        # On fait l'action suivante:
        $this->homeController->analyse($this->websiteRepository, $this->entityManager);


        /* $io->success('You have a new command! Now make it your own! Pass --help to see your options.'); */
        $io->success("Cette commande sert a recuperer le status actuel des sites stockes en base. Entrer check:status --help pour plus d'info");

        return 0;
    }
}
