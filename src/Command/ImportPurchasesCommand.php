<?php

namespace App\Command;

use App\Entity\Purchase;
use App\Entity\PurchaseType;
use App\Services\HtmlParserService;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\ExceptionInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:import:purchases')]
class ImportPurchasesCommand extends Command
{
    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly EntityManagerInterface $entityManager,
        private readonly HtmlParserService $htmlParserService,
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Импорт покупок')
            ->addArgument('url', InputArgument::OPTIONAL, 'URL')
        ;
    }

    /**
     * @throws ExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $url = $input->getArgument('url') ?: 'https://www.100sp.ru/vladivostok';

        $output->writeln("<info>Импорт покупок с $url</info>");
        $output->writeln("<info>URL можно указать в качестве первого аргумента (app:import:purchases [URL])</info>");

        try {
            $response = $this->httpClient->request('GET', $url);
        } catch (GuzzleException $exception) {
            $output->writeln("<error>Проблема с соединением: " . $exception->getMessage() . "</error>");
            return self::FAILURE;
        }

        $purchaseTypes = $this->htmlParserService->parse($response->getBody());

        // В рамках данной задачи уместно использовать команды для очищения базы данных и создания таблиц
        $this->getApplication()->find('doctrine:schema:drop')->run(new ArrayInput(['--force' => true, '--full-database' => true]), $output);
        $this->getApplication()->find('doctrine:schema:update')->run(new ArrayInput(['--force' => true]), $output);

        $purchaseTypeCount = 0;
        $purchaseCount = 0;

        /** @var \stdClass $purchaseTypeDTO */
        foreach ($purchaseTypes as $purchaseTypeDTO) {
            $purchaseType = new PurchaseType($purchaseTypeDTO->alias, $purchaseTypeDTO->title);
            $output->writeln($purchaseType->getTitle());
            $purchaseTypeCount++;
            /** @var \stdClass $purchaseDTO */
            foreach ($purchaseTypeDTO->purchases as $purchaseDTO) {
                if (!$purchase = $this->entityManager->getRepository(Purchase::class)->find($purchaseDTO->id)) {
                    $purchase = new Purchase($purchaseDTO->id, $purchaseDTO->name, $purchaseDTO->url, $purchaseDTO->photo);
                    $purchaseCount++;
                }
                $purchaseType->addPurchase($purchase);
                $output->writeln("\t[" . $purchase->getId() . '] ' . $purchase->getName());
            }
            $this->entityManager->persist($purchaseType);
        }

        $this->entityManager->flush();

        $output->writeln("<info>Импорт завершён. Добавлено типов покупок: $purchaseTypeCount, добавлено покупок: $purchaseCount.</info>");

        return self::SUCCESS;
    }
}
