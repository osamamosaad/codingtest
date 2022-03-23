<?php

namespace App\Command;

use App\Machine\ChangeCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Machine\CigaretteMachine;
use App\Machine\Contracts\PurchasedItemInterface;

/**
 * Class CigaretteMachine
 * @package App\Command
 */
class PurchaseCigarettesCommand extends Command
{
    /**
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('packs', InputArgument::REQUIRED, "How many packs do you want to buy?");
        $this->addArgument('amount', InputArgument::REQUIRED, "The amount in euro.");
    }

    /**
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cigaretteMachine = new CigaretteMachine(new ChangeCalculator());
        $purchasedItem = $cigaretteMachine->execute(new PurchaseTransaction($input));

        $this->render($output, $purchasedItem);
    }

    protected function render(OutputInterface $output, PurchasedItemInterface $purchasedItem)
    {
        $infoFormat = "You bought <info>%d</info> packs of cigarettes for <info>-%.2f</info>, each for <info>-%.2f</info>.";
        $output->writeln(sprintf(
            $infoFormat,
            $purchasedItem->getItemQuantity(),
            $purchasedItem->getTotalAmount(),
            $purchasedItem->getAmountItem()
        ));
        $output->writeln('Your change is:');
        $changeResult = $purchasedItem->getChange();

        $table = new Table($output);
        $table
            ->setHeaders(array('Coins', 'Count'))
            ->setRows($changeResult);
        $table->render();
    }
}
