<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // For logging errors

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->truncate();

        $apiUrl = 'https://restcountries.com/v3.1/all?fields=name,cca2,cca3';

        try {
            $jsonResponse = @file_get_contents($apiUrl);

            if ($jsonResponse === false) {
                $this->command->info('Failed to fetch data!');
                return;
            }

            $countriesData = json_decode($jsonResponse, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $this->command->info('Failed to decode JSON!');
                return;
            }

            $countriesToInsert = [];

            foreach ($countriesData as $country) {
                if (isset($country['name']['common']) && isset($country['cca2']) && isset($country['cca3'])) {
                    $countriesToInsert[] = [
                        'name' => $country['name']['common'],
                        'full_name' => $country['name']['official'] ?? null,
                        'cca2' => $country['cca2'],
                        'cca3' => $country['cca3'],
                    ];
                } else {
                    Log::warning('Skipping country due to missing data: ' . json_encode($country));
                }
            }
            $chunkSize = 500;
            foreach (array_chunk($countriesToInsert, $chunkSize) as $chunk) {
                DB::table('countries')->insert($chunk);
            }

        } catch (\Exception $e) {
            $this->command->error('Error during country seeding: ' . $e->getMessage());
            Log::error('Country Seeder Error: ' . $e->getMessage());
        }
    }
}

