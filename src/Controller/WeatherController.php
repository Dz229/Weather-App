<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;

class WeatherController extends AbstractController
{
    #[Route('/weather/{id}', name: 'app_weather', requirements: ['id' => '\d+'])]
    public function city(Location $location, MeasurementRepository $repository): Response
    {
        $measurements = $repository->findByLocation($location);
        
        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

}

// class WeatherController extends AbstractController
// {
//     #[Route('/weather/{city}[/{country}]', name: 'app_weather', requirements: ['city' => '[a-zA-Z-]+', 'countryCode' => '[a-zA-Z]{2}'])]
//     public function city(string $city, string $country = null, MeasurementRepository $repository): Response
//     {
//         $location = $repository->findOneBy(['city' => $city, 'country' => $country]);

//         $measurements = $repository->findByLocation($location);

//         return $this->render('weather/city.html.twig', [
//             'location' => $location,
//             'measurements' => $measurements,
//         ]);
//     }
// }