<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AvatoTestCommand extends Command
{
    protected static $defaultName = 'avato:test';
    protected static $defaultDescription = 'Add a short description for your command';

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::REQUIRED, 'Input to generate key')
            ->addArgument('arg2', InputArgument::REQUIRED, 'Number of requests')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');
        $arg2 = $input->getArgument('arg2');
        $input = $arg1;

        try {
            for($i = 0; $i < $arg2; $i++){
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"http://localhost:8000/register/");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,"input=$input");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $server_output = curl_exec($ch);
                if(isset(json_decode($server_output)->code_error)){
                    $io->warning('Too Many Requests. Wait!');
                    set_time_limit(60);
                    continue;
                }
                $input = json_decode($server_output)->hash;
                $io->success($input);
            }
        } catch (Exception $e) {
            echo $e->getMessage(), "\n";
        } finally {
            curl_close ($ch);
        }

        $io->success('Command executed');

        return Command::SUCCESS;
    }
}
