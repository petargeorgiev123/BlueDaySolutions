<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use AppBundle\Service\GenerateOffer;
use AppBundle\Service\FormatExporter;

/**
 * Class  GenerateOfferComand.
 * User: Petar Georgiev
 *
 */
class GenerateOfferCommand extends ContainerAwareCommand
{
    /**
     * @var string FormatExporter
     *
     */
    private $formatExporter;

    /**
     * AppBundle __construct method.
     *
     * @param FormatExporter $formatExporter
     */
    public function __construct(FormatExporter $formatExporter)
    {
        parent::__construct();
        $this->formatExporter = $formatExporter;
    }

    /**
     * AppBundle configure method.
     *
     */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:export-offers')

            // the short description shown while running "php bin/console list"
            ->setDescription('Export Offers')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to export offers in selected format')
        ;
    }

    /**
     * AppBundle execute method.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // outputs multiple lines to the console (adding "\n" at the end of each line)
        $output->writeln([
            'Exporting Offers',
            '============',
            '',
        ]);

        $objectOffer = new GenerateOffer();
        $arrayOffers = array();
        for($i=0; $i < 2; $i++)
        {
            $arrayOffers[$i] = $objectOffer->printOffer();
        }

        $this->formatExporter->printFile($arrayOffers);

        // outputs a message followed by a "\n"
        $output->writeln('All offers exported');
    }
}