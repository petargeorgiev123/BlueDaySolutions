<?php

namespace AppBundle\Service;

/**
 * Class  FormatExporter.
 * User: Petar Georgiev
 *
 */
class FormatExporter
{
    /**
     * @var string Format
     *
     */
    private $format;

    /**
     * AppBundle __construct method.
     *
     * @param string $format with default
     */
    public function __construct($format = 'xml')
    {
        $this->format = $format;
    }

    /**
     * AppBundle generateJson method.
     *
     * @param array $arrayOffers
     *
     */
    private function generateJson($arrayOffers)
    {
        file_put_contents('data_as_json.json', json_encode($arrayOffers)); ;
    }

    /**
     * AppBundle generateCsv method.
     *
     * @param array $arrayOffers
     *
     */
    private function generateCsv($arrayOffers)
    {
        $file = fopen('data_as_csv.csv',"w");

        foreach ($arrayOffers as $line)
        {
            fputcsv($file,explode(',',$line));
        }

        fclose($file);
    }

    /**
     * AppBundle generateJson method.
     *
     * @param array $arrayXml
     *
     */
    private function generateXml($arrayOffers)
    {
        $arrayFlip = array_flip($arrayOffers);
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($arrayFlip, array ($xml, 'addChild'));
        file_put_contents('data_as_xml.xml', $xml->asXML());
    }

    /**
     * AppBundle PrintFile method.
     *
     * @param array $arrayOffers
     *
     */
    public function printFile($arrayOffers)
    {
        switch ($this->format) {
            case "json":
                $this->generateJson($arrayOffers);
                break;
            case "csv":
                $this->generateCsv($arrayOffers);
                break;
            case "xml":
                $this->generateXml($arrayOffers);
                break;
            default:
                echo "format not allowed";
        }
    }
}