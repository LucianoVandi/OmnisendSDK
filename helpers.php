<?php

use Psr\Http\Message\ResponseInterface;

if(! function_exists('generateFixtureFromResponse')){
    /**
     * @param string $exampleFile
     * @param ResponseInterface $response
     * @return void
     */
    function generateFixtureFromResponse(string $exampleFile, ResponseInterface $response): void
    {
        $options = getopt('', ['save-fixture', 'force']);

        if(!isset($options['save-fixture'])){
            return;
        }

        $currentFileName = pathinfo($exampleFile, PATHINFO_FILENAME);
        $fixtureFile = '/var/www/tests/fixtures/'.$currentFileName.'Response.json';

        $response->getBody()->rewind();

        $content = json_encode(
            json_decode($response->getBody()->getContents(), true),
            JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES
        );

        if(file_exists($fixtureFile) && !isset($options['force'])){
            echo PHP_EOL;
            echo "\033[1;33m";
            echo "---------------------------------------------------------------".PHP_EOL;
            echo "Fixture already exists, use --force option to override the file".PHP_EOL;
            echo "---------------------------------------------------------------".PHP_EOL;
            echo "\033[0m";
            echo PHP_EOL;
        }else{
            file_put_contents($fixtureFile, $content);
        }
    }
}
