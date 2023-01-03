<?php

if(! function_exists('generateFixtureFromResponse')){
    /**
     * @param string $exampleFile
     * @param mixed $response
     * @return void
     */
    function generateFixtureFromResponse($exampleFile, $response)
    {
        $options = getopt('', ['save-fixture', 'force']);
        if(!isset($options['save-fixture'])){
            return;
        }

        $currentFileName = pathinfo($exampleFile, PATHINFO_FILENAME);
        $fixtureFile = '/var/www/tests/fixtures/'.$currentFileName.'Response.json';

        $response->getHttpResponse()->getBody()->rewind();

        $content = json_encode(
            json_decode($response->getHttpResponse()->getBody()->getContents(), true),
            JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES
        );

        if(file_exists($fixtureFile) && !isset($options['force'])){
            echo "Fixture already exists, use --force option to override the file" .PHP_EOL;
        }else{
            file_put_contents($fixtureFile, $content);
        }
    }
}
