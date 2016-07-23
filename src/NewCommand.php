<?php

namespace Rappasoft\WordpressDownloader;

use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\RuntimeException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;

/**
 * Class NewCommand
 * @package Rappasoft\WordpressDownloader
 */
class NewCommand extends SymfonyCommand
{
    /**
     * The input interface.
     *
     * @var InputInterface
     */
    public $input;

    /**
     * The output interface.
     *
     * @var OutputInterface
     */
    public $output;

    /**
     * The path to the new Wordpress installation.
     *
     * @var string
     */
    public $path;

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('new')
            ->setDescription('Create a new Wordpress project')
            ->addArgument('name', InputArgument::OPTIONAL, 'The name of the application');
    }

    /**
     * Execute the command.
     *
     * @param  InputInterface  $input
     * @param  OutputInterface  $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = new SymfonyStyle($input, $output);
		$name = $input->getArgument('name');
		$this->verifyApplicationDoesntExist($this->path = $name ? getcwd().'/'.$name : getcwd());

        $installers = [
            Installation\DownloadWordpress::class,
        ];

        foreach ($installers as $installer) {
            (new $installer($this, $name))->install();
        }
    }

	/**
	 * @param $directory
	 */
	private function verifyApplicationDoesntExist($directory)
	{
		if ((is_dir($directory) || is_file($directory)) && $directory != getcwd()) {
			throw new RuntimeException('Application already exists!');
		}
	}
}
