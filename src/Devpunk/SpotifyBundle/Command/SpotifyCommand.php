<?php

namespace Devpunk\SpotifyBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SpotifyCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('devpunk_spotify:spotify')
            ->setDescription('Spotify');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $spotifySession = $this->getContainer()->get('devpunk.spotify.session');


        $spotifySession->requestCredentialsToken();
        $accessToken = $spotifySession->getAccessToken();


        $api = new \SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken($accessToken);


        $options = [
            'scope' => [
                'user-library-modify',
                'user-read-birthdate',
            ],
        ];


        $authorizeUrl = $spotifySession->getAuthorizeUrl($options);
        $output->writeln(sprintf('Visit %s to authorize this app', $authorizeUrl));

        return true;

    }
}
